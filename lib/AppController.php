<?php
/**
 * Magic Test is a smaple test project, it used to check the code style and quality in PHP programming.
 *
 * @author Phuong Ngo <fuongit@gmail.com>
 * @copyright 2015 Magic Test
 * @version 1.0
 */

class AppController
{
    protected $_view;
    protected $_ajax;

    /**
     * __construct Inital AppController
     */
    public function __construct()
    {
        Guard::csrfFilter('post');
    }

    /**
     * call Process functions with ajax
     * 
     * @return mix
     */
    public function call()
    {
        $func = $_POST['func'];
        $className = 'AppController';
        $func = 'ajax' . ucfirst($func);
        if (!class_exists($className)) {
            return "unknown";
        }
        $controller = new $className();
        $args = $this->_parsePostData();

        $response = call_user_func_array(array($controller, $func), array($args));
        return $response;
    }

    private function _response($data, $code = 0, $message = '')
    {
        $response = array();
        $response['message'] = $message;
        $response['code'] = $code;
        $response['data'] = $data;

        return json_encode($response);
    }

    /**
     * _parsePostData Parse data from post request through ajax
     *  
     * @return string|array
     */
    private function _parsePostData()
    {
        $data = $_POST;
        unset($data['func']);
        return $data;
    }

    public function ajaxShowRegister()
    {
        $this->_view = new View(HOME . DS . 'views' . DS . 'register.tpl');
        return $this->_response((string) $this->_view); 
    }

    public function ajaxShowLogin()
    {
        $this->_view = new View(HOME . DS . 'views' . DS . 'login.tpl');
        return $this->_response((string) $this->_view);    
    }

    /**
     * ajaxRegister
     * 
     * @param  array $postData
     * @return mix
     */
    public function ajaxRegister($postData)
    {
        $validator = new Validator();
        $user = User::getInstance();

        $validator->addValidation('first_name', 'req', 'Please fill in first name');
        $validator->addValidation('last_name', 'req', 'Please fill in last name');
        $validator->addValidation('email', 'req', 'Please fill in email');
        $validator->addValidation('email', 'email', 'The input for Email should be a valid email value');
        $validator->addValidation('password', 'req', 'Please fill in password');
        $validator->addValidation('password', 'eqelmnt=confirm_password');

        if ($user->findByEmail($postData['email'])) {
            return $this->_response('', 1, 'Email already taken in system');
        }

        if (!$validator->validate()) {
            $errorHash = $validator->GetErrors();
            foreach ($errorHash as $input => $error) {
                return $this->_response('', 1, $error);
                break;
            }
        } else {
            $postData['password'] = md5($postData['password']);
            $postData['confirmation_code'] = Util::generateConfirmCode();
            if ($uid = $user->save($postData)) {
                $mail = Mail::getInstance();
                $mail->sendConfirmation($user->find($uid));
                return $this->_response('', 0, 'Your account is created succussful, please check your inbox (or spam box) and confirm your email to continue');
            }
        }
        return $this->_response('', 1, 'Oops! try again');
    }

    public function ajaxLogin($postData)
    {
        $user = User::getInstance();
        if ($user->login($postData)) {
            return $this->_response('', 0);
        }
        return $this->_response('', 1, 'Email or password is incorrect, try again!');
    }

    public function getActivate($code) 
    {
        $user = User::getInstance();
        $userAttr = $user->findByConfirmCode($code);
        if ($userAttr && $userAttr['confirmed'] == 0) {
            $user->save(array('confirmed' => 1, 'id' => $userAttr['id']));
            $message = 'Your account already activated succussful';
        } else {
            $message = 'Oops! Token is invalid or account have not existed';
        }
        $this->_view = new View(HOME . DS . 'views' . DS . 'activate.tpl');
        $this->_view->set('message', $message);
        $this->_view->output();
    }

    public function getIndex()
    {
        $userInst = User::getInstance();
        $users = $userInst->findAll();
        $this->_view = new View(HOME . DS . 'views' . DS . 'index.tpl');
        $this->_view->set('users', $users);
        $this->_view->output();
    }

    public function getLogout()
    {
        if (isset($_SESSION['user'])) {
            session_unset();
        }
        return redirect(APP_URL);
    }
}