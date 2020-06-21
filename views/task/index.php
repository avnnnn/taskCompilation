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
		<!-- end #menu -->
	</div>

<div id="wrapper">
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<h1>Task Compilation  </h1>
				<h1>Hello <?php 
				    if(!empty($_SESSION['user'])){
                        echo$_SESSION['user'];
				    }?> </h1>

			</div>
		</div>
	</div>
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
				    <form method ='POST'action = 'http://t77845a1.beget.tech/task/' >
				        Sort by: 
				        <select name="sort" id="sort">
				            <option value="task_author ASC"<?php
				            if($sort=="task_author ASC")
				            {
				                ?>selected = "selected"<?php
				            }
				            ?>>Author ASC</option>
				            <option value="email ASC"<?php
				            if($sort=="email ASC")
				            {
				                ?>selected = "selected"<?php
				            }
				            ?>>Email ASC</option>
				            <option value="task_status ASC"<?php
				            if($sort=="task_status ASC")
				            {
				                ?>selected = "selected"<?php
				            }
				            ?>>Status ASC</option>
				            <option value="task_author DESC"<?php
				            if($_POST["sort"]=="task_author DESC")
				            {
				                ?>selected = "selected"<?php
				            }
				            ?>>Author DESC</option>
				            <option value="email DESC"<?php
				            if($sort=="email DESC")
				            {
				                ?>selected = "selected"<?php
				            }
				            ?>>Email DESC</option>
				            <option value="task_status DESC"<?php
				            if($sort=="task_status DESC")
				            {
				                ?>selected = "selected"<?php
				            }
				            ?>>Status DESC</option>
				        </select>
                        <input type="submit"name ='sortsubmit' value="Submit">

				    </form>
				    
					<?php
					
					foreach ($taskList as $task):

					?>
					<div class="post">
						<h2 class="title">Email: <?php echo $task['email'].".";
						                            if($task['edited']){
						                                echo '  Edited by Admin';
						                            }
						                            if(!empty($_SESSION['user'])){
						                                if ($_SESSION['user'] == 'admin'){
						                                     echo "<a href='/task/edit/".$task['id']."'>Edit</a>";
						                                }}?>
                        </h2>
						<p class="meta">Posted by <?php echo $task['task_author'];?> on <?php echo $task['task_date'];?>
							&nbsp;&bull;&nbsp; <a class="permalink"> Status: <?php echo $task['task_status'] ?></a></p>
						<div class="entry">
							<p><?php echo htmlspecialchars($task['task_description']);?></p>
						</div>
					</div>
				<?php endforeach;
				 
 				 include(ROOT."/template/pagination/pagination.php");

				     $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
                     $page_num = count($taskList)/3;
                    $limit =3;
                    $startpoint = ($page * $limit) - $limit;
	            	$db = Db::getConnection();
	            	$statement = 'tasks';
	            	$res=$db->query("select * from {$statement} LIMIT {$startpoint} , {$limit}");

                        echo "<div id='pagingg' >";
                        echo pagination($statement,$limit,$page);
                        echo "</div>";            	
            	?>


				</div>
				<!-- end #content -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>
<div id="footer">
    <p>BEEJEE TEST</p>
</div>
<!-- end #footer -->
</body>
</html>
