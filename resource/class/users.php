<?php

namespace cliqsFrameWork\ic;

define('EXKIT','../resource/tracks/exp.bmp');
define('UPKIT','../resource/tracks/update.txt');
define('SIKIT','../resource/tracks/silent.bmp');
define('RELOCATEKITDIRECTORY','../resource/cache/silent.bmp');
define('IMG','../images/content/');


/*-----------------------------------------
|	This Class Makes Database Connection
|------------------------------------------
|
|
*/


class connect{
	
	public static function iconnect(){

		global $config;
		
		
		$def 	=	$config['con']['default'];

		if($def=='mysqli'){

			$link	=	mysqli_connect(	$config['con'][$def]['host'] , $config['con'][$def]['username'] , $config['con'][$def]['password'] , $config['con'][$def]['database']	);
		}
			
			if($link){
				

				return $link;
			
			}else{
			
				die("System Currently Not Available, Try Again Later");
			
				}
		}
	
}


/*-----------------------------------------
|	This Class Create Database Query
|-------------------------------------------
|
|
*/

class createQuery{

	public static function redirect($url){

				$url=filter_var($url,FILTER_SANITIZE_URL);

				header("location:$url");
			}


	public static function insert($table,$db){

		//$link=connect::iconnect();

		$dbfield=array();		
		$variable=array();

		$idbf='';
		$ivar='';
		$sql='';
		$i=0;
		
		foreach ($db as $dbval => $prval) {
			
			array_unshift($dbfield, $dbval);
				
			array_unshift($variable, $prval);

		}

		$all_size=count($dbfield);
		
		$sql.="INSERT INTO $table(";
		
			while($dbf=array_shift($dbfield)){

				$i++;
				$idbf.=$i==$all_size?$dbf:$dbf.',';			
				
			}			

		$sql.=$idbf;

		$sql.=") VALUES(";
			
			$i=0;
			while($var=array_shift($variable)){

				$i++;
				$ivar.=$i==$all_size? "'".$var."'":"'".$var."'".',';

			}	
		
		$sql.=$ivar.")";

		return $sql;
	}

	public static function stmtinsert($table,$db){


		$dbfield=array();		
		$variable=array();

		$idbf='';
		$slot='';
		$sql='';
		$i=0;
		
		foreach ($db as $dbval => $prval) {
			
			array_unshift($dbfield, $dbval);
				
		}

		$all_size=count($dbfield);
		
		$sql.="INSERT INTO $table(";
		
			while($dbf=array_shift($dbfield)){

				$i++;
				$idbf.=$i==$all_size?$dbf:$dbf.',';			
				
			}			

		$sql.=$idbf;

		$sql.=") VALUES(";
			
			
			for($i=0;$i<$all_size;$i++){
				
				$c='?';
				$slot.=$i==($all_size-1)?$c:$c.',';

			}	

		
		$sql.=$slot.")";

		return $sql;

	}

	public static function delete($table,$db,$binder,$type=1){

		$dbfield=array();		
		$idbf='';
		$sql='';
		$i=0;
		

		if($type==1){

			foreach ($db as $dbval => $prval) {
			
				array_unshift($dbfield, $dbval);
				
			}

			$all_size=count($dbfield);
		
			$sql.="DELETE FROM $table WHERE ";
		
			while($dbf=array_shift($dbfield)){

				$i++;
				$idbf.=$i==$all_size?"$dbf='$db[$dbf] '":"$dbf='$db[$dbf]' $binder ";			
				
			}			

		$sql.=$idbf;


		}else{

			$sql.="DELETE FROM $table";

		}
		
		return $sql;

	}

	public static function truncate($table){

		$sql="TRUNCATE $table";
		return $sql;
	}

	public static function select($table,$db,$binder,$type=1){

		$dbfield=array();		
		$idbf='';
		$sql='';
		$i=0;
		

		if($type==1){

			foreach ($db as $dbval => $prval) {
			
				array_unshift($dbfield, $dbval);
				
			}
			
			$all_size=count($dbfield);
		
			$sql.="SELECT * FROM $table WHERE ";
		
			while($dbf=array_shift($dbfield)){

				$i++;
				$idbf.=$i==$all_size?"$dbf='$db[$dbf]'":"$dbf='$db[$dbf]' $binder ";			
				
			}			

			$sql.=$idbf;


		}else{

			$sql.="SELECT * FROM $table";

		}
		
		return $sql;
	}

