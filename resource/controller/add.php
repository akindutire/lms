<?php
	
	namespace cliqsFrameWork\add;
	
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


		$ad=(int)filter_var(strip_tags(trim($_POST['addid'])),FILTER_VALIDATE_INT);
		if($ad==1){

			$bk=(string)trim(ucwords(stripslashes($_POST['block'])));
			$lga=(int)trim(stripslashes($_POST['lga']));
			$me->addlayout($bk,$lga);


				redirect('../../admin/index.php?q=landreg');
			

		}else if($ad==2){

			$owner=(string)trim($check->sanitize($_POST['owner']));
			$layout=(int)trim($check->sanitize($_POST['layout']));
			$lga=(int)trim($check->sanitize($_POST['lga']));
			$saddr=trim($check->sanitize($_POST['saddr']));
			$mail=trim($_POST['mail']);
			$tel=($check->sanitize($_POST['tel']));
			$inheritedby='No Inheritance';
			$actype=($check->sanitize($_POST['actype']));
			
			if(filter_var($mail,FILTER_VALIDATE_EMAIL) && is_string($owner)){

				$me->addowner($layout,$lga,$saddr,$mail,$tel,$inheritedby,$owner,$actype);
				
				
					redirect("../../admin/index.php?q=addowner&lid=$layout");

			}else{

				echo "Invalid Input";
			}

		}else if($ad==3){

			$pillar=(string)trim($check->sanitize($_POST['pillar']));
			$dim=(string)trim($check->sanitize($_POST['dim']));
			$amt=(int)trim($check->sanitize($_POST['amt']));
			$inheritance=trim($check->sanitize($_POST['inheritedby']));

			$sale_id=trim($check->sanitize($_POST['sale_id']));
			$layout=trim($check->sanitize($_POST['layout']));
			$lga=trim($check->sanitize($_POST['lga']));

				$me->addland($pillar,$dim,$amt,$inheritance,$sale_id,$layout,$lga);
				
				redirect("../../admin/index.php?q=addland&sid=$sale_id");



		}else if($ad==4){
			
			$pillar=trim($check->sanitize($_POST['pillar']));
			
			$sale_id=trim($check->sanitize($_POST['isale']));
			
				$me->addtolandcart($pillar,$sale_id);
				
				//redirect("../../admin/index.php?q=translandowner");


		}else if($ad==5){
			
			$seller=trim($check->sanitize($_POST['sellersaleid']));
			
			$buyer=trim($check->sanitize($_POST['buyersaleid']));
			
				$me->transferland($seller,$buyer);
		}


?>