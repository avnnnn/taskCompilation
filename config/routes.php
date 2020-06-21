<?php
return array(
    'news/([0-9]+)' => 'news/view/$1/$2',
	'news' => 'news/index',    
 	'task/registration' => 'task/registration',
	'task/login' =>'task/login',
	'task/logout' =>'task/logout',
 	'task/create' => 'task/create',
	'task/edit/([0-9]+)' => 'task/edit/$1',
	'task/([0-9]+)' => 'task/index/$1',
	'task' => 'task/index/1',
    '' => 'task/index/1'
 	); 