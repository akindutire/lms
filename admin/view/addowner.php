<?php


  $r='admin';
  $me->verifylogin($r,1); 

    $a=$_GET['lid'];

    $link=$connect->iconnect();

    $sql=mysqli_query($link,"SELECT lga_id,block FROM block WHERE id='$a'");
    list($lg,$vbk)=mysqli_fetch_row($sql);
    
    $in=mysqli_query($link,"SELECT lga FROM lga WHERE id='$lg'");
    list($inlg)=mysqli_fetch_row($in);
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Land Information |  Add Owner</title>

<meta name="keywords" content="Land Information System" />
<meta name="description" content="Land Information System Provided By realcliqs.com on admin akindutire ayomide" />

<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>
</head>
<body>
<div id="templatemo_header_wrapper">
<!--  Free Web Templates by TemplateMo.com  -->
  <div id="templatemo_header">
    
   	<div id="site_logo"></div>
        
		<div id="templatemo_menu">
      		<div id="templatemo_menu_left"></div>
            <ul>
                  <li><a href="index.php?q=cpanel" class="current">Home</a></li>
                  <li><a href="index.php?q=landlist" target="_new">Land List</a></li>
                  <li><a href="index.php?q=cpp" target="_new">Change Password</a></li>
                  <li><a href="index.php?q=landreg">Back</a></li>
                  <li><a href="lgt.php">Logout</a></li>
            </ul>    	
		</div> <!-- end of menu -->
    
    </div>  <!-- end of header -->
</div> <!-- end of header wrapper -->


<div id="templatemo_content_wrapper">
	<div id="templatemo_content">
    
    	<div id="column_w530">
        	
            <div class="header_02">Add Land owner  (<?php echo "$vbk   >   $inlg"; ?>) </div>
            
            <div id="feedback" style="background:transparent; color:black; font-family:amble; font-size:14px; padding:1px; margin:1% 32% 2px 32%; height:auto; width:350px; text-align:center; border-radius:3px;"></div>
    
    
    
    
            <form action="<?php echo $config['control']['add']; ?>" method="post">
            
            <label></label><input type="hidden" name="addid" id="" value="2">
            <label></label><input type="hidden" name="layout" id="layout" value="<?php echo $a; ?>">
            <label></label><input type="hidden" name="lga" id="lga" value="<?php echo $lg; ?>">
            
            <div class="all"><label>Owner Picture</label><input type="file" name="pfile" id="pfile"></div>

            <div class="all"><label>Account type</label><select name="actype" id="actype">

                    <option value="Individual">Individual</option>
                    <option value="Government">Government</option>
                    
                </select>
            </div>

            <div class="all"><label>Land Owner</label><input type="text" name="owner" id="owner"></div>

            <div class="all"><label>Address</label><input type="text" name="saddr" id="saddr"></div>

            <div class="all"><label>Mail</label><input type="email" name="mail" id="mail"></div>

            <div class="all"><label>Telephone</label><input type="tel" name="tel" id="tel"></div>
            
            <div class="all"><label></label><button type="submit">Add Land Owner</button></div>

    
    </form>
                



           <!-- <p class="em_text">This is a <a href="http://www.templatemo.com" target="_parent">professional XHTML/CSS layout</a> provided by <a href="http://www.templatemo.com" target="_parent">templatemo.com</a> for free of charge. You can use this template for any purpose. Credit goes to <a href="http://www.photovaco.com" target="_blank">Free Photos</a> for photos.</p>
            
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam a justo dolor. Duis in tincidunt lorem. Nunc et tellus nisi. Nulla non velit lectus. Morbi luctus ullamcorper felis, non gravida neque congue sit amet.</p>
            -->
            <div class="margin_bottom_20"></div>
            
            <!--<ul class="content_list_01">
                <li>Integer tempor, libero quis laoreet dapibus, quam mauris hendrerit  urna, vel feugiat dolor lectus non velit. Fusce at nisl libero, ac  fringilla risus.</li>
                <li>Proin non velit nec enim volutpat euismod. Phasellus lorem velit, porttitor non iaculis in, euismod a metus. Nullam orci odio, dignissim a egestas ac, sollicitudin in quam.</li>
            </ul>-->
            
            <div class="margin_bottom_20"></div>           
            
            <!--
            <div class="content_section_01">
            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam a justo dolor. Duis in tincidunt lorem. Nunc et tellus nisi. Nulla non velit lectus. Morbi luctus ullamcorper felis, non gravida neque congue sit amet. Nam nec mi metus, ac elementum velit. Etiam vel arcu velit, eget consequat risus. 
            </div>
            -->


            <div class="cleaner"></div>
        </div>
        
        <div id="column_w300">
        
        	<div class="header_03">Land Owner</div>
            
                
                <?php $record->owner($a,$lg,1); ?>
            
            
            <div class="cleaner"></div>
        </div>
    
    	<div class="cleaner"></div>
    </div> <!-- end of content wrapper -->
</div> <!-- end of content wrapper -->

<div id="templatemo_footer_wrapper">

	<div id="templatemo_footer">
    	
    
        
        <div class="margin_bottom_20"></div>
        Copyright © 2015 <a href="#">Land Information System</a> | <a href="mailto::akindutire33@gmail.com" target="_parent">E mail Us @ akindutire33@gmail.com</a>
        <div class="cleaner"></div>
    </div> <!-- end of footer -->
</div> <!-- end of footer -->

</body>
</html>