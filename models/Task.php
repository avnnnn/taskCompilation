<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class Task
{
        
    public static function getTaskList($start)
    {   
 
         $db = Db::getConnection();
        $taskList = array();
        $limit = 3;
        $startpoint = ($start-1)*3;
        if(isset($_POST['sortsubmit'])){
            $_SESSION['sort'] = $_POST['sort'];
             $result = $db ->query("SELECT * FROM tasks ORDER BY ". $_POST['sort']."  LIMIT $startpoint, 3 ");
        }
        else{
            $result = $db ->query("SELECT * FROM tasks  LIMIT $startpoint, 3 ");

        }            
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $i = 0;
        while($row = $result->fetch())
        {
            $taskList[$i]['id'] = $row['id'];
            $taskList[$i]['task_author'] = $row['task_author'];
            $taskList[$i]['email'] = $row['email'];
            $taskList[$i]['task_description'] = $row['task_description'];
            $taskList[$i]['task_date'] = $row['task_date'];
            $taskList[$i]['task_status'] = $row['task_status'];
            $taskList[$i]['edited'] = $row['edited'];
            $i++;
        }
        return $taskList;
    }
    public static function getTaskById($id){
        $id = intval($id);
        $db = Db::getConnection();
        $res =$db ->query('SELECT * FROM tasks WHERE id = '.$id);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $task = $res->fetch();
        return $task;
    }
    public static function createTask()
    {
        $db = Db::getConnection();
        if(isset($_POST["createSubmit"]))
        {
            $sql='INSERT INTO tasks (id,task_author, email, task_date, task_status,task_description,edited)
                    VALUES(?,?,?,?,?,?,?)';
            $stmt = $db -> prepare($sql);
            $res = $db->query('SELECT max(id) from tasks');
            $res = $res->fetch();
            if(is_null($res)){
                $id = 1;
            }
            else{
                $id = $res[0]+1;
            }
            $author =  $_POST['auth'];
            $email = $_POST['email'];
            $task_date = date('Y-m-d');
            $task_status = 'not finished';
            $description = $_POST['desc'];
            $corr = true;
            if (empty($author) or empty($description) or !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $corr = false;
            }
            if($corr){
                $stmt-> execute([$id,$author,$email,$task_date,$task_status,$description,0]);
                echo '<script>alert("Task succesfully added")</script>'; 
                $page = ceil($id/3);
                echo "<script type='text/javascript'>window.top.location='/task/1';</script>"; exit;

            }
            else{
                echo '<script>alert("Task datas wrong filled")</script>'; 

            }
        }
    }
    public static function editTask($id){
        $db = Db::getConnection();
        if(isset($_POST['editSubmit'])){
            $sql = "UPDATE tasks SET task_description = ?, task_status = ?, edited = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            $res = $db->query('SELECT * from tasks where id = '.$id);
            $res = $res->fetch();
            if($_SESSION['user']=='admin' and ($res['task_status'] != $_POST['stat'] or $res['task_description'] != $_POST['edesc'])){
                $stmt->execute([$_POST['edesc'],$_POST['stat'],1, $id]);
            }
            if(empty($_SESSION['user'])){
                echo '<script>alert("Log in first")</script>'; 
                echo "<script type='text/javascript'>window.top.location='/task/login';</script>"; exit;
   
            }
        }   
    }
}