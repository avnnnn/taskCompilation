<?php
if(isset($_SESSION)){
    session_start();
} 
include_once ROOT.'/models/Task.php';
include_once ROOT.'/models/User.php';

class TaskController {
	public function actionIndex($page)
		{
 		    $taskList = array();
		    $taskList = Task::getTaskList($page);
            if(isset($_POST['sortsubmit'])){
    		    $sort = $_SESSION['sort'];}
		    require_once(ROOT.'/views/task/index.php');
		 
		    
 			return true;
		}
    public function actionCreate()
    {
         require_once(ROOT.'/views/task/create.php');
        Task::createTask();

        
        return true;
    }
	    public function actionRegistration(){
        require_once(ROOT.'/views/task/registration.php');
        User::registration();
        return true;
    }
    public function actionEdit($id){
        if($id){
            $task = Task::getTaskById($id);
            require_once(ROOT.'/views/task/edit.php');
        }
        Task::editTask($id);
        if(isset($_POST['editSubmit'])){
            echo "<script type='text/javascript'>window.top.location='/task/edit/$id';</script>"; exit;
        }
 
        return true;
    }
    public function actionLogout(){
        User::logout();

        header('Location: /task');exit;
        return true;
    }
    public function actionLogin(){
        if(!empty($_SESSION['user'])){
            header('Location: /task');
            exit();
        }
        require_once(ROOT.'/views/task/login.php');

        User::login();
        if(!empty($_SESSION['user'])){
            echo "<script type='text/javascript'>window.top.location='/task';</script>"; exit;

        }
        return true;
    }
}
?>