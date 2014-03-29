<?php
namespace Core\Controller;

class Post{ 
    public $app;
    
    /**
     * List posts
     */
    public function actionList(){
        $this->app->pagetitle='Должности';        
        $error=array();
        
        if ($this->app->formGet('delete') && $this->app->formGet('id')){
            $sth = $this->app->pdo->db->prepare("SELECT COUNT(*) FROM {$this->app->pdo->prefix}employee WHERE post_id=:id");
            $sth->bindParam(':id', $this->app->formGet('id'), \PDO::PARAM_INT);                
            if (!$sth->execute()){
                echo 'Select db error!';
                exit;
            }
            if ($sth->fetchColumn()){
                $error['message']='Нельзя удалить, у работника стоит должность!'; 
            }else{
                $sth = $this->app->pdo->db->prepare("DELETE FROM {$this->app->pdo->prefix}post WHERE id=:id");
                $sth->bindParam(':id', $this->app->formGet('id'), \PDO::PARAM_INT);
                if (!$sth->execute()){
                    echo 'delete db error!';
                    exit;
                }
                $this->app->redirect('post/');
            }
        }
        
        $sth = $this->app->pdo->db->prepare("SELECT * FROM {$this->app->pdo->prefix}post");
        if (!$sth->execute()){
            echo 'Select db error!';
            exit;  
        }
        $result=$sth->fetchAll();
        $this->app->render('post',array('result'=>$result,'error'=>$error));
    }
    
    /**
     * Add Post
     */
    public function actionAdd(){
        $this->app->pagetitle='Добавить должности';        
        $error=Array();
        
        if (isset($_POST['post_form'])){
            $name=$this->app->formPost('name');
            $description=$this->app->formPost('description');
            if (!$name){
                $error['name']='Поле пустое!'; 
            }
        
            if (!count($error))
            {
                $sth = $this->app->pdo->db->prepare("INSERT INTO {$this->app->pdo->prefix}post (name,description) VALUES (:name,:description)");
                $sth->bindParam(':name', $name, \PDO::PARAM_STR, 64);
                $sth->bindParam(':description', $description, \PDO::PARAM_STR, 255);
                if (!$sth->execute()){
                    echo 'Insert db error!';
                    exit;
                }
                $this->app->redirect('post/');
            }
        }
        
        $this->app->render('post_form',array('error'=>$error));
    }
    
    /**
     * Edit Post
     */
    public function actionEdit(){
        $this->app->pagetitle='Изменить должность';        
        $error=Array();
        
        if (isset($_POST['post_form'])){        
            if ($id=$this->app->formPost('id')){
                $name=$this->app->formPost('name');              
                $description=$this->app->formPost('description');
                if (!$name){
                    $error['name']='Поле пустое!'; 
                }
            
                if (!count($error))
                {                
                    $sth = $this->app->pdo->db->prepare("UPDATE {$this->app->pdo->prefix}post SET name=:name,description=:description WHERE id=:id");
                    $sth->bindParam(':name', $name, \PDO::PARAM_STR, 64);
                    $sth->bindParam(':description', $description, \PDO::PARAM_STR, 255);
                    $sth->bindParam(':id', $id, \PDO::PARAM_INT);         
                    if (!$sth->execute()){
                        echo 'Update db error!';
                        exit;
                    }
                    $this->app->redirect('post/');
                }
            }
        }
        
        if (!$id=$this->app->formGet('id')){
            $this->app->redirect('post/');
        }
        
        //Check
        $sth = $this->app->pdo->db->prepare("SELECT * FROM {$this->app->pdo->prefix}post WHERE id=:id");
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        if (!($sth->execute()) or (!$result=$sth->fetch())){
            $this->app->redirect('post/');
        }
        
        $this->app->render('post_form',array('result'=>$result,'edit'=>1,'error'=>$error));
    }    
}