	public static function update($table,$db,$dbcond,$binder,$type=1){

		$dbfield=array();
		$icond=array();		
		$idbf='';
		$iconf='';
		$sql='';
		$i=0;
		

		

			foreach ($db as $dbval => $prval) {
			
				array_unshift($dbfield, $dbval);
				
			}

			
			$all_size=count($dbfield);
			
			
			$sql.="UPDATE $table SET ";
		
				while($dbf=array_shift($dbfield)){

					$i++;
					$idbf.=$i==$all_size?"$dbf='$db[$dbf]'":"$dbf='$db[$dbf]',";			
				
				}			

				$sql.=$idbf;

			if($type==1){

				foreach ($dbcond as $dbval => $condval) {
			
					array_unshift($icond, $dbval);
					
				}

				$sql.="WHERE ";

				$cond_size=count($icond);
				$i=0;
				while($icon=array_shift($icond)){

					$i++;
					$iconf.=$i==$cond_size?"$icon='$dbcond[$icon]' ":"$icon='$dbcond[$icon]' $binder ";			
				
				}			

				$sql.=$iconf;

				return $sql;

			}else{

				return $sql;
				
			}		
			
	}
}


/*-----------------------------------------
|	This Class Checks The System Integrity
|-------------------------------------------
|
|
*/

class performance{
	
	public function sanitize($var,$type=0){
		
		if($type==0){

			$var=htmlentities(stripslashes(strip_tags($var)));
		
		}else{

			$var=abs(htmlentities(stripslashes(strip_tags($var))));
		}
		

		return $var;

	}


	public function checkSys(){
		
		$link=connect::iconnect();

		$db=array(

			'st'	=>	1

			);

		$query=createQuery::select('performancetab',$db,'AND',1);

		$sql=mysqli_query($link,$query) or die('101xFc: Unknown Reference');



		list($id,$start,$exp,$istatus,$lastmin)=mysqli_fetch_row($sql);
	
		if(mysqli_num_rows($sql)==0 && file_exists(EXKIT)==false){ 
		
			$this->createTrial(6);

		}else if(file_exists(EXKIT)==false){
		
			$this->repairTrial($exp,$lastmin);
		
		}else if($exp=='LP'){
		
			echo '';
		
		}else{
			
			$this->updateTrial($exp,$lastmin);
		
			}

	}
	
	//Inter Fc
	
	private function createTrial($trial){
		$link=connect::iconnect();
		
		//@Db Salt;
		$salt='cliqsdiamond';
		
		
		$start=date(time());
		$exp=date(strtotime("+ $trial month"));
		
		$fd=fopen(EXKIT,"w+");
		fwrite($fd,$exp);
		fclose($fd);
		
		$db=array(

			'lm'	=>	$start,
			'st'	=>	1,
			'tg'	=>	$exp,
			'ifr'	=>	$start,
			'id'	=>	'NULL'

			);

		$query=createQuery::insert('performancetab',$db);

		mysqli_query($link,$query);

	}
	
	private function repairTrial($exp,$lastmin){
		
		$link=connect::iconnect();

		$fd=fopen(EXKIT,"w+");
		fwrite($fd,$exp);
		fclose($fd);


		$db=array(

			'lm'	=>	$lastmin

			);

		$dbcond=array(

			'st'	=>	1,
			'id'	=>	1

			);

		$query=createQuery::update('performancetab',$db,$dbcond,'AND',1);
		mysqli_query($link,$query);

		
		}
	
	private function updateTrial($exp,$lastmin){
		
		$link=connect::iconnect();
		$inow=date('d M Y, H:i a',time());
		
		$now=date(time());
		
			if($lastmin>$now){

				die('System/PC Time Inaccurate, Please Adjust Your Date,$inow');
			
			}else if($now>=$lastmin){
				
				file_exists(SIKIT)?'':die('Application Error: Some Modules Unable To Load, 01xfxc1');
				
				if($now>$exp){
							
					@rename(SIKIT,RELOCATEKITDIRECTORY);
					die('Unexpected Reference 101xF, Strongly Recommend Contacting App Provider.');
						
				}else{
					$new_min=date(time());
					
					$db=array(

						'lm'	=>	$new_min

					);

					$dbcond=array(

						'st'	=>	1,
						'id'	=>	1

					);

					$query=createQuery::update('performancetab',$db,$dbcond,'AND',1);


					mysqli_query($link,$query);
				}	
			}
		}
	
	
	public function AppWriter($data){
		
		$time=date('d M Y, H:i a',time());
		$data="[$time]->$data\n
		----------------------------------------------------------------------------------";
		
		
		file_exists(UPKIT)?'':die('Application Error: Unable  To Load Modules, 01xfxc2');
		
		$fd=fopen(UPKIT,'a+');
		fwrite($fd,$data);
		fclose($fd);
	}
	//End Inter Fc
		
}





/*----------------------------------------------------------------------------------------------------------------------------*/


/*-----------------------------------------
|	This Class is Called YALL .
|------------------------------------------
|	Coz it takes care of all basic functions and routing on the app
|
*/

class yall{
	
