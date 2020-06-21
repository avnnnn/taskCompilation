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
				    if(isset($_SESSION['user'])){
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
                    
					<div class="post">
						<h2 class="title">Email: <?php echo $task['email'].' # '.$task['id'];?>
                        </h2>
						<p class="meta">Posted by <?php echo $task['task_author'];?> on <?php echo $task['task_date'];?>
							&nbsp;&bull;&nbsp; <a class="permalink"> Status: <?php echo $task['task_status'] ?></a></p>
						<div class="entry">
							<p><?php echo htmlspecialchars($task['task_description']);?></p>
						</div>

					</div>
					<br>
					Status
					<br>
					<br>
					
					
					<select name="stat" id="stat">
					    <				            <option value="finished"<?php
				            if($task["task_status"]=="finished")
				            {
				                ?>selected = "selected"<?php
				            }
				            ?>>finished</option>
				            <option value="not finished"<?php
				            if($task['task_status']=="not finished")
				            {
				                ?>selected = "selected"<?php
				            }
				            ?>>not finished</option>
					</select>
					<br>
					<br>
                    Description
                    <br>
                    <br>
					
                    <textarea name="edesc" cols="50" rows="5"><?php echo $task['task_description']; ?></textarea><br>
                    <input type="submit" name="editSubmit" value="submit">
                    </form>
    	
                </div>
				<!-- end #content -->
			
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
</body>
