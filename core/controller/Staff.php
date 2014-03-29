<?php
namespace Core\Controller;

class Staff{ 
    public $app;
    
    /**
     * List staff
     */    
    public function actionList(){
        $this->app->pagetitle='Работники';
        
        if ($this->app->formGet('delete') && $this->app->formGet('id')){
            $sth = $this->app->pdo->db->prepare("DELETE FROM {$this->app->pdo->prefix}employee WHERE id=:id");
            $sth->bindParam(':id', $this->app->formGet('id'), \PDO::PARAM_INT);
            if (!$sth->execute()){
                echo 'delete db error!';
                exit;
            }
            $this->app->redirect('staff/');
        }
        
        $order='ORDER BY id ASC';
        if (($field=$this->app->formGet('field')) && ($sort=$this->app->formGet('sort'))){
            $sort_fields=(
                array(
                    'name'=>1
                    ,'surname'=>1        
                    ,'post_name'=>1
                    ,'salary'=>1                     
                )
            );
            if (isset($sort_fields[$field])){
                $order='ORDER BY '.$field.' '.$sort;
            }
        }
        
        $sth = $this->app->pdo->db->prepare("SELECT e.id, e.name, e.surname, e.salary, p.name as post_name FROM {$this->app->pdo->prefix}employee as e LEFT JOIN {$this->app->pdo->prefix}post as p on p.id=e.post_id $order");
        if (!$sth->execute()){
            echo 'Select db error!';
            exit;  
        }
        $result=$sth->fetchAll();
        $this->app->render('staff',array('result'=>$result));
    }
    
    /**
     * Add staff
     */
    public function actionAdd(){
        $this->app->pagetitle='Добавить работника';        
        $error=Array();
        
        if (isset($_POST['staff_form'])){
            $name=$this->app->formPost('name');
            $surname=$this->app->formPost('surname');
            $salary=$this->app->formPost('salary');   
            $post_id=$this->app->formPost('post_id');
            $description=$this->app->formPost('description');             
            if (!$name){
                $error['name']='Поле пустое!'; 
            }
            if (!$surname){
                $error['surname']='Поле пустое!'; 
            }
            if ($salary){
                if (!filter_var($salary, FILTER_VALIDATE_FLOAT)){
                    $error['salary']='Не верное число!'; 
                }
            }
            if (!$post_id){
                $error['post_id']='Выберите должность!'; 
            }else{
                $sth = $this->app->pdo->db->prepare("SELECT COUNT(*) FROM {$this->app->pdo->prefix}post WHERE id=:post_id");
                $sth->bindParam(':post_id', $post_id, \PDO::PARAM_INT);                
                if (!$sth->execute()){
                    echo 'Select db error!';
                    exit;
                }
                if (!$sth->fetchColumn()){
                    $error['post_id']='Выберите должность!'; 
                }
            }
            
            if (!count($error))
            {
                $sth = $this->app->pdo->db->prepare("INSERT INTO {$this->app->pdo->prefix}employee (name,surname,post_id,salary,description) VALUES (:name,:surname,:post_id,:salary,:description)");
                $sth->bindParam(':name', $name, \PDO::PARAM_STR, 128);
                $sth->bindParam(':surname', $surname, \PDO::PARAM_STR, 128);
                $sth->bindParam(':post_id', $post_id, \PDO::PARAM_INT); 
                $sth->bindParam(':salary', ($salary)?strval($salary):NULL, \PDO::PARAM_STR);
                $sth->bindParam(':description', $description, \PDO::PARAM_STR);                
                if (!$sth->execute()){
                    echo 'Insert db error!';
                    exit;
                }
                $this->app->redirect('staff/');
            }
        }
        
        $sth = $this->app->pdo->db->prepare("SELECT id,name FROM {$this->app->pdo->prefix}post ORDER BY name ASC");
        if (!$sth->execute()){
            echo 'Select db error!';
            exit;
        }
        $post_list=$sth->fetchAll();
        
        if ($this->app->getIsAjaxRequest()){
            $response['content']=$this->app->renderPartial('staff_form',array('error'=>$error,'post_list'=>$post_list));
            echo json_encode($response); 
            exit();
        }
        $this->app->render('staff_form',array('error'=>$error,'post_list'=>$post_list));
    }
    
    /**
     * Edit Staff
     */
    public function actionEdit(){
        $this->app->pagetitle='Изменить работника';           
        $error=Array();
        
        if (isset($_POST['staff_form'])){        
            if ($id=$this->app->formPost('id')){
                $name=$this->app->formPost('name');
                $surname=$this->app->formPost('surname');
                $salary=$this->app->formPost('salary');   
                $post_id=$this->app->formPost('post_id');
                $description=$this->app->formPost('description');             
                if (!$name){
                    $error['name']='Поле пустое!'; 
                }
                if (!$surname){
                    $error['surname']='Поле пустое!'; 
                }
                if ($salary){
                    if (!filter_var($salary, FILTER_VALIDATE_FLOAT)){
                        $error['salary']='Не верное число!'; 
                    }
                }
                if (!$post_id){
                    $error['post_id']='Выберите должность!'; 
                }else{
                    $sth = $this->app->pdo->db->prepare("SELECT COUNT(*) FROM {$this->app->pdo->prefix}post WHERE id=:post_id");
                    $sth->bindParam(':post_id', $post_id, \PDO::PARAM_INT);                
                    if (!$sth->execute()){
                        echo 'Select db error!';
                        exit;
                    }
                    if (!$sth->fetchColumn()){
                        $error['post_id']='Выберите должность!'; 
                    }
                }
            
                if (!count($error))
                {                
                    $sth = $this->app->pdo->db->prepare("UPDATE {$this->app->pdo->prefix}employee SET name=:name,surname=:surname,post_id=:post_id,salary=:salary,description=:description WHERE id=:id");
                    $sth->bindParam(':name', $name, \PDO::PARAM_STR, 128);
                    $sth->bindParam(':surname', $surname, \PDO::PARAM_STR, 128);
                    $sth->bindParam(':post_id', $post_id, \PDO::PARAM_INT); 
                    $sth->bindParam(':salary', ($salary)?strval($salary):NULL, \PDO::PARAM_STR);
                    $sth->bindParam(':description', $description, \PDO::PARAM_STR);
                    $sth->bindParam(':id', $id, \PDO::PARAM_INT);                     
                    if (!$sth->execute()){
                        echo 'Update db error!';
                        exit;
                    }

                    $this->app->redirect('staff/');                    
                }
            }
        }
        
        if (!$id=$this->app->formGet('id')){
            $this->app->redirect('staff/');
        }
        
        //Check
        $sth = $this->app->pdo->db->prepare("SELECT * FROM {$this->app->pdo->prefix}employee WHERE id=:id");
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
     
        if (!($sth->execute()) or (!$result=$sth->fetch())){
            $this->app->redirect('staff/');
        }
        
        $sth = $this->app->pdo->db->prepare("SELECT id,name FROM {$this->app->pdo->prefix}post ORDER BY name ASC");
        if (!$sth->execute()){
            echo 'Select db error!';
            exit;
        }
        $post_list=$sth->fetchAll();
              
        if ($this->app->getIsAjaxRequest()){
            $response['content']=$this->app->renderPartial('staff_form',array('result'=>$result,'edit'=>1,'post_list'=>$post_list,'error'=>$error));
            echo json_encode($response); 
            exit();
        }        
        $this->app->render('staff_form',array('result'=>$result,'edit'=>1,'post_list'=>$post_list,'error'=>$error));
    }    
    
}