	public function login($usr,$pwd){
		global $config;

		$link=connect::iconnect();
		
		$db=array(
			
			'bk'		=>	0,
			'password'	=>	mysqli_real_escape_string($link,$pwd),
			'mat'		=>	mysqli_real_escape_string($link,$usr)
			
			);

		$query=createQuery::select('users',$db,'AND',1);

		$sql=mysqli_query($link,$query);
		
		if(mysqli_num_rows($sql)==1){
			
			//$data="$usr LOGGED IN Through ".$_SERVER['HTTP_USER_AGENT'].' On A '.$_SERVER['HTTP_CONNECTION'].' Connection';
			
			$_SESSION['iusr']=$usr;
			$_SESSION['ipwd']=$pwd;
			
			//performance::AppWriter($data);
			echo $config['flag']['sx'];

		}else{
			
			printf("<img src='%scancel.png' width='auto' height='14px'>&nbsp;Invalid Combination",IMG);
			
			}
		
		}
		
	public function getdata(){
		global $config;

		$link=connect::iconnect();
		
		$usr=$_SESSION['iusr'];
		$pwd=$_SESSION['ipwd'];	
		$db=array(
			
			'password'	=>	mysqli_real_escape_string($link,$pwd),
			'mat'		=>	mysqli_real_escape_string($link,$usr)
			
			);

		
			$query=createQuery::select('users',$db,'AND',1);
		
			$sql=mysqli_query($link,$query);
		
			list($id,$role,$e,$e,$e,$e,$e,$e,$e,$e)=mysqli_fetch_row($sql);
			$_SESSION['role']=$role;
			
			return $id;
		}
		
		
	public function logout($admin){
		global $config;
		
			
			$_SESSION[]=array();
			session_unset();
			
			$usr=$_SESSION['iusr'];
			
			

		if($admin!=1){

			createQuery::redirect($config['view']['root']);
	
		}else{
			
			createQuery::redirect($config['view']['root']);
			
			}

		}	
		
	
	public function verifylogin($role,$logintypeID){
		global $config;

		$usr_id=$this->getdata();
		$role=ucfirst($role);

			
		if($_SESSION['role']==$role ){
			
			echo '';
			
		}else{
				if($logintypeID==null)
					$this->logout();
				else
					$this->logout(1);
			}		
		}
		
	public function haveexternalrights(){
		global $config;
		
		$link=connect::iconnect();

		$usr_id=$this->getdata();
		
		$db=array(
			
			'id'	=>	mysqli_real_escape_string($link,$usr_id)
			
			);

		$query=createQuery::select('users',$db,'AND',1);
		$sql=mysqli_query($link,$query);
		
		list($e,$e,$e,$e,$e,$e,$e,$e,$e,$ex)=mysqli_fetch_row($sql);
			
			return $ex;
		}
	

	//Add to block
	public function addlayout($a,$b){
		
		global $config;
		$link=connect::iconnect();
		
		/**************Checking item Existence*********/
		
		$db=array(
				'block'	=>	$a
			);
		
		$query=createQuery::select('block',$db,'AND',1);


		$checkit=mysqli_query($link,$query) or die('System Error');

		if(mysqli_num_rows($checkit)>0 && !empty($a)){
		
			die('This block has been registered, try another block name');
		
		}
		
		/**************Validations**********************/


		
		
		/*----------------------*********Registering item by Preparing A Query*************************-----------*/
		$db_stmt=array(

			'block'		=>	'NULL',
			'lga_id'	=>	'NULL',
			'id'		=>	'NULL'
			);

		$query=createQuery::stmtinsert('block',$db_stmt);
		echo $query;
		$sql=mysqli_prepare($link,$query);
		
		
		$e='';
		
		mysqli_stmt_bind_param($sql,'iis',$e,$b,$a);
		
		mysqli_stmt_execute($sql) or die('System Error');
		
	}


	public function addowner($layout,$lga,$saddr,$mail,$tel,$inheritedby,$owner,$actype){
		global $config;

		$link=connect::iconnect();

		$isql=mysqli_query($link,"SELECT MAX(id) FROM owner");
		list($mid)=mysqli_fetch_row($isql);


		$io=mysqli_query($link,"SELECT tel FROM owner WHERE tel='$tel' AND layout='$layout'");
		
		if(mysqli_num_rows($io)==1){
			die('Phone ID already Existing, suggest using another one');
		}

		$sale_id=mt_rand(1000,9999)+rand()."$mid";

		$db=array(

			'actype'		=>	mysqli_real_escape_string($link,$actype),
			'pix'			=>	$_SESSION['funame'],
			'inheritance'	=>	mysqli_real_escape_string($link,$inheritedby),
			'lga'			=>	mysqli_real_escape_string($link,$lga),
			'mail'			=>	mysqli_real_escape_string($link,$mail),
			'sale_id'		=>	mysqli_real_escape_string($link,$sale_id),
			'addr'			=>	mysqli_real_escape_string($link,$saddr),
			'tel'			=>	mysqli_real_escape_string($link,$tel),
			'name'			=>	mysqli_real_escape_string($link,$owner),
			'layout'		=>	mysqli_real_escape_string($link,$layout),
			'id'			=>	'NULL'
			
			);
		
		$sql=mysqli_query($link,createQuery::insert('owner',$db)) or die('System Error');

		rename($config['realdir']['upds']['compress'].'/'.$_SESSION['funame'], $config['realdir']['upds']['profile']['m'].'/'.$_SESSION['funame']);
		
	}


