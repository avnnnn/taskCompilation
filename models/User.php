<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class User
{
    public static function logIn(){
        if(isset($_POST["loginSubmit"])){
            $db = Db::getConnection();
            $res =$db->query("SELECT * FROM users WHERE user_name = \"".$_POST['name']."\"");
            $res = $res->fetch();
            
                if(empty($_POST['pass']) or empty($_POST['name'])){
                    echo "<script type='text/javascript'>alert('Fill the blanks');</script>";
                }
                if($_POST['pass'] != $res['user_password']){
                    echo "<script type='text/javascript'>alert('Username or Password is incorrect');</script>";

                }
                else{
                    $_SESSION['user'] = $_POST['name'];
                 }
            }
        
    }
    public static function logOut(){
        $_SESSION['user']= "";
        
    }
    public static function registration(){
        if(isset($_POST["registrationSubmit"]))
        {
            $db = Db::getConnection();
            $sql='INSERT INTO users (id,user_name, user_email, user_password, privilegies)
                    VALUES(?,?,?,?,0)';
            $stmt = $db -> prepare($sql);
            $res = $db->query('SELECT max(id) from users');
            $res = $res->fetch();
            if(is_null($res)){
                $id = 1;
            }
            else{
                $id = $res[0]+1;
            }
            $user = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $stmt-> execute([$id,$user,$email,$pass]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo '<script>alert("Email is incorrect")</script>'; 

            }else{
                echo '<script>alert("User succesfully joint")</script>'; 
                echo "<script type='text/javascript'>window.top.location='/task/login';</script>"; exit;
            }
        }
    }
}
?>