<?php
namespace Core\App;

class Database{
    public $db;
    public $prefix;
    
    public function run(){
        $this->connect();
    }
    
    private function connect(){
        include_once dirname(__FILE__).'/../config/config.php';    
        try {
            $this->db = new \PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'], $db['user'], $db['password']);
            $this->db->exec("SET NAMES utf8");
            $this->prefix=$db['prefix'];
        } catch (\PDOException $e) {
            echo "Error db!: " . $e->getMessage();
            exit();
        }
        unset($db);
    }
}