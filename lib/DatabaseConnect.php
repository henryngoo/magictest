<?php
/**
 * Magic Test is a smaple test project, it used to check the code style and quality in PHP programming.
 *
 * @author Phuong Ngo <fuongit@gmail.com>
 * @copyright 2015 Magic Test
 * @version 1.0
 * 
 */

class DatabaseConnect {
    
    /**
     * __construct Init Database
     */
    public function __construct() {
        $this->startDatabase();
    }
    
    /**
     * __destruct Close Database Connection
     */
    public function __destruct() {
        $this->endDatabase();
    }
    
    /**
     * getSingleValue Get single value from query
     * 
     * @param  string $query
     * @return mix
     */
    public function getSingleValue($query) {
        $resultSet = mysql_query($query);  
        $values = mysql_fetch_row($resultSet);  
        return $values[0]; 
    }
    
    /**
     * getSingleArray Get a single array from query
     * 
     * @param  string $query
     * @return array
     */
    public function getSingleArray($query) {
        $resultSet = mysql_query($query);  
        $values = mysql_fetch_array($resultSet);  
        return $values; 
    }
    
    /**
     * getArrays Get list of array
     * 
     * @param  string $query
     * @return array
     */
    public function getArrays($query) {
        $result = array();
        $resultSet = mysql_query($query); 
        while($row = mysql_fetch_array($resultSet, MYSQL_ASSOC)) {
            $result[] = $row;
        } 
        return $result; 
    }

    /**
     * setQuery Set query
     * @param string $query
     */
    private function setQuery($query) {
        return mysql_query($query);
    }
    
    /**
     * startDatabase Create a database connection
     */
    private function startDatabase() {
        mysql_connect(DB_URL, DB_USERNAME, DB_PASSWORD);
        mysql_select_db(DB_NAME) or die('Unable to connect database');
    }
    
    /**
     * endDatabase Close database connection
     */
    private function endDatabase() {
        mysql_close();
    }

    /**
     * getFields Get all fields of a table
     * 
     * @param  string $table Table name will be to fetch
     * @return array An array contains all of table fields
     */
    public function getFields($table) {
        $query = "SHOW FIELDS FROM $table";
        $fields = $this->getArrays($query);
        $results = array();
        foreach ($fields as $key => $value) {
            $results[] = $value['Field'];
        }
        return $results;
    }

    /**
     * getAttributeNames
     * 
     * @param  string $table Table name will be to fetch
     * @return array An array contains all of table fields
     */
    public function getAttributeNames($table) {
        $fileds = $this->getFields($table);
        $results = array();
        foreach ($fields as $key => $value) {
            $results[$value] =  ucwords(strtolower(preg_replace('/_/', ' ', $value)));
        }
        return $results;
    }
    
    /**
     * secureSuperGlobalGET Clean up all values of $_GET
     */
    public function secureSuperGlobalGET(&$value, $key) {
        $_GET[$key] = htmlspecialchars(stripslashes($_GET[$key]));
        $_GET[$key] = str_ireplace("script", "blocked", $_GET[$key]);
        $_GET[$key] = mysql_escape_string($_GET[$key]);
        return $_GET[$key];
    }

    /**
     * secureSuperGlobalPOST Clean up all values of $_POST
     */
    public function secureSuperGlobalPOST(&$value, $key) {
        $_POST[$key] = htmlspecialchars(stripslashes($_POST[$key]));
        $_POST[$key] = str_ireplace("script", "blocked", $_POST[$key]);
        $_POST[$key] = mysql_escape_string($_POST[$key]);
        return $_POST[$key];
    }

    /**
     * secureGlobals Clean up all values of $_GET and $_POST
     */
    public function secureGlobals() {
        array_walk($_POST, array($this, 'secureSuperGlobalPOST'));
    }
    
    /**
     * save Create new row or update exsting row from a table
     * 
     * @param  string $table
     * @param  array  $params
     * @return mix
     */
    public function save($table, $params = array()) {
        $tbFields = $this->getFields($table);
        foreach ($params as $key => $value) {
            if (!in_array($key, $tbFields)) {
                unset($params[$key]);
            }
        }
        if (empty($params['id'])) {
            $fields = array_keys($params);
            foreach ($fields as $key => $value) {
                $fields[$key] = "`$value`";
            }
            $fields = implode(",", $fields);
            $values = array();
            foreach ($params as $key => $value) {
                $values[] = "'". $value ."'";
            }
            $values = implode(",", $values);
            $query = "INSERT INTO $table($fields) VALUES($values)";
        } else {
            $sets = array();
            foreach ($params as $key => $value) {
                $sets[] = "`$key`='$value'";
            }
            $sets = implode(", ", $sets);
            $query = "UPDATE `$table` SET $sets WHERE id={$params['id']}";
            //echo $query;
        }
        if (mysql_query($query)) {
            return mysql_insert_id();
        }
        return false;
    }
}