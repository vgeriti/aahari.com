<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aahari</title>
	<link rel="stylesheet" type="text/css" href="css/style2.css"  />
	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/elastislide.css" />    
	<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">    
	<script src="http://cdn.webrupee.com/js" type="text/javascript"></script>    
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
	</head>
<body>
    <?php require_once('login_popup.php'); ?>
   	  <div id="header_wrapper">
        	<div id="menu">
            <div class="logo"><a href="http://www.aahari.com"><img src="images/Aahari_logo.png" width="158" height="68" /></a></div>
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
        <div id="content_wrapper">

        <div class="black_font">
        <h1>About Us</h1>
        <p>    
        Aahari is an online food ordering site in India. we strongly believe in "satisfaction only relieves hunger, find the balance and plant your feet", hence we are here to satisfy your hunger needs , it is a unique place where everyone shares the fun and enjoyment  of great times together .There is a real  passion in everything we do . Our culture has always been one of uncompromised service and that's still the key thing about us that makes such a big difference. It's our people that really set us apart. Everyone plays an important role in delivering that very special Aahari's feeling and the wow factor for our guests. We create entertainment and enjoyment for birthdays and special treats,our services includes Online Food Delivery , Takeaway , Table booking/Buffet Booking , Catering proposals , Party planning and Banquet halls booking . </p>
        </div>
            
        </div><!--end of main_wrapper-->
         <br/>
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
		<script type="text/javascript" src="js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel' ).elastislide();
			
		</script>
    

    
</body>
</html>
