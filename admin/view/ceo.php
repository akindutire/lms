<?php


  $r='admin';
  $me->verifylogin($r,1); 
  $link=$connect->iconnect();
  $cs=$_POST['sale'];

  $sql=mysqli_query($link,"SELECT name FROM owner WHERE sale_id='$cs'");
  list($name)=mysqli_fetch_row($sql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Land Information |  CEO</title>

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
                  <li><a onclick="window.print()">Print</a></li>
            </ul>     
    </div> <!-- end of menu -->
    
    </div>  <!-- end of header -->
</div> <!-- end of header wrapper -->


<div id="templatemo_content_wrapper">
  <div id="templatemo_content">
    
      <div id="column_w530" style="width:100%; margin-left:5%;">
          
            <!--<div class="header_02"> Enter Sale ID.</div>-->
            
         <center>
           
         <div style="margin-right:10%; background:url(../images/content/ceobk.gif) no-repeat; background-size:800px 450px; color:black; width:800px; height:450px;">
            <br>

            <div style="text-align:center; font-family:almendra; font-size:30px;"><h2>Certificate Of Ownership</h2></div>

              <br>
              <h3 style="text-align:center; font-family:alegreymedium; font-size:17px; letter-spacing:2px;">AWARDED TO:</h3><br>

              <h3 style="text-align:center; font-family:amble; color:black; font-size:15px;"><u>  <?php echo strtoupper($name); ?>   </u></h3>

              <h3 style="text-align:center; font-family:amble; color:black; font-size:15px;">FOR LAND WITH PILLAR(S) OF: <u>  

              <?php

                    if ($_SERVER['REQUEST_METHOD']=='POST') {
                        
                        $i=0;

                        foreach ($_POST['land'] as $land) {
                          $i++;
                          if(count($_POST['land'])==$i){
                            echo " $land ";
                          }else{
                            echo " $land, ";
                          }  
                           
                        
                        }
                    }
                    global $config;
              ?>

              </u>

              </h3>

              <br>
              <h3 style="text-align:center; font-family:amble; color:black; font-size:15px;">AWARD ON : <u>  <?php echo $config['date']['month'];  echo " ".strtoupper($config['date']['day']); echo  " ".$config['date']['year']; ?></u> </h3>

               <h3 style="text-align:center; width:200px;">SIGNED : <hr> </h3>


         </center>

         </div>
           
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
        
        <!--<div id="column_w300">
        
          <div class="header_03">Latest News</div>
            
            <div class="column_w300_section_01">
              <div class="news_image_wrapper">
                  <img src="images/templatemo_image_02.jpg" alt="image" />
                </div>
                
                <div class="news_content">
                  <div class="news_date">OCT 29, 2048</div>
                    <div class="header_04"><a href="#">Lorem ipsum dolor sit</a></div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam a justo dolor.</p>
        </div>
                                
                <div class="cleaner"></div>
            </div>-->
            
            
            
            
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