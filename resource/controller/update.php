<?php

	namespace cliqsFrameWork\update;
	
	include_once('../../bootstrap/pageinit.php');
	include_once('../class/users.php');
	
	use cliqsFrameWork\ic\yall as me;
	use cliqsFrameWork\ic\connect as connectme;
	use cliqsFrameWork\ic\performance as ivalid;
	
	


	$me			=	new me();
	$connect	=	new connectme();
	$check  	=	new ivalid();
	
	function redirect($url){

				$url=filter_var($url,FILTER_SANITIZE_URL);

				header("location:$url");
	}
	
		$up=$_POST['upid'];
		if($up==1){
			//Update Land
			
			$sale_id=(int)$check->sanitize(trim(abs($_POST['saleid'])));
			$id=(int)$check->sanitize(trim(abs($_POST['landid'])));
			$amt=$check->sanitize(trim(abs($_POST['amt'])));
			$dim=(string)$check->sanitize(trim($_POST['dim']));

			
			if(filter_var($amt,FILTER_VALIDATE_INT)){

				$me->updateland($amt,$dim,$id);
				

			}else{

				die("Restricted Access");
			}

			
		}else if($up==2){

			//Update Owner
			
			$layout=(int)$check->sanitize(trim(abs($_POST['layout'])));

			$id=(int)$check->sanitize(trim(abs($_POST['ownerid'])));
			$mail=$check->sanitize(trim($_POST['mail']));
			$addr=(string)$check->sanitize(trim($_POST['addr']));
			$tel=(string)$check->sanitize(trim($_POST['tel']));
			
			if(filter_var($mail,FILTER_VALIDATE_EMAIL)){

				$me->updateowner($layout,$mail,$addr,$tel,$id);
				

			}else{

				die("Restricted Access");
			}
			
		}else if($up==3){

			//Update Password
			
			$ipwd=sha1($check->sanitize($_POST['ipwd']));

			$npwd=sha1($check->sanitize($_POST['npwd']));
			$cpwd=sha1($check->sanitize($_POST['cpwd']));
			
			
				$me->cpp($ipwd,$npwd,$cpwd);
				
			
		}else if($up==5){
			
		}else if($up==6){
			
		}else if($up==7){
			
		}else if($up==8){
			
		}else if($up==9){
			
		}
	


?>