<?php
/**
 * Magic Test is a smaple test project, it used to check the code style and quality in PHP programming.
 *
 * @author Phuong Ngo <fuongit@gmail.com>
 * @copyright 2015 Magic Test
 * @version 1.0
 */

class Mail
{
    public $to;
    public $from;
    public $template;
    public $subject;

    static $instance;

    public function __construct()
    {
        static::$instance = $this;
    }

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function setTo($to) 
    {
        $this->to = $to;
    }

    public function setFrom($from = null) 
    {
        if (is_null($from)) {
            $from = MAIL_FROM;
        }
        $this->from = $from;
    }

    public function setTemplate($template) 
    {
        $this->template = $template;
    }

    public function setSubject($subject) 
    {
        $this->subject = $subject;
    }

    public function send() 
    {
        $headers = "From: " . strip_tags($this->from) . "\r\n";
        //$headers .= "Reply-To: ". strip_tags($this->from) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        return mail($this->to, $this->subject, $this->template, $headers);
    }

    public function sendConfirmation($userAttr)
    {
        $mail = Mail::getInstance();
        $mail->setTo($userAttr['email']);
        $mail->setFrom();
        $mail->setSubject('Your account is created succussful');
        $view = new View(HOME . DS . 'views' . DS . 'confirm.tpl');
        $view->set('user', $userAttr);
        $view->set('url', APP_URL . '/activate.php?token=' . $userAttr['confirmation_code']);
        $mail->setTemplate($view->content());
        return $mail->send();
    }
}