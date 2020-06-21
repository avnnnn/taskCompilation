<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
 <html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>TASK COMPILATE</title>
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="/template/css/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<div id="menu-wrapper">
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="/task">Homepage</a></li>
				<li><a href="/task/create">Create Task</a></li>
				<?php 
				    if(!empty($_SESSION['user'])){
				        echo '<li><a href="/task/logout">LogOut</a></li>';
				    }
				    else{
				?>

				<li><a href="/task/login">Log In</a></li>
				<li><a href="/task/registration">Registration</a></li>
			    <?php }?>
			</ul>
		</div>    
	</div>
	<div id="wrapper">
    	<div id="header-wrapper">
	       	<div id="header">
		    	<div id="logo">
				<h1><a href="#">Create Task </a></h1>
			</div>
		</div>
	</div>
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">


                    <form method="post">  
                    Author<br>
                    <input type="text" name = "auth"><br>
                
                    Email<br>
                
                    <input type="text" name = "email"><br>
                     
                    Description<br>
                    <textarea name="desc" cols="50" rows="5"></textarea><br>
                    <input type="submit" name="createSubmit" value="submit">
                    </form>
    	
                </div>
				<!-- end #content -->
			
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
</body>
