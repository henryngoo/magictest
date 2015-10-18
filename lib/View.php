<?php
/**
 * Magic Test is a smaple test project, it used to check the code style and quality in PHP programming.
 *
 * @author Phuong Ngo <fuongit@gmail.com>
 * @copyright 2015 Magic Test
 * @version 1.0
 */

class View
{
    protected $_file;
    protected $_data = array();
    
    /**
     * __construct Init view file
     * @param string $file
     */
    public function __construct($file)
    {
        $this->_file = $file;
    }
    
    /**
     * set Set data to view
     * 
     * @param string $key
     * @param mix $value
     */
    public function set($key, $value)
    {
        $this->_data[$key] = $value;
    }
    
     /**
     * set Get data by key
     * 
     * @param string $key
     */
    public function get($key)
    {
        return $this->_data[$key];
    }

    public function content()
    {
        if (!file_exists($this->_file))
        {
            throw new Exception("View " . $this->_file . " doesn't exist.");
        }
        
        extract($this->_data);
        ob_start();
        include($this->_file);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;   
    }

    public function __toString()
    {
        return $this->content();
    }
    
    /**
     * output Output view contents
     * 
     * @return string
     */
    public function output()
    {
        $output = $this->content();
        echo $output;
    }
}