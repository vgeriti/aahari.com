<?php session_start(); ?>
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
	<script type="text/javascript" src="js/jquery.skitter.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js" ></script>
	<script src="js/modernizr.custom.17475.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>  
    <script type="text/javascript" src="js_popup/jquery.leanModal.min.js"></script>
    <script type="text/javascript" src="js_popup/core.js"></script>
    <link rel="stylesheet" href="css_popup/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="css_popup/style.css" />
	<script type="text/javascript" language="javascript">
		$(document).ready(function(){

$( "#contactform" ).submit(function( event ) {
    alert('submitted');
        event.preventDefault();
        
    if($("#contactform").valid())
    {
        alert('valid');
        var form = document.contactform;
        alert(form);
        var dataString=$(form).serialize();
        alert(dataString);
        $.ajax({
            type: "POST",
            url: "contact.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
                var _p = $.parseJSON(html);
                if(_p.status = "Success")
                {
                    $('#resp_message').css('color','#30b507').html(_p.message);                    
                    $('#contactform')[0].reset();

                }
                else if(_p.status == "Failed"){
                  $('#resp_message').css('color','#ED6347').html(_p.message);
                }

            }
        });
    }
});

$("#contactform").validate({
        rules:{
            name:"required",
            emailid:"required",
            mobileno:"required",
            message:"required"
        },
        messages:{
            name:"Enter your name",
            emailid:"Enter your Email id",
            mobileno:"Enter your mobile number",
            message:"Enter your message"            
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            alert($(element).parents('.control-group'));
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
}); 

		});
</script> </head>
<body>
    <?php require_once('login_popup.php'); ?>
	<div id="homepage">
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
    	<div id="main_wrapper">            	
            <div class="clear_80"></div>
          <div id="restropage">
          <div class="contact_left">
            <div class="clear_10"></div>
            <div id="login_wrapper">
                      <h1 style="color:#000;">Contact Us</h1>
             <p>We'd love to know how we can help you. We'll get back to you as soon as we can.</p>

            <p>Drop us a note or reach us at our information Mentioned.</p>

			<div class="clear_10"></div>
            <form action="contact.php" name="contactform" method="post" id="contactform">
            <div class="formbg">
            <div class="clear_10"></div>
            <div id="resp_message" style="color:#f30c04;"></div>
                <div class="clear_10"></div>
                Name<br /><input type="text" id="name" name="name" placeholder="Name" maxlength="50" required="required" /><br />
                <div class="clear_10"></div>
                Email ID<br /><input type="email" id="emailid" name="emailid" placeholder="Email ID" maxlength="255" required="required" /><br />
                <div class="clear_10"></div>
                Phone<br /><input type="tel" id="mobileno" name="mobileno" placeholder="Contact No." maxlength="13"/><br /><br />

				Message <textarea name="message" id="message" size="30" placeholder="Message" required="required"></textarea>
              <div class="clear_10"></div><div class="clear_10"></div>
                <input type="submit" class="submit_btn" name="Register" value="Send" />&nbsp;
                <div class="clear_10"></div>                
			<div class="clear_10"></div>
              </div>
            </form>
        </div><!--end of loign wrapper-->          
          </div>      
          <div class="contact_right">
          	<font size="+1">Address</font><br />
				PlotNo.69,<br />
                Bhavani Nagar Colony,<br />
                Peerancheruvu,<br/>
                Hyderabad.        
            <div class="clear_40"></div>
            Email:<a href="mailto:info@aahari.com">info@aahari.com</a><br/>
            <font size="+1">Contact Numbers</font><br />
            9966031666<br /> 
            8019913328<br />
            9573572077<br />            
            
          </div>          
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
                <!--<div id="register">
                	
                    <form>
                        <center><input type="submit" class="submit_btn" name="Register" value="Register your Restaurant" /></center>
                    </form>
                    <div class="clear_10"></div>
                    <div class="clear_10"></div>
                   
                </div>end of register-->
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
