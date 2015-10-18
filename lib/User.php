<?php
/**
 * Magic Test is a smaple test project, it used to check the code style and quality in PHP programming.
 *
 * @author Phuong Ngo <fuongit@gmail.com>
 * @copyright 2015 Magic Test
 * @version 1.0
 */

class User 
{
    static $instance;
    static $db;

    public function __construct()
    {
        static::$instance = $this;
        if (!isset(static::$db)) {
            static::$db = new DatabaseConnect();
        }
    }

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function find($id)
    {
        if (!is_numeric($id)) {
            return null;
        }
        $query = sprintf("SELECT * FROM users WHERE id=%s", mysql_real_escape_string($id));
        $rtn = static::$db->getSingleArray($query);
        return $rtn;
    }

    public function findAll()
    {
        $query = "SELECT * FROM users";
        $rtn = static::$db->getArrays($query);
        return $rtn;   
    }

    public function findByConfirmCode($code)
    {
        $query = sprintf("SELECT * FROM users WHERE confirmation_code='%s'", mysql_real_escape_string($code));
        $rtn = static::$db->getSingleArray($query);
        return $rtn;
    }

    public function findByEmail($email)
    {
        $query = sprintf("SELECT * FROM users WHERE email='%s'", mysql_real_escape_string($email));
        $rtn = static::$db->getSingleArray($query);
        return $rtn;
    }

    public function save($data)
    {
        return static::$db->save('users', $data);
    }

    public function login($data)
    {
        $email = $data['email'];
        $password = md5($data['password']);

        $query = sprintf("SELECT * FROM users WHERE confirmed=1 AND email='%s' AND password='%s'", mysql_real_escape_string($email), mysql_real_escape_string($password));
        $rtn = static::$db->getSingleArray($query);
        if ($rtn) {
            $_SESSION['user'] = $rtn;
        }
        return $rtn;
    }
}