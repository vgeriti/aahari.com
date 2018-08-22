<?php 
session_start();
function REST_DISH_autoloader($class) {
    require_once('manag/php/classes/' . $class . '.php');
    //echo $class;
}
spl_autoload_register('REST_DISH_autoloader');
$util = new Utilities();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aahari</title>
	<link rel="stylesheet" type="text/css" href="css/style2.css"  />
	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/elastislide.css" />  
    <link href="css/datepic.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">    
	<script src="http://cdn.webrupee.com/js" type="text/javascript"></script>          	
    <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>	
	<script type="text/javascript" src="js/jquery.skitter.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/jquery.sticky-kit.min.js"></script>
	<script src="js/modernizr.custom.17475.js"></script>
    <script type="text/javascript" src="js/dval.js" ></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>  
    <script type="text/javascript" src="js_popup/jquery.leanModal.min.js"></script>
    <script type="text/javascript" src="js_popup/core.js"></script>
    <link rel="stylesheet" href="css_popup/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="css_popup/style.css" />
    <script src="js/datepic.js"></script>  
	<script type="text/javascript" language="javascript">
	$(function() {
		$( "#datepicker" ).datepicker({minDate: 0, maxDate: "1W"});
	});
		$(document).ready(function(){
			$("#restromenu_right").stick_in_parent()
			  .on("sticky_kit:stick", function(e) {
                  var hg =$( "#restropage" ).height();
                  var heights = hg-100;
                //$("#restromenu_right").css( "margin-top", "80px" );
              })
              .on("sticky_kit:unstick", function(e) {
                //$("#restromenu_right").css( "margin-top", "0px" );
				  
		  });
			$('.changedate').hide(0);
			$('.changedatelink').click(function(e){
				e.preventDefault();
				$('.changedatetitle').hide(200);
				$('.changedate').show(200);
				
			})			
			//menufilter
			$('.ulcontainer').hide(0);
			$('.searchmenu').click(function(e){
				e.preventDefault();
				$('.ulcontainer').toggle("slide");
			});																							

$('input[type=radio][name=opayment]').change(function() {
        
        if($(this).val() == "NET")
            $('#band').css("display","block");
        else
            $('#band').css("display","none");
    });

		});
