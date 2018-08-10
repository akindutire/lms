<?php


  $r='admin';
  $me->verifylogin($r,1); 
  $link=$connect->iconnect();
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Land Information |  Transfer Land</title>

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
                  <li><a href="lgt.php">Logout</a></li>
            </ul>    	
		</div> <!-- end of menu -->
    
    </div>  <!-- end of header -->
</div> <!-- end of header wrapper -->


<div id="templatemo_content_wrapper">
	<div id="templatemo_content">
    
    	<div id="column_w530">
        	
            <div class="header_02"> Enter Sale ID.</div>
            
             <div id="feedback" style="background:transparent; color:black; font-size:14px; padding:1px; margin:1% 32% 2px 32%; height:auto; width:350px; text-align:center; border-radius:3px; font-family:amble;"></div>


            <form action="<?php echo $config['control']['retrieve']; ?>" method='post'>

            	<div class="all"><label></label><input type="hidden" name="retrieveid" value="3"></div>

            	<div class="all"><label></label><input type="text" name="isale" id="isale" autofocus="true"></div>

            </form>
            
            <br><hr>
            
            <center>
                <table cellspacing="15" cellpadding="10">


          	    </table>
          	</center>


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
        
        	<div class="header_03">Land Sale List</div>
            <cc>



            </cc>
            
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