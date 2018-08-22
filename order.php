<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aahari</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"  />
	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/elastislide.css" />    
	<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery.animate-colors-min.js"></script>
	<script type="text/javascript" src="js/jquery.skitter.min.js"></script>
	<script src="js/modernizr.custom.17475.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>  
    <script type="text/javascript" src="js_popup/jquery.leanModal.min.js"></script>
    <script type="text/javascript" src="js_popup/core.js"></script>
    <link rel="stylesheet" href="css_popup/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="css_popup/style.css" />   
	<script type="text/javascript" language="javascript">
		$(document).ready(function(){

		});
    </script> 
</head>
<body>
    <?php require_once('login_popup.php'); ?>
	<div id="homepage" style="height:1000px;">
   	  <div id="header_wrapper">
        	<div id="menu">
            <div class="logo"><img src="images/Aahari_logo.png" width="158" height="68" /></div>
            <ul>
               <div class="float_r">
                <?php
                if(isset($_SESSION['session']))                
                    echo "<li><div class='login'> <span style='float:right;'>Hi ".$_SESSION['name']."..! | <a href='logout.php'> Sign out</a></span></div></li>";
                else
                  echo "<li><div class='login'><span style='float:right;'><img src='images/user.jpg' /><a href='#modal' id='modal_trigger' class='login'> &nbsp; Log in</a></span></div></li>";
                ?>
              </div><!--end of float_r-->

            </ul>
          </div><!--end of menu-->
        </div><!--end od header_wrapper-->
        <div class="clear_80"></div>

    	<div id="main_wrapper" style="height:600px;">
            <div class="clear_80"></div>
          <div id="restropage" style="height:500px;">
          <div class="contact_left">
            <div class="clear_10"></div>
            <div id="login_wrapper">
            <center><br />
                 <h1 style="color:#000;">Order Status</h1>
            </center>
			<div class="clear_10"></div>
            <div class="bg" style="background-color:#fff; padding:15px;">

<?php
if(isset($_REQUEST['order']))
{
    date_default_timezone_set('Asia/Calcutta');
    function my_autoloader($class) {
    require_once('manag/php/classes/' . $class . '.php');
}

spl_autoload_register('my_autoloader');
    $dob = new DBConnect();
    $db = $dob->getDBConnection();
    $stmt = $db->prepare("SELECT * from orders where id=:id");
    $var = $stmt->execute(array(':id'=>$_REQUEST['order']))or die(print_r($stmt->errorInfo(),true));
    $ft = $stmt ->fetch();
  

        if(isset($_REQUEST['ref']) && $_REQUEST['ref'] == "pre_order"){
            echo "Hello, ".$ft['name']."<br />";
		  	echo "Your Order #".$ft['id']." has been placed successfully.<br /><br />";
        }
        else
        //your order is sent to kitchen
				
            echo "Order Details:<br />";
            echo "Order Number: #".$ft['id']."<br />";
            echo "Order Date: ".date('jS M, o', strtotime($ft['dtime']))."<br />"; //29th June, 2014
            echo "Timing: ".date('h:i A',strtotime($ft['dtime']))."<br />"; //8 PM
            echo "Total Amount: ".$ft['amount']."Rs. /-";//560 Rs. /-
?>
            </div>
            
        </div><!--end of loign wrapper-->          
          </div>      
          <!--<div class="contact_right">
                    	<center>
          <h1 style="color:#333;">Share Your Order</h1>
            <a href="#"><img src="images/fb-share.png" width="240" height="71" /></a>
            <a href="#"><img src="images/twitter-share.png" width="210" height="50"  /></a>
            </center>
            <div class="clear_10"></div>           
          </div>          -->
          </div><!--end of restropage-->            
            
        </div><!--end of main_wrapper-->
         
         <div id="footer_wrapper">
            <div id="footer">
                <ul>
                    <font size="+2" color="#30C4C9"><b>Aahari</b></font>
                    <div class="clear_10"></div>
                    <li><a href="aboutus.php">About Us</a></li>                    
                    <li><a href="coming_soon.php">Blog</a></li>
                    <li><a href="coming_soon.php">Register a Restaurant</a></li>
                    <li><a href="faqs.php">FAQ's</a></li>
                    <li><a href="termsAndConditions.php">Terms & Conditions</a></li>
                    <li><a href="privacyPolicy.php">Privacy Policy</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    
                </ul>
                <ul>
                    <font size="+2" color="#30C4C9"><b>Our Services</b></font>
                    <div class="clear_10"></div>
                    <li><a href="search.php?dt=DD">Home Delivery</a></li>
                    <li><a href="search.php?dt=TB">Buffet/Table Booking</a></li>
                    <li><a href="search.php?dt=TA">Take Away</a></li>
                    <li><a href="coming_soon.php">Party Planning</a></li>
                    <li><a href="coming_soon.php">Birthday Celebrations</a></li>
                    <li><a href="coming_soon.php">Catering</a></li>
                    <li><a href="coming_soon.php">Banquet Hall Booking</a></li>
                </ul>
                 <ul>
                    <font size="+2" color="#30C4C9"><b>Menu</b></font>
                    <div class="clear_10"></div>
                    <li><a href="search.php?cuisine=Hyderabadi">Hyderabad Biryani</a></li>
                    <li><a href="search.php?cuisine=Bakery">Bakery</a></li>
                    <li><a href="search.php?cuisine=Fast%20Food">Fast Food</a></li>
                    <li><a href="search.php?cuisine=Seafood">Seafood</a></li>
                    <li><a href="search.php?cuisine=Continental">Continental</a></li>
                    <li><a href="search.php?cuisine=Chinese">Chinese</a></li>
                </ul>
            </div>
            <div id="copyright">Aahari © 2014</div>
        </div><!--end of footer-->   
       
    </div><!--end of homepage-->
    
		<script type="text/javascript" src="js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel' ).elastislide();
			
		</script>
    

    
</body>
</html>
<?php
}
?>