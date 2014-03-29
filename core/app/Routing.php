<?php
namespace Core\App;

class Routing{
    public $controller;
    public $action;
    public $suffix='/';
    
    private $request;
    
    public function run(){
        $this->init();
    }
    
    private function init(){
        include_once dirname(__FILE__).'/../config/routing.php';
        if (!isset($routing)){
            echo 'No "routing" in routing.php!';
            exit;
        }
        if (!isset($default)){
            echo 'No "default" routing in routing.php!';
            exit;
        }    
        $this->request=$default;
  
        if (isset($_GET['q']) && $_GET['q'] && isset($routing[$_GET['q']])){
            $this->request=$_GET['q'];
        }elseif (isset($_GET['q']) && ($_GET['q'])){
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: /");
        } 
        $this->controller=$routing[$this->request]['controller'];
        $this->action=$routing[$this->request]['action'];
    }
}