	public function addland($pillar,$dim,$amt,$inheritance,$sale_id,$layout,$lga){
		global $config;
		
		$link=connect::iconnect();

		$isql=mysqli_query($link,"SELECT * FROM plots WHERE pillar='$pillar' AND lay_id='$layout'");
		if(mysqli_num_rows($isql)==1){

			die("Pillar ID already existing");

		}

		$db=array(

			'inheritance'	=>	$inheritance,
			'sale_id'		=>	$sale_id,
			'pillar'		=>	$pillar,
			'amount'		=>	$amt,
			'size'			=>	$dim,
			'limg'			=>	'NULL',
			'lay_id'		=>	$layout,
			'lga_id'		=>	$lga,
			'id'			=>	'NULL'

			);
		$dbhistory=array(
			'amt'			=>	'Gift Equivalence',
			'mode_of_inh'	=>	$inheritance,
			'date'			=>	date(time()),
			'ito'			=>	mysqli_real_escape_string($link,$sale_id),
			'ifrom'			=>	'Nature',
			'pillar'		=>	$pillar,
			'id'			=>	'NULL'
						
			);
			
		
		$sql=mysqli_query($link,createQuery::insert('plots',$db)) or die("System Error, Please Retry");
		
		mysqli_query($link,createQuery::insert('history',$dbhistory));

	}


	public function updateland($amt,$dim,$id){
		global $config;

		$link=connect::iconnect();

		$db=array(

			'size'		=>	mysqli_real_escape_string($link,$dim),
			'amount'	=>	mysqli_real_escape_string($link,$amt)	

			);

		$dbcond=array(

			'id'		=>	mysqli_real_escape_string($link,$id)	

			);

		$query=createQuery::update('plots',$db,$dbcond,'AND',1);
		$sql=mysqli_query($link,$query);

		echo  "Updated";

	}

	
	public function addtolandcart($pillar,$sale){
		global $config;
		$link=connect::iconnect();
		
		$db=array(

			'pillar'	=>	$pillar,
			'sale_id'	=>	$sale,
			'id'		=>	'NULL'
			
			);
		
		$db_param_check_land_existence=array(
			'pillar'	=>	$pillar,
			'sale_id'	=>	$sale
		);
		$isql=mysqli_query($link,createQuery::select('landcart',$db_param_check_land_existence,'AND',1));
		
		if(mysqli_num_rows($isql)==1){
			echo "<b style='color:red'>Land Already On Sale List</b>";
		}else{
		
			$sql=mysqli_query($link,createQuery::insert('landcart',$db));

			if ($sql) {
			
				echo $config['flag']['sx'];

			}else{

				echo "System Error, Please Retry";
			}
		}
	}
	
	public function deletefromlandcart($id){
		global $config;
		$link=connect::iconnect();
		
			$db=array(
				'id'	=>	$id
			);
		
			$sql=mysqli_query($link,createQuery::delete('landcart',$db,'AND',1));
			if($sql){
				echo $config['flag']['sx'];
			}
		
	}
	
	public function transferland($a,$b,$flag=1){
		global $config;
		$link=connect::iconnect();
		$db=array(
			'sale_id'	=>	mysqli_real_escape_string($link,$a)
		);
		
			$sql=mysqli_query($link,createQuery::select('landcart',$db,'AND',1));
			
			if(mysqli_num_rows($sql)>0){
			while(list($id,$sale_id,$pillar)=mysqli_fetch_row($sql)){
					
					$dbgetplot=array(
						'pillar'		=>	$pillar
					);
					
					$eisql=mysqli_query($link,createQuery::select('plots',$dbgetplot,'AND',1));
					list($id,$e,$layout,$e,$size,$amt,$e,$e,$e)=mysqli_fetch_row($eisql);

					$dbhistory=array(
						'amt'			=>	$amt,
						'mode_of_inh'	=>	'Sale',
						'date'			=>	date(time()),
						'ito'			=>	mysqli_real_escape_string($link,$b),
						'ifrom'			=>	mysqli_real_escape_string($link,$a),
						'pillar'		=>	$pillar,
						'id'			=>	'NULL'
						
					);
					$dbpayment=array(
						
						'amt'			=>	$amt,
						'size'			=>	$size,
						'st'			=>	1,
						'date'			=>	date(time()),
						'pillar'		=>	$pillar,
						'buyer'			=>	mysqli_real_escape_string($link,$b),
						'seller'		=>	mysqli_real_escape_string($link,$a),
						'id'			=>	'NULL'
						
					);
					$dbplotcond=array(
				
						'pillar'		=>	$pillar,
						'sale_id'		=>	mysqli_real_escape_string($link,$a)
						
					);
					$dbplotsetvar=array(
				
						'inheritance'	=>	'Sale',
						'sale_id'		=>	mysqli_real_escape_string($link,$b),
						'amount'		=>	'0'
						
					);
					
					mysqli_query($link,createQuery::insert('history',$dbhistory));
	
					mysqli_query($link,createQuery::insert('payment',$dbpayment));

					mysqli_query($link,createQuery::truncate('invoice'));

					mysqli_query($link,createQuery::insert('invoice',$dbpayment));
					
					mysqli_query($link,createQuery::update('plots',$dbplotsetvar,$dbplotcond,'AND',1));
					
				
				}
				
					$dbdeletecond=array(
						'sale_id'		=>	mysqli_real_escape_string($link,$a)
					);
					
					mysqli_query($link,createQuery::delete('landcart',$dbdeletecond,'AND',1));
					
					echo $config['flag']['sx'];
			}else{
				echo "No Order Made";
				}
		
		}

