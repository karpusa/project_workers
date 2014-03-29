<?php
namespace Core\App;

use Core\App\Database;
use Core\App\Routing;

class Application{ 
    private $routing;
    private $data;
    public $pdo;
    public $pagetitle='';
    
    public function run(){
        
        $this->pdo=new Database();
        $this->pdo->run();
        
        $this->routing=new Routing();
        $this->routing->run();

        $class = 'Core\Controller\\' . $this->routing->controller;
        $controller=new $class();
        $controller->app=$this;
        $controller->{$this->routing->action}();
          
    }
    
    public function render($template='',$data=Array()){
        $wrapper=$this->renderPartial($template,$data);
        
        require(dirname(__FILE__).'/../theme/layout.php');
    }  
    
    public function renderPartial($template='',$data=Array()){
        $this->data=$data;
        $filename=dirname(__FILE__).'/../theme/'.$template.'.php';
        if (!file_exists($filename)){
            echo 'Not found template: '.$template;
            exit;
        }
        ob_start();
        require($filename);
        $wrapper = ob_get_contents();
        ob_end_clean();
        return $wrapper;
    }
    
    public function isErrorField($fieldname){
        if (isset($this->data['error'][$fieldname])){
            return $this->data['error'][$fieldname];
        }
        return false;
    }
        
    public function formPost($name,$default_value=''){
        if (!isset($_POST[$name])){
            return $default_value;
        }
        return $_POST[$name];
    }
    
    public function formGet($name){
        if (!isset($_GET[$name])){
            return ;
        }
        return $_GET[$name];
    }
    
    public function formAscDesc($field){
        if (($this->formGet('field')==$field) && ($this->formGet('sort')=='asc')){
            return 'desc';
        }else{
            return 'asc';
        }
    }
    
    public function redirect($page){
        if ($this->getIsAjaxRequest()){
            $response['redirect']="http://{$_SERVER['HTTP_HOST']}/$page";
            echo json_encode($response); 
            exit();
        }        
        header("Location: http://{$_SERVER['HTTP_HOST']}/$page");

    }
    
    public function getIsAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest';
    }    
}