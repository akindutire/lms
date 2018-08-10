<?php
	
	namespace cliqsFrameWork\fupload;
	
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
	
	
	define(IMG, "http://".$_SERVER['HTTP_HOST']."/$project/images/content");


	$me			=	new me();
	$connect	=	new connectme();
	$check  	=	new ivalid();
	
	function compress_image($source,$destination,$quality){
	
		$info=getimagesize($source);

			if($info['mime']=='image/jpeg'){

				$image=imagecreatefromjpeg($source);
	
			}else if($info['mime']=='image/gif'){

				$image=imagecreatefromgif($source);

			}else if($info['mime']=='image/png'){

				$image=imagecreatefrompng($source);

			}

		imagejpeg($image,$destination,$quality);
		return $destination;

	}



	$name=strtolower($check->sanitize($_FILES['file']['name']));
	$type=$_FILES['file']['type'];
	$size=(int)($_FILES['file']['size']);
	$tmp=$_FILES['file']['tmp_name'];
	

	
	
	if(@getimagesize($tmp)){	/*Check If file is image*/
	
		$arraytype=array('image/jpeg','image/jpg','image/png');
		
		if(!empty($name)){	/*Check If file empty*/
			
			if(in_array($type,$arraytype)){		/*does file have demanded extension*/

				if($size<=(800*1024) and !empty($size)){	/*Check if filesize is below assigned Limit *****thing*byte(1024), 1024byte==1kb*/


					#Append Upload timestamp to file to avoid data Collision
					$filename=md5(time().$_SESSION['token']).$name;
					
					#Move file to web filesytem
					if(move_uploaded_file($tmp,$config['realdir']['upds']['remove']."/$filename")){
						
						#Compress File to Save Bandwidth
						compress_image($config['realdir']['upds']['remove']."/$filename",$config['realdir']['upds']['compress']."/$filename",80);


					
						#Assign A Session to File For Global Reasons
						$_SESSION['funame']=$filename;

						
						#Create A Thumbnail;
						
						
						//Return A FLAG As Success in its Upload
						echo $config['flag']['sx'];



						}else{
							printf("<img src='%scancel.png' width='auto' height='13px'>System Error: Couldn't Complete File Submission",IMG);
							}
					
					
					}else{
						printf("<img src='%scancel.png' width='15px' height='15px'>&nbsp;File too large, upload below 800kb",IMG);
						}
			}else{
				printf("<img src='%scancel.png' width='15px' height='15px'>&nbsp;Unsupported File format, Suggest Using jpeg,jpg or gif file",IMG);
				}
		}else{
			printf("<img src='%scancel.png' width='15px' height='15px'>&nbsp;No File Selected",IMG);
			}
	}else{
		printf("<img src='%scancel.png' width='15px' height='15px'>&nbsp;Please Upload A Real Image File",IMG);
		}
exit();	
?>