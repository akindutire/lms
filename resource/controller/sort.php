<?php
	
	namespace cliqsFrameWork\sort;
	
	include_once('../../bootstrap/pageinit.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\ic\yall as me;
	use cliqsFrameWork\ic\connect as connectme;
	use cliqsFrameWork\ic\performance as ivalid;
	

	$me			=	new me();
	$connect	=	new connectme();
	$check  	=	new ivalid();
	
	$sortid=(int)filter_var(strip_tags(trim($_POST['sortid'])),FILTER_VALIDATE_INT);
			
			if($sortid==1){
				
				//$record->searchmember($section,$sort);
			
			}else if($sortid==2){
				
				
			}else if($sortid==3){
				
				
			}else if($sortid==4){
				
				
			}else if($sortid==5){
				
				
			}else if($sortid==6){
				
				
			}else if($sortid==7){
				
				
			}
			
	
	
exit();	
?>