	public function updateowner($layout,$mail,$addr,$tel,$id){

		global $config;

		$link=connect::iconnect();

		$db=array(

			'mail'		=>	mysqli_real_escape_string($link,$mail),
			'addr'		=>	mysqli_real_escape_string($link,$addr),
			'tel'		=>	mysqli_real_escape_string($link,$tel)

			);

		$dbchk=array(

			'tel'		=>	mysqli_real_escape_string($link,$tel),
			'layout'	=>	mysqli_real_escape_string($link,$layout)

			);
		$dbcond=array(

			'id'		=>	mysqli_real_escape_string($link,$id)	

			);


		$isql=mysqli_query($link,createQuery::select('owner',$dbchk,'AND',1));
		
		if(mysqli_num_rows($isql)==0){

			$sql=mysqli_query($link,createQuery::update('owner',$db,$dbcond,'AND',1));

			echo  "Updated";
			
		}else{

			echo "Please Try Using Another Tel. No.";
		}
		
	}


	public function cpp($ipwd,$npwd,$cpwd){

		global $config;
		$link=connect::iconnect();

		$db=array(
			
			'password'	=>	mysqli_real_escape_string($link,$ipwd)

			);


		$sql=mysqli_query($link,createQuery::select('users',$db,'AND'));

		if(mysqli_num_rows($sql)==1 && $_SESSION['ipwd']==$ipwd){

			if($cpwd==$npwd){

				$dbparam=array(

					'password'	=>	$npwd
					
				);

				$dbchcond=array(
					
					'id'	=>	$this->getdata()
					
				);

				$isql=mysqli_query($link,createQuery::update('users',$dbparam,$dbchcond,'AND'));
				if ($isql) {
						
						$this->logout(1);

					}else{

						echo "System Error";
					}

			}

		}else{

			echo "Please Provide A Real Passkey Of This Account";
		}

	}

	public function addsomething($a){

		global $config;
		$link=connect::iconnect();
		
		$db=array(

			'dbfield'	=>	'parameter',
			'dbfield'	=>	'parameter',
			'dbfield'	=>	'parameter',
			'dbfield'	=>	'parameter',

			);

		if ($sql) {
			
			echo $config['flag']['sx'];

		}else{

			echo "System Error, Please Retry";
		}
	}


}

/*-------------------------------------------------------------------------
|	This Class is Called Records .
|--------------------------------------------------------------------------
|	be it admin or client ,this class always retrieve 
|	any stored process or data from our default data-
|	base	made earliar on YALL
|
*/


class records{
	
	public function layouts($vb){
		global $config;

		$link=connect::iconnect();
		$db=array();
		$query=createQuery::select('block',$db,'AND',0);

		$sql=mysqli_query($link,$query);
		
		
		while(list($id,$ilga,$block)=mysqli_fetch_row($sql)){
			
			$db1=array(

				'id'	=>	$ilga

				);
			$query1=createQuery::select('lga',$db1,'AND',1);

			$in_sql=mysqli_query($link,$query1);

			list($e,$lga)=mysqli_fetch_row($in_sql);
			
			
			echo "
				<div class='column_w300_section_01'>
                 
                <div class='news_content'>";
                    
                if($vb==1){

                	echo "<div class='header_04'><a href='index.php?q=addowner&lid=$id'>$block    ($lga)</a></div>";
                
                }else if($vb==2){

                	echo "<div class='header_04'><a href='index.php?q=list&lid=$id'>$block    ($lga)</a></div>";

                }else if($vb==3){

                	echo "<div class='header_04'><a href='index.php?q=updateland&lid=$id'>$block    ($lga)</a></div>";

                }else if($vb==4){

                	echo "<div class='header_04'><a href='index.php?q=allocateland&lid=$id'>$block    ($lga)</a></div>";

                }else if ($vb==5) {
                	
                	echo "<div class='header_04'><a href='index.php?q=allocated.php&lid=$id'>$block    ($lga)</a></div>";

                }

                    
                    
            echo"

            	</div>
                                
                	<div class='cleaner'></div>
            	</div>";

			}		
		}
	
