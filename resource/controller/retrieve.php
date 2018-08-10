<?php
	
	namespace cliqsFrameWork\retrieve;
	
	include_once('../../bootstrap/pageinit.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\ic\yall as me;
	use cliqsFrameWork\ic\connect as connectme;
	use cliqsFrameWork\ic\performance as ivalid;
	use cliqsFrameWork\ic\records as record;


	$me			=	new me();
	$connect	=	new connectme();
	$check  	=	new ivalid();
	$record  	=	new record();

			
			
		$rv=(int)filter_var(strip_tags(trim($_POST['retrieveid'])),FILTER_VALIDATE_INT);
		
		if($rv==1){
			
			$lga=$check->sanitize($_POST['lga']);
			$record->land($lga,2);

		}else if($rv==2){
			
			$pillar=$check->sanitize($_POST['pillar']);
			$record->land($pillar,3);			
			
		}else if($rv==3){
			
			$sale=$check->sanitize($_POST['isale']);
			$record->land($sale,4);
			
		}else if($rv==4){
			
			$sale=$check->sanitize($_POST['isale']);
			$record->landcart($sale,1);

		}else if($rv==5){
			
			$sale=$check->sanitize($_POST['csale']);
			$record->land($sale,5);			
			
			}
			
		
		
	
	exit();
?>