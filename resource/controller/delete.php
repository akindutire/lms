<?php
	
	namespace cliqsFrameWork\delete;
	
	include_once('../../bootstrap/pageinit.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\ic\yall as me;
	use cliqsFrameWork\ic\connect as connectme;
	use cliqsFrameWork\ic\performance as ivalid;
	
	


	$me			=	new me();
	$connect	=	new connectme();
	$check  	=	new ivalid();
	

		$dv=(int)filter_var(strip_tags(trim($_POST['deleteid'])),FILTER_VALIDATE_INT);
		
		if($dv==1){
			
			$id=$check->sanitize($_POST['id']);

			$me->deletefromlandcart($id);

		}else if($dv==2){
			


		}else if($dv==3){
			
			
		}

exit();
?>