	public function owner($a,$b,$flag){
		global $config;

		$link=connect::iconnect();

		$db=array(

			'layout'	=>	$a,
			'lga'		=>	$b

			);

		if($flag==1){

			$query=createQuery::select('owner',$db,'AND',1);
			$sql=mysqli_query($link,$query) or die('System Error');
			
			while(list($id,$e,$name,$tel,$addr,$sale_id,$e,$e,$e,$pic,$actype)=mysqli_fetch_row($sql)){
				
				$src=$config['dir']['upds']['profile']['m']."/$pic";
				$update="<a onclick=window.open('index.php?q=updateownerinfo&id=$id','','width=800,height=500')>Update Info</a>";
				echo "
				<div class='column_w300_section_01'>
                 
                <div class='news_content' style='float:left;'>
                    <div class='news_image_wrapper' style='border-radius:5px;'>
                	<img src='$src' height='60px' width='auto' alt='image' />
                	
                </div>
   				
   				<div class='news_content' style='float:right; margin-top:4px; margin-left:2px;'>
                	<div class='header_04' ><a href='index.php?q=addland&sid=$sale_id'>$name</a></div>
                	<p>$tel</p>
                	<p>$addr</p>
                	<p>$sale_id ($actype Account)</p>
                	<p>$update</p>

                </div>
            	</div>
                                
                	<div class='cleaner'></div>
            	</div>";


			}
			
		}
	}	


