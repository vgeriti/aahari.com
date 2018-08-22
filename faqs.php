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
        <b>1Q. What is Aahari ?</b>
        <p>A. Aahari is an online food ordering website. It lets customers browse numerous restaurants and their menu’s and consequently place an order for delivery of food and use services like table booking , take away, catering, party planning and banquet halls booking</p>
<b>2Q. Do I get charged for the service?</b>
<p>A. No, it is a free </p>
<b>3Q. Do I need to sign up before I order anything on Aahari ?</b>
<p>A .Not needed, You can order without signing up.</p>
<b>4Q.  Can I make an advance order? </b>
<p>A. Yes, you can make an advance order.</p>
<b>5Q. How do I Update an Order? </b>
<p>A.You cannot update order when you place order via “website”. You can update order only when you place an order via phone call
9966031666 within 5 min after placing an order.</p>
<b>6Q. Whom do I contact in case of delay or any other problem  ?</b>
<p>A. In case of a delay, you should immediately call Aahari customer care (9966031666) and they will take the necessary steps.</p>
<b>7Q. How do I cancel the order?</b>
<p>A.The order can only be cancelled before you receive conformation In case of a cancellation, you need to contact the Aahari customer care.</p>
<b>8Q. How do I pay?</b>
<p>A. You can pay through online (or) cash on delivery</p>
<b>9Q. Can I suggest a restaurant?</b>
<p>A.Sure, you can drop a mail at info@aahari.com to us suggesting the restaurants you would like to see on Aahari </p>
<b>10Q. How do I check the current status of my orders?</b>
<p>A.You can review the status of your orders and other related information in the 'Order History' section.
In the 'Dashboard', click on the 'Order History' link to view the status of all your orders. To view the status of a specific order, click on the 'Order Number' link. You can also track your order from the Track Order link on the header
You can contact us via E-mail (or) phone along with your order Id or mobile number.</p>
 <b>11Q. Is 24x7 home deliveries possible from the restaurants?</b>
 <p>A . Almost all restaurants operate between 11.00 AM to 11.00 PM. Orders placed after these time frames cannot be processed. However, you can still place advance orders 24x7.</p>
<b>12Q. I don't have access to the internet.Can i still use your services?</b>
<p>A.Of course! Our customer service representatives are ready to take your order from 11:00 AM to 11:00 PM</p>
<b>13Q. What if internet connection is lost at any step in between?</b>
<p>A.1f you receive confirmation SMS, your order is booked. If you didn’t receive the order confirmation SMS, your transaction did not complete and order was not placed. You would have to place the order again online or call our helpful customer service representatives at 9966031666 to help you complete your order.</p>

<b>14Q. What are the advantages of registering with Aahari to place orders?</b>
<p>A. There are many advantages of being a registered user. To list a few of them:</p>
<ol>
<li>1.Every time an order is placed you earn reward points. These reward points  can be used in further orders you place</li>
<li>You can save your address for delivery to enable faster ordering the next time.</li>
<li>Features like One click ordering and saving of favorite restaurants require you to be signed</li>
</ol>
<p>There are many more advantages... register with us and discover them.</p>

<b>15Q. What are the benefits of signing up for the Aahari.com corporate program?</b>
<p>A. Benefits of Aahari corporate program</p><ol>
<li>Full integration into your internal accounting systems</li>
<li>Customised online reports</li>
<li>Single billing – No more individual expense sheets from employees</li>
<li>Administration logins for you to control which employees can bill which clients and projects</li>
<li>Ability to setup customer client and project codes</li>
</ol>
        </div>
            
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
		<script type="text/javascript" src="js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel' ).elastislide();
			
		</script>
    

    
</body>
</html>