</script> </head>
<body>
    <?php require_once('login_popup.php'); ?>
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
            <div id="content_wrapper" style="overflow:hidden;">
          <div id="restropage" style="overflow:hidden;">
                <div class="clear_50"></div>
                
                <?php
                    $res_id = $util->getRestaurantFromCookie('_kps');
                    $rest = new Restaurant();
                    $rest->getRestaurant($res_id);
                    //echo "before cookie";
                    $items = $util->getSessionValue('_kps');
                
                ?>
	          <div id="restromenu_left">                
                <form name="OrderForm" id="OrderForm" method = "POST" action = "order_validate.php">
                <div class="menu_checkout" style=" width:490px; border-radius:5px; padding:5px 20px;">
                    
                	<div class="title">Order Info</div>
                    <hr />
                    <div class="clear_3"></div>
                    <div class="float_l" style="width:40%; position:relative;">
                    Restaurant:<br />
                    <div class="title2"><?php echo $rest->getName() ?></div>
                    <div class="title3"><?php echo $rest->getRestArea() ?></div>
                    <input type="hidden" name="orestnt" value ="<?php echo $res_id ?>"/>
                    <input type="hidden" name="oarea" value ="<?php echo $rest->getArea() ?>"/>
                    <div class="clear_10"></div><div class="clear_10"></div>
                    Total Amount:<br />
                    <div class="title2">Rs. <?php echo $util->getFullAmount($res_id,$items['total_price']) ?></div>                    
                    </div>
                     <div class="float_r" style="width:50%; position:relative;">
                    Order Type:<br />
                    

                    	<select name = "order_type" id="order_type">
                        	<option>Home Delivery</option>
                            <option>Table Booking</option>
                            <option>Take Away</option>
                        </select>
                    <div class="clear_40"></div>
                    Delivery Time:<br />
                    <div class="title2 changedatetitle">Today, 04, April, 7:30 PM</div>
                    <div class="changedate"><input type="text" id="datepicker" class="datepic" placeholder="date" style="margin-top:-1px; width:130px; height:20px;"/>
                    <select style="height:26px;" name="dorder_time" id="dorder_time">
                    	<option>7:00 AM</option>
                        <option>7:30 AM</option>
                        <option>8:00 AM</option>
                        <option>8:30 AM</option>
                        <option>9:00 AM</option>
                    </select>
                    </div>
                     <div class="float_r" style="padding-right:18px;"><a href="#" class="changedatelink">change</a></div>
                   </div>
                   <div class="clear_10"></div>
                </div><!--end of menu checkout-->
                <div class="clear_10"></div>
                <div class="menu_checkout" style=" width:490px; border-radius:5px; padding:5px 20px;">
                	<div class="title">Enter your contact details <font color="#000000" size="-1">(all fields are mandatory) </font></div>
                    <hr />
                  <div class="clear_3"></div>
                    
                    Name : &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                    <input type="text" placeholder="Full Name" name="oname" id="oname" /><br />
                    Email : &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="email" placeholder="Email ID" name="oemail" id="oemail" /><br />
                    Mobile: &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="tel" placeholder="Mobile Number" name="omobile" id="omobile"/><br />
                    Alternate Mobile : <input type="tel" placeholder="Alternate Mobile Number" name="oamobile" id="oamobile"/><br />                  
                   <div class="clear_10"></div>
                </div><!--end of menu checkout--> 
                <div class="clear_10"></div>
                <div class="menu_checkout" style=" width:490px; border-radius:5px; padding:5px 20px;">
                	<div class="title">Enter your delivery address</div>
                    <hr />
                    <div class="clear_3"></div>
                    
                    <textarea placeholder="Address" name="oaddress" id="oaddress"></textarea><br />
                    <!--<input type="text" name="search" placeholder="Search..." style="height:35px; width:270px;"/>
                    <input type="submit" id="homedelivery"  value="Search" class="searchboxbtn" style="" />-->
                    
                   <div class="clear_10"></div>
                </div><!--end of menu checkout-->     
                <div class="clear_10"></div>
                <div class="menu_checkout" style=" width:490px; border-radius:5px; padding:5px 20px;">
                	<div class="title">special request (if any)</div>
                    <hr />
                    <div class="clear_3"></div>                    
                    <textarea placeholder="Delivery Instructions" name="osrequest" id="osrequest"></textarea><br />
                    
                   <div class="clear_10"></div>
                </div><!--end of menu checkout-->
                <div class="clear_10"></div>
                <div class="menu_checkout" style=" width:490px; border-radius:5px; padding:5px 20px;">
                	<div class="title">Payment Method</div>
                    <hr />
                    <div class="clear_3"></div>
                    
                     <center>
						<input type="radio" name="opayment" value = "CREDIT"  />Credit Card
                        <input type="radio" name="opayment" value = "DEBIT"  />Debit Card
                        <input type="radio" id="netb" name="opayment" value = "NET"  />Net Banking
                        <input checked type="radio" name="opayment" value = "COD" />Cash On Delivery<br />
                        <div class="clear_10"></div>
                    <div style="display:none;" id="band">
                        <select name="inet_b" id="netb" required="required">
                            <option value="" selected="selected">Select Bank</option>
                            <option value="AXIS">Axis Bank</option>
                            <option value="CITIBANK">Citi Bank</option>
                            <option value="HDFC">HDFC Bank</option>
                            <option value="ICICI">ICICI Bank</option>
                            <option value="INDUSIND">IndusInd Bank</option>
                            <option value="KOTAK">Kotak Mahindra Bank</option>
                            <option value="SBBIKANER">State Bank of Bikaner</option>
                            <option value="SBHYDERABAD">State Bank of Hyderabad</option>
                            <option value="SBI">State Bank of India</option>
                            <option value="SBMYSORE">State Bank of Mysore</option>
                            <option value="SBPATIALA">State Bank of Patiala</option>
                            <option value="SBTRAVANCORE">State Bank of Travancore</option>
                            <option value="YESBANK">Yes Bank</option>                            
                        </select>
                    </div>
                        <div class="clear_10"></div>
                        Enter Coupon Code : <input type="text" placeholder="Discount Coupon" style="width:150px; height:23px;" />
                        <input type="submit" id="homedelivery"  value="Apply" class="searchboxbtn" style="height:30px;" />                             

                   <div class="clear_10"></div><div class="clear_10"></div>
                   <input type="button" id = "val_order_sum" value="Place Your Order" class="submit_btn" />
                   </center>
                    
                   <div class="clear_10"></div>
                                   
                </div><!--end of menu checkout-->     
                </form>
              </div><!--end of restro menu float left-->               
              <div id="restromenu_right">
              	<div style="background-color:#f55856; height:30px; padding-top:10px; border-radius:5px; font-size:18px; color:#fff;"><center><b>Your Order</b></center></div>
                <div class="clear_10"></div>
                <!--
<input type="radio" name="ordertype" />Home Delivery
                <input type="radio" name="ordertype" />Table Booking
                <input type="radio" name="ordertype" />Take Away
            -->
                <hr />
                <div class="clear_10"></div>
				<div class="cart_items">
                    <?php
                    $cart = new Cart();     
                    echo $cart->display_cart_widget($res_id);
                    ?>
                </div>
                <hr/>                                
                <div class="clear_10"></div><div class="clear_10"></div>           
                
                
              </div><!--end of restro menu float right-->


              <div class="clear_80"></div>     
          </div><!--end of restropage-->            
        <div class="clear_80"></div> 
        <div class="clear_10"></div>
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