	public function land($a,$flag){
		global $config;

		$link=connect::iconnect();


		if($flag==1 && $a!=''){
			
			$db=array(

			'sale_id'	=>	$a

			);
			
			$query=createQuery::select('plots',$db,'AND',1);
			$sql=mysqli_query($link,$query) or die('System Error');
			
			while(list($id,$e,$e,$e,$size,$amt,$pillar,$e,$inh)=mysqli_fetch_row($sql)){

				echo "
				<div class='column_w300_section_01'>
                 
                <div class='news_content'>
                    
   					
                	<div class='header_04'><a title='Update Info' onclick=window.open('index.php?q=updateland&pid=$id&sid=$a','','width=800,height=500')>$pillar</a></div>
                	<p>N$amt</p>
                	<p>$size</p>
                	<p>$inh</p>

            	</div>
                                
                	<div class='cleaner'></div>
            	</div>";


				}
			}else if($flag==2){
				
				echo "<tr>
				
					<td>Layout</td>
					<td>Pillar No.</td>
					<td>Owner Addr.</td>
					<td>Tel.</td>
					<td>Amount</td>
					<td>Size</td>
					<td>Inheritance</td>
					<td>History</td>
					
				</tr>";
				
				
				$db=array(
					'lga_id'	=>	$a
				);
				
					
	
				$sql=mysqli_query($link,createQuery::select('plots',$db,'AND',1));
				while(list($id,$e,$lay_id,$e,$size,$amt,$pillar,$sale_id,$inh)=mysqli_fetch_row($sql)){
				
				$dbowner=array(
					'sale_id'	=>	$sale_id
				);
				
				$dblayout=array(
					'id'	=>	$lay_id
				);	
				
				$history="<a title='History' onclick=window.open('index.php?q=history&hid=$pillar','','width=800,height=400')><img src='../images/content/history.png' height='14px' width='auto'></a>";
				
					$isql=mysqli_query($link,createQuery::select('owner',$dbowner,'AND',1));
					list($id,$e,$name,$tel,$addr,$sale_id,$e,$e,$e,$pic)=mysqli_fetch_row($isql);
					
					$lsql=mysqli_query($link,createQuery::select('block',$dblayout,'AND',1));
					list($id,$e,$layout,)=mysqli_fetch_row($lsql);
					
					
					echo "<tr>
						
						<td>$layout</td>
						<td>$pillar</td>
						<td>$addr</td>
						<td>$tel</td>
						<td>N$amt</td>
						<td>$size</td>
						<td>$inh</td>
						<td>$history</td>
						
					</tr>";
					
					}
			}else if($flag==3){
				
				echo "<tr>
					<td>#</td>
					<td>Layout</td>
					<td>Pillar No.</td>
					<td>Owner Addr.</td>
					<td>Tel.</td>
					<td>Amount</td>
					<td>Size</td>
					<td>Inheritance</td>
					<td>History</td>
					
				</tr>";
				
				
				$db=array(
					'pillar'	=>	$a
				);
				
					
	
				$sql=mysqli_query($link,createQuery::select('plots',$db,'AND',1));
				while(list($id,$e,$lay_id,$e,$size,$amt,$pillar,$sale_id,$inh)=mysqli_fetch_row($sql)){

				$history="<a title='History' onclick=window.open('index.php?q=history&hid=$pillar','','width=800,height=400')><img src='../images/content/history.png' height='14px' width='auto'></a>";
				
				$dbowner=array(
					'sale_id'	=>	$sale_id
				);
				
				$dblayout=array(
					'id'	=>	$lay_id
				);	
				
				
				
					$isql=mysqli_query($link,createQuery::select('owner',$dbowner,'AND',1));
					list($id,$e,$name,$tel,$addr,$sale_id,$e,$e,$e,$pic)=mysqli_fetch_row($isql);
					
					$lsql=mysqli_query($link,createQuery::select('block',$dblayout,'AND',1));
					list($id,$e,$layout,)=mysqli_fetch_row($lsql);
					
					$pic=$config['dir']['upds']['profile']['m'].'/'.$pic;					
					
					echo "<tr>
						<td><a href='$pic' target='_blank'><img src='$pic' width='auto' height='30px'></td>
						<td>$layout</td>
						<td>$pillar</td>
						<td>$addr</td>
						<td>$tel</td>
						<td>N$amt</td>
						<td>$size</td>
						<td>$inh</td>
						<td>$history</td>
					</tr>";
					
					}
			}else if($flag==4){
				
				
				
				echo "<tr>
				
					<td>#</td>
					<td>Layout</td>
					<td>Pillar No.</td>
					<td>Amount</td>
					<td>Size</td>
					
				</tr>";
				
				
				$db=array(
					'sale_id'	=>	$a
				);
				$addurl=$config['control']['add'];
	
				$sql=mysqli_query($link,createQuery::select('plots',$db,'AND',1));
				while(list($id,$e,$lay_id,$e,$size,$amt,$pillar,$sale_id,$inh)=mysqli_fetch_row($sql)){
								
				$dblayout=array(
					'id'	=>	$lay_id
				);	
				
					
					$lsql=mysqli_query($link,createQuery::select('block',$dblayout,'AND',1));
					list($id,$e,$layout,)=mysqli_fetch_row($lsql);
										
					
					echo "
					<tr>
						<input type='hidden' name='addid' value='4'>
						<input type='hidden' name='isale' value='$a'>
						<td><a id='chkland' data-pillar='$pillar' title='Transfer to a pending owner'><img src='../images/content/addtolandcart.png' height='20px' width='auto'></a></td>
						<td>$layout</td>
						<td>$pillar</td>
						<td>N$amt</td>
						<td>$size</td>
												
					</tr>
					";	
					}
			}else if($flag==5){

				echo "<tr>
					<td>#</td>
					<td>Layout</td>
					<td>Pillar No.</td>
					<td>Owner Addr.</td>
					<td>Tel.</td>
					<td>Amount</td>
					<td>Size</td>
					<td>Inheritance</td>
					<td>History</td>
					
				</tr>";
				
				
				$db=array(
					'sale_id'	=>	$a
				);
				
				echo "<input type='hidden' name='sale' value='$a'>";
					
	
				$sql=mysqli_query($link,createQuery::select('plots',$db,'AND'));

				while(list($id,$e,$lay_id,$e,$size,$amt,$pillar,$sale_id,$inh)=mysqli_fetch_row($sql)){

				$history="<a title='History' onclick=window.open('index.php?q=history&hid=$pillar','','width=800,height=400')><img src='../images/content/history.png' height='14px' width='auto'></a>";
				
				$dbowner=array(
					'sale_id'	=>	$sale_id
				);
				
				$dblayout=array(
					'id'	=>	$lay_id
				);	
				
				
				
					$isql=mysqli_query($link,createQuery::select('owner',$dbowner,'AND',1));
					list($id,$e,$name,$tel,$addr,$sale_id,$e,$e,$e,$pic)=mysqli_fetch_row($isql);
					
					$lsql=mysqli_query($link,createQuery::select('block',$dblayout,'AND',1));
					list($id,$e,$layout,)=mysqli_fetch_row($lsql);
					
					$pic=$config['dir']['upds']['profile']['m'].'/'.$pic;					
					
					echo "<tr>
						<td><input type='checkbox' name='land[]' value='$pillar'></td>
						<td>$layout</td>
						<td>$pillar</td>
						<td>$addr</td>
						<td>$tel</td>
						<td>N$amt</td>
						<td>$size</td>
						<td>$inh</td>
						<td>$history</td>
					</tr>";
					
					}

			}
		}
		
