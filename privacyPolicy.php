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
        <h1>PRIVACY POLICY</h1>
        
<p>Protecting your privacy is very important to us. privacy statement is in order to explain the use of certain features and facilities on this web site and to demonstrate our commitment to privacy. We do everything, we reasonably can do to protect your rights of privacy on systems and the Website controlled by us, but we are not liable for any unauthorised or unlawful disclosures of your personal and confidential information made by third parties who are not subject to our control, for example advertisers and websites that have links to our Website. You should take note that the information and privacy practices of our business partners, advertisers, sponsors or other sites to which we provide hyperlinks, may be different from our privacy policy is subject to change at any time without notice. To make sure you are aware of any changes, please review this policy periodically.</p>
<h4>SITE COOKIES</h4>
<p>We may store information about you using cookies to identify you and to understand how you arrived at our website. We use both temporary and permanent cookies to maintain your security and improve your experience with our product.<p>
<h4>Regarding Our Privacy Practices.</h4>
<p>You are not required to register with us in order to use our site.
In order to take advantage of on-line offers or to subscribe to receive future news and offers from us we ask you to provide your personal details (email, name, address, etc). AAHARI may store this information and use it to contact you with news, information and special offers from AAHARI.if you doesn’t need any offer then you can unsubscribe from emails which will be included with each email we send you.</p>

<h4>CHANGES</h4>
<p>As our Site continues to develop, we may add new services and features to our Site. In the event that these additions affect our Security and Privacy Policy, this document will be updated appropriately</p>

<p>If you believe that any of the information we hold on you may be incorrect, or if you have any questions about this privacy statement, you can contact:</p>
<b>MARKETING TEAM</b><br>
AAHARI.COM<br>
<a href="mailto:info@aahari.com">info@aahari.com</a><br>
phone no:9966031666


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
