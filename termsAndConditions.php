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
        <h1>TERMS   AND CONDITIONS</h1>
        
<p>PLEASE READ THESE TERMS AND CONDITIONS OF USE CAREFULLY BEFORE USING THIS SITE. By using this site, you signify your assent to these terms of use. If you do not agree to these terms of use, please do not use this site. We reserve the right, at our discretion, to change, modify, add, or remove portions of these terms at any time. Please check these terms periodically for changes. Your continued use of AAHARI.COM and the posting of changes to these terms (including the Privacy Policy) will mean you accept those changes.</p>
<h4>RESTRICTIONS ON USE OF MATERIALS</h4>
<p>This site is owned and operated by AAHARI.COM (referred to as "AAHARI," we," "us," or "our" herein). No material from AAHARI.COM  may be copied, reproduced, republished, uploaded, posted, transmitted, or distributed in any way,. Modification of the material or uses of the materials for any other purpose is a violation of AAHARI copyright s. For purposes of these terms, the use of any such material on any other website or networked computer environment is prohibited.</p>
<h4>SUBMISSIONS</h4>
<p>All remarks, suggestions, ideas, graphics, or other information communicated to AAHARI through this site AAHARI will not be required to treat any submission as confidential, and will not be liable for any ideas for its business (including without limitation, product, or advertising ideas) and will not incur any liability as a result of any similarities that may appear in future AAHARI’s operations. Without limitation, AAHARI will have exclusive ownership of all present and future existing rights to the Submission of every kind and nature everywhere. AAHARI will be entitled to use the Submission for any commercial or other purpose whatsoever without compensation to you or any other person sending the Submission. You acknowledge that you are responsible for whatever material you submit, and you, not AAHARI, have full responsibility for the message, including its legality, reliability, appropriateness, originality, and copyright.</p>
<h4>DISCLAIMER</h4>
<p>THE MATERIAL IN THIS SITE COULD INCLUDE TECHNICAL IN ACCURACIES OR TOPOGRAPHICAL ERRORS. AAHARI MAY MAKE CHANGES OR IMPROVEMENTS AT ANY TIME . THE MATERIALS IN THIS SITE ARE PROVIDED "AS IS" AND WITHOUT WARRANTIES OF ANY KIND EITHER EXPRESSED OR IMPLIED.  AAHARI DOES NOT WARRANT THAT THE FUNCTIONS CONTAINED IN THE MATERIAL WILL BE UNINTERRUPTED OR ERROR-FREE, THAT DEFECTS WILL BE CORRECTED,ANY REPRESENTATIONS REGARDING THE USE OF OR THE RESULT OF THE USE OF THE MATERIAL IN THIS SITE IN TERMS OF THEIR CORRECTNESS, ACCURACY, RELIABILITY, OR OTHERWISE. YOU (AND NOT AAHARI) ASSUME THE ENTIRE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION. THE ABOVE EXCLUSION MAY NOT APPLY TO YOU, TO THE EXTENT THAT APPLICABLE LAW MAY NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES.</p>

<h4>MISCELLANEOUS</h4>
<p>This is the entire agreement between the parties relating to the use of this site. AAHARI can revise these Terms and Conditions at any time by updating this posting. AAHARI services are available in many ways.</p>
<h4>Refund policy</h4>
<p>AAHARI  takes customer satisfaction very serious. If you have any problems with your order , if we have not been able to resolve your issue with the Restaurant , please contact AAHARI and we will try to assist you. In appropriate cases, if you have already been billed by AAHARI, AAHARI may issue full or partial refunds.</p>
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