		public function landcart($sale,$flag){
			global $config;
			$link=connect::iconnect();
			
				if($flag==1){
					
					$db=array(	
						'sale_id'	=>	$sale
					);
					
					$sql=mysqli_query($link,createQuery::select('landcart',$db,'AND',1));
					while(list($yid,$e,$pillar)=mysqli_fetch_row($sql)){
						
						$dbcond=array(
							'pillar'	=>	$pillar
						);
						
						$csql=mysqli_query($link,createQuery::select('plots',$dbcond,'AND',1));
						list($id,$e,$lay_id,$e,$size,$amt,$pillar,$sale_id,$inh)=mysqli_fetch_row($csql);
						
						$remove="<a title='Delete From List' id='deletefromcart' style='cursor:pointer;' data-id='$yid' data-sale='$sale_id'><img src='../images/content/cancel.png' height='10px'></a>";
						echo "
						<div class='column_w300_section_01'>
                 
                		<div class='news_content'>
                    
   					
                		<div class='header_04'>$remove&nbsp;<a>$pillar</a></div>
                		<p>N$amt</p>
                		<p>$size</p>

            	</div>
                                
                	<div class='cleaner'></div>
            	</div>";
						
						}
					
					}
				if(mysqli_num_rows($sql)>0){					
				
				$proceed="<a title='Transfer' id='transferfromcart' style='cursor:pointer;'><img src='../images/content/proceed.png' height='45px'></a>";
				
				$createsaleid="<a title='Create New Sale ID' id='createnewid' style='cursor:pointer;' onclick=window.open('index.php?q=landreg','','width=1000,height=400')><img src='../images/content/createsaleid.png' height='45px'></a>";
				
				
				echo "<div class='column_w300_section_01'>
                 
                		<div class='news_content'>
                    
   					
                		<div class='header_04'><center>$proceed&nbsp;<a>$createsaleid</a></center></div>
                	
					</div>
                                
                	<div class='cleaner'></div>
            		</div>";
			
			}
		}
		
		public function getLandReceipt($sale){
			global $config;
			
			$link=connect::iconnect();
			$sum=0;
			$db=array(
				
				'buyer'	=>	$sale
			
			);	
			
			echo "<tr>
				
					<td>#</td>
					<td>Pillar No.</td>
					<td>Size</td>
					<td>Amount</td>
					
				</tr>";
				
			
			$sql=mysqli_query($link,createQuery::select('invoice',$db,'AND',1));

			while(list($id,$seller,$buyer,$pillar,$date,$st,$size,$amt)=mysqli_fetch_row($sql)){
				$sum+=$amt;
				$date=date('jS F  Y',$date);
				echo "
					<tr>
						<td>$date</td>
						<td>$pillar</td>
						<td>$size</td>
						<td>$amt</td>
					</tr>
				
				";
				
				}
				echo "
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>$sum</td>
					</tr>
				";		
				echo "Generated on".	date('jS F  Y',time());
		
		}
		
		public function historyof($pillar){
			global $config;
			
			$link=connect::iconnect();
			
			$db=array(
				'pillar'		=>	$pillar
			);
			
			$sql=mysqli_query($link,createQuery::select('history',$db,'AND',1));
			while(list($id,$pillar,$ifrom,$ito,$date,$hereditory_mode,$amt)=mysqli_fetch_row($sql)){
			
			$dbfrom=array(
				'sale_id'		=>	$ifrom
			);
			
			$dbto=array(
				'sale_id'		=>	$ito
			);
			
			$fsql=mysqli_query($link,createQuery::select('owner',$dbfrom,'AND',1));
			list($id,$e,$sellername,$e,$selleraddr,$e,$e,$e,$e,$e,$actypeg)=mysqli_fetch_row($fsql);
			
			$tsql=mysqli_query($link,createQuery::select('owner',$dbto,'AND',1));
			list($id,$e,$buyername,$e,$buyeraddr,$e,$e,$e,$e,$e,$actype)=mysqli_fetch_row($tsql);
				
			$date=date('jS F Y',$date);
				
				if($ifrom=='Nature'){
					echo "
					<div class='content_section_01'>
            			On $date $buyername Acquired A land From Nature With A Pillar No. Of <b>$pillar</b> On A Platform Of $hereditory_mode Agreement. 
            		</div><br>";
				}else{
					if ($actype=='Government') {
						
						echo "
						<div class='content_section_01'>
            				On $date The $actypeg, $sellername With A Sale ID of <b>$ifrom</b> Transferred Right of Ownership to The $actype of $buyername With A Valid Sale ID of <b>$ito</b> On A Platform Of $hereditory_mode Agreement. 
            			</div><br>";

					}else{

						echo "
						<div class='content_section_01'>
            				On $date The $actypeg, $sellername With A Sale ID of <b>$ifrom</b> Transferred Right of Ownership to The $actype, $buyername With A Valid Sale ID of <b>$ito</b> On A Platform Of $hereditory_mode Agreement Amounting to $amt. 
            			</div><br>";
					}
				}	
				
			}	
				
		}

}//End Of Records




?>