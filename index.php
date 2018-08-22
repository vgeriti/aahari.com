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
  <link rel="stylesheet" type="text/css" href="css/component.css" />
  <link href="css/datepic.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>  
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>	
	<script type="text/javascript" src="js/jquery.skitter.min.js"></script>
	<script src="js/modernizr.custom.17475.js"></script>
  <script src="js/jquery.cbpQTRotator.min.js"></script>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>  
<script type="text/javascript" src="js_popup/jquery.leanModal.min.js"></script>
<script type="text/javascript" src="js_popup/core.js"></script>
<link rel="stylesheet" href="css_popup/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="css_popup/style.css" />    
<script src="js/datepic.js"></script>
<script type="text/javascript">
  if (window.location.hash == '#_=_') window.location.hash = '';
</script>
	<script type="text/javascript" language="javascript">
	$(function() {
		$( "#datepicker" ).datepicker();
	});
		$(document).ready(function(){
		
			//fb twitter slider
		$( function() {$( '#cbp-qtrotator' ).cbpQTRotator();} );  
    $( function() {$( '#cbp-qtrotator2' ).cbpQTRotator();} ); 
		
			//searchbox slider
			$('#2ndslide').hide(0);
			$('#3rdslide').hide(0);
			$('#4thslide').hide(0);
			$('#show_slide2').click(function(e){
				e.preventDefault();
    			 $('#1stslide').hide(100);
				$('#2ndslide').show(300);
				
			});
			$('#backtohome2').click(function(e){
				e.preventDefault();
				$('#2ndslide').hide(100);
				$('#1stslide').show(50);
				
			});
			$('#show_slide3').click(function(e){
				e.preventDefault();
    			 $('#1stslide').hide(100);
				$('#3rdslide').show(300);
				
			});
			$('#backtohome3').click(function(e){
				e.preventDefault();
				$('#3rdslide').hide(100);
				$('#1stslide').show(50);
				
			});$('#show_slide4').click(function(e){
				e.preventDefault();
    			 $('#1stslide').hide(100);
				$('#4thslide').show(300);
				
			});
			$('#backtohome4').click(function(e){
				e.preventDefault();
				$('#4thslide').hide(100);
				$('#1stslide').show(50);
				
			});
						
			
			$('.box_skitter_large').skitter({animation: 'fade',easing_default: 'easeOutQuart' , label: false, numbers: false, theme: 'clean'});
		
		$('.title').hover(
			function(){ $(this).parent().children('.overlay_food').stop().fadeTo(100,0)},
			function(){ $(this).parent().children('.overlay_food').stop().fadeTo(100,0.5)}		
		);				
});  
</script>    
</head>
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
        	<div id="slider">          
   				<div class="box_skitter box_skitter_large">
					<ul>
						<li><a href="#cubeRandom"><img src="images/example/001.jpg" class="cubeRandom" /></a><div class="label_text"><p>cubeRandom</p></div></li>
						<li><a href="#block"><img src="images/example/002.jpg" class="block" /></a><div class="label_text"><p>block</p></div></li>
						<li><a href="#cubeStop"><img src="images/example/003.jpg" class="cubeStop" /></a><div class="label_text"><p>cubeStop</p></div></li>
					</ul>
                <div id="searchbox">
                
                <div id="1stslide">
                <font size="+2"><b>Welcome to World of Restaurants</b></font>
                <div class="clear_10"></div>
                <font size="+1">
                <img src="images/home_delivery_icon.png" width="33" height="33" />
                <a href="#" id="show_slide2">Home Delivery</a>&nbsp;
                <img src="images/table_booking.png" width="31" height="40" style="margin-bottom:-2px;" />
                <a href="#" id="show_slide3" >Table Booking</a>&nbsp; 
                <img src="images/take_away.png" width="39" height="39" style="margin-bottom:-2px;" /> 
                <a href="#" id="show_slide4" >Take Away</a>
                </font>
                <div class="clear_10"></div>
                <div class="clear_10"></div>                

          <form action="search.php" method="GET">
                  <select style="font-size:20px;" name="area" class="selectarea">
                    <option disabled="disabled" selected="selected">Select area</option>
                    <?php
                    require_once('manag/php/classes/Utilities.php');
                      $util = new Utilities();
                      $ars_se = $util->getAreasForSearchbox();
                      echo $ars_se;
                    ?>                    
                  </select>

                   <!-- <input type="text" name="search" placeholder="Search..." />-->
                    <input type="submit" id="homedelivery" class="submit_btn" value="Search" />                                          
				</form>
                </div><!--end of first slide-->
                <div id="2ndslide">
                <font size="+2"><b>Home Delivery</b></font>
             
                <div class="clear_10"></div>

                <div class="clear_10"></div>
                <div class="clear_10"></div>                
                <form action="search.php" method="GET">
                    <select style="font-size:20px;" name="area" class="selectarea">
                    <option disabled="disabled" selected="selected">Select area</option>
                    <?php
                    echo $util->getAreasForSearchbox();
                    ?>                    
                  </select>
                  <input type="hidden" name="dt" value="DD" />
                  <input type="submit" id="takeaway" class="submit_btn" value="Find" />
                    <div class="clear_10"></div>
                    <input id="backtohome2" class="back_btn" value="Back" />
                           
				</form>
                </div><!--end of second slide-->
                <div id="3rdslide">
                <font size="+2"><b>Table Booking</b></font>
                <div class="clear_10"></div>
                <div class="clear_10"></div>
                <div class="clear_10"></div>                
 	            
        <form action="search.php" method="GET" >
                  <select name="guests_no" class="guests_no">
                    <option selected="selected" disabled="disabled">Guests 0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                  </select>
                  <input type="text" id="datepicker" class="datepic" placeholder="date" style="margin-top:-1px; height:25px;"/>
                  <select name="time" class="time">
                    <option selected="selected" disabled="disabled">time</option>
                    <option value="9:00">9:00</option>
                    <option value="9:30">9:30</option>
                    <option value="10:00">10:00</option>
                    <option value="10:30">10:30</option>
                    <option value="11:00">11:00</option>
                    <option value="11:30">11:30</option>
                    <option value="12:00">12:00</option>
                    <option value="12:30">12:30</option>
                    <option value="13:00">13:00</option>
                    <option value="13:30">13:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                    <option value="15:30">15:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                    <option value="18:00">18:00</option>
                    <option value="18:30">18:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                    <option value="20:00">20:00</option>
                    <option value="20:30">20:30</option>
                    <option value="21:00">21:00</option>
                    <option value="21:30">21:30</option>
                    <option value="22:00">22:00</option>
                    <option value="22:30">22:30</option>
                    <option value="23:00">23:00</option>
                    <option value="23:30">23:30</option>
                  </select>
                  <div class="clear_3"></div>
                  <select style="font-size:20px;" name="area" class="selectarea">
                    <option disabled="disabled" selected="selected">Select area</option>
                    <?php
                    echo $util->getAreasForSearchbox();
                    ?>                    
                  </select>
                   <input type="hidden" name="dt" value="TB" />
                    <input type="submit" id="booktable" class="submit_btn" value="Find" />
                    <div class="clear_10"></div>
                    <input id="backtohome3" class="back_btn" value="Back" />
                           
        </form>
                </div><!--end of Third slide-->                
                <div id="4thslide">
                <font size="+2"><b>Take Away</b></font>
               
                <div class="clear_10"></div>

                <div class="clear_10"></div>
                <div class="clear_10"></div>                
                <form action="search.php" method="GET">
                   <select style="font-size:20px;" name="area" class="selectarea">
                    <option disabled="disabled" selected="selected">Select area</option>
                    <?php
                    echo $util->getAreasForSearchbox();
                    ?>                    
                  </select>
                  <input type="hidden" name="dt" value="TA" />
                   <input type="submit" id="takeaway" class="submit_btn" value="Find" />
                    <div class="clear_10"></div>
                    <input id="backtohome4" class="back_btn" value="Back" />                           
				      </form>
                </div><!--end of Fourth slide--> 
                </div><!--end of search box-->
				</div>
                
            </div><!--end of slider-->
            <div class="clear_10"></div>
            <h2>Cuisines at Aahari</h2>
            <div id="foodcart">            	            
              <div id="item">
               		<div class="overlay_food"></div>
                  	<a href="search.php?cuisine=Hyderabadi"><div class="title">Hyderabad Biryani</div>
               	  	<img class="itemimage" src="images/item1.jpg" /></a>
              </div><!--end of item-->
              
               <div id="item">
               		<div class="overlay_food"></div>
                  	<a href="search.php?cuisine=Bakery"><div class="title">Bakery</div>
               	  	<img class="itemimage" src="images/item2.jpg" /></a>
              </div><!--end of item-->
              
              <div id="item">
               		<div class="overlay_food"></div>
                  	<a href="search.php?cuisine=Fast%20Food"><div class="title">Fast Food</div>
               	  	<img class="itemimage" src="images/item3.jpg" /></a>
              </div><!--end of item-->
              
              <div id="item">
               		<div class="overlay_food"></div>
                  	<a href="search.php?cuisine=Seafood"><div class="title">Seafood</div>
               	  	<img class="itemimage" src="images/item4.jpg" /></a>
              </div><!--end of item-->
              
               <div id="item">
               		<div class="overlay_food"></div>
                  	<a href="search.php?cuisine=Continental"><div class="title">Continental</div>
               	  	<img class="itemimage" src="images/item5.jpg" /></a>
              </div><!--end of item-->
              
               <div id="item">
               		<div class="overlay_food"></div>
                  	<a href="search.php?cuisine=Chinese"><div class="title">Chinese</div>
               	  	<img class="itemimage" src="images/item6.jpg" /></a>
              </div><!--end of item-->

                
            </div><!--end of foodcart-->
            
            <h3>Best Deals</h3>
            <div id="bestdeals">
            
				<!-- Elastislide Carousel -->
				<ul id="carousel" class="elastislide-list">
					<li><a href="#"><img src="images/small/1.jpg" alt="image01" /></a></li>
					<li><a href="#"><img src="images/small/2.jpg" alt="image02" /></a></li>
					<li><a href="#"><img src="images/small/3.jpg" alt="image03" /></a></li>
					<li><a href="#"><img src="images/small/4.jpg" alt="image04" /></a></li>
					<li><a href="#"><img src="images/small/5.jpg" alt="image05" /></a></li>
					<li><a href="#"><img src="images/small/6.jpg" alt="image06" /></a></li>
					<li><a href="#"><img src="images/small/7.jpg" alt="image07" /></a></li>
					<li><a href="#"><img src="images/small/8.jpg" alt="image08" /></a></li>
					<li><a href="#"><img src="images/small/9.jpg" alt="image09" /></a></li>
					<li><a href="#"><img src="images/small/10.jpg" alt="image10" /></a></li>
					<li><a href="#"><img src="images/small/11.jpg" alt="image11" /></a></li>
					<li><a href="#"><img src="images/small/12.jpg" alt="image12" /></a></li>
					<li><a href="#"><img src="images/small/13.jpg" alt="image13" /></a></li>
					<li><a href="#"><img src="images/small/14.jpg" alt="image14" /></a></li>
					<li><a href="#"><img src="images/small/15.jpg" alt="image15" /></a></li>
					<li><a href="#"><img src="images/small/16.jpg" alt="image16" /></a></li>
					<li><a href="#"><img src="images/small/17.jpg" alt="image17" /></a></li>
					<li><a href="#"><img src="images/small/18.jpg" alt="image18" /></a></li>
					<li><a href="#"><img src="images/small/19.jpg" alt="image19" /></a></li>
					<li><a href="#"><img src="images/small/20.jpg" alt="image20" /></a></li>
				</ul>
				<!-- End Elastislide Carousel -->
            	
            </div><!--end of bestdeals-->
            
            <div id="social">
              <div class="fb_plugin">
                <div id="cbp-qtrotator" class="cbp-qtrotator">
                  <div class="cbp-qtcontent">
                    <blockquote>
                      <p>"A mealtime blessing from the Taittiriya Upanishad: "From food all creatures are produced, and all creatures that dwell on the earth, by food they live and into food they finally pass.  Food is the chief among beings.  Verily he obtains all good who worships the Divine as food."</p>
                    </blockquote>
                  </div>

                  <div class="cbp-qtcontent">
                    <blockquote>
                      <p>"After a good dinner one can forgive anybody, even one's own relations."</p>
                    </blockquote>
                  </div>
                  <div class="cbp-qtcontent">

                    <blockquote>
                      <p>"The secret of success in life is to eat what you like and let the food fight it out inside."</p>
                    </blockquote>
                  </div>
                  <div class="cbp-qtcontent">

                    <blockquote>
                      <p>"A good meal makes a man feel more charitable
                        toward the whole world than any sermon."</p>
                      </blockquote>
                    </div>
                    <div class="cbp-qtcontent">
                      <blockquote>
                        <p>“For each new morning with its light,<br />
                          For rest and shelter of the night,<br />
                          For health and food, for love and friends,<br />
                          For everything Thy goodness sends.”</p>
                        </blockquote>
                      </div>
                    </div>                    
                    <div class="follow"><a href="https://www.facebook.com/pages/Aahari/427042970729213">Join Us</a></div>
                  </div>
                  <div class="tw_plugin">
                    <div id="cbp-qtrotator2" class="cbp-qtrotator2">
                      <div class="cbp-qtcontent">
                        <blockquote>
                          <p>"eating is not merely a material pleasure. Eating well gives a spectacular joy to life and contributes immensely to goodwill and happy companionship. It is of great importance to the morale. -   Elsa Schiaparelli."</p>
                        </blockquote>
                      </div>

                      <div class="cbp-qtcontent">
                        <blockquote>
                          <p>"An onion can make people cry, but there has never been a vegetable invented to make them laugh."</p>
                        </blockquote>
                      </div>

                      <div class="cbp-qtcontent">           
                        <blockquote>
                          <p>"We provide food that customers love, day after day after day. People just want more of it."</p>
                        </blockquote>
                      </div>
                      <div class="cbp-qtcontent">

                        <blockquote>
                          <p>"Eating is really one of your indoor sports. You play three times a day, and it's well worth while to make the game as pleasant as possible."</p>
                        </blockquote>
                      </div>
                      <div class="cbp-qtcontent">
                        <blockquote>
                          <p>“We provide food that customers love, day after day after day. People just want more of it.”</p>
                        </blockquote>
                      </div>
                    </div>                
                    <div class="follow"><a href="https://twitter.com/aahariaahari">Follow Us</a></div>
                  </div>
                </div><!--end of social-->
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
