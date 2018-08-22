<?php
session_start();
function REST_DISH_autoloader($class) {
    require_once('manag/php/classes/' . $class . '.php');
    //echo $class;
}
spl_autoload_register('REST_DISH_autoloader');
$util = new Utilities();


if(isset($_REQUEST['name']))
{


$restaurant_name=$_REQUEST['name'];
$page=$_REQUEST['page'];

$rest = new Restaurant();
$dishs = new Dishes();
$res_id = $dishs->getRestIdByURL($restaurant_name);
//echo $res_id."$\n";

    if($res_id)
    {
        //echo $res_id;
        //echo "restaurant id ". $res_id;
        $rest = new Restaurant();
        $rest->getRestaurant($restaurant_name);
        $util->createCookie('_kps',$res_id);
    }   
}

if(!true)
    header("location: http://localhost/aahari/Aahari/view");
else
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aahari</title>
	<link rel="stylesheet" type="text/css" href="css/style2.css"  />
	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/elastislide.css" />  		
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>    
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>	
	<script type="text/javascript" src="js/jquery.skitter.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js" ></script>
    <script type="text/javascript" src="js/dval.js" ></script>
    <script type="text/javascript" src="js/jquery.sticky-kit.min.js"></script>
	<script src="js/modernizr.custom.17475.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>  
    <script type="text/javascript" src="js_popup/jquery.leanModal.min.js"></script>
    <script type="text/javascript" src="js_popup/core.js"></script>
    <link rel="stylesheet" href="css_popup/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="css_popup/style.css" />

	<script type="text/javascript" language="javascript">
		$(document).ready(function(){
			
			//menufilter
			$('.ulcontainer').hide(0);
			$('.searchmenu').click(function(e){
				e.preventDefault();
				$('.ulcontainer').toggle("slide");
			});

            $("#restromenu_right").stick_in_parent()
              .on("sticky_kit:stick", function(e) {
                  var hg =$( "#restropage" ).height();
                  var heights = hg-100;
                //$("#restromenu_right").css( "margin-top", "80px" );
              })
              .on("sticky_kit:unstick", function(e) {
                //$("#restromenu_right").css( "margin-top", "0px" );
                  
            });

						
			
			$('.box_skitter_large').skitter({animation: 'fade',easing_default: 'easeOutQuart' , label: false, numbers: false, theme: 'clean'});
		
		
    //rating color
            $('.r1').hover(
                    function(){ 
                        $('.r1').click().stop().css({backgroundColor: '#de1d0f'});                  
                        $('.ratingno').html("<img src=\"images/cancel.png\" />1");
                        $('#rateng').val("1");
                        $('.r2,.r3,.r4,.r5,.r6,.r7,.r8,.r9,.r10').stop().css({backgroundColor: 'white'});
                    },
                    function(){ 
                    
                    }       
            )
            $('.r2').hover(
                    function(){ 
                        $('.r2').stop().css({backgroundColor: '#fc3b2d'});
                        $('.r1').stop().css({backgroundColor: '#de1d0f'});                  
                        $('.ratingno').html("<img src=\"images/cancel.png\" />2");
                        $('#rateng').val("2");
                        $('.r3,.r4,.r5,.r6,.r7,.r8,.r9,.r10').stop().css({backgroundColor: 'white'});                       
                    },
                    function(){ }       
            )
            $('.r3').hover(
                    function(){ 
                        $('.r3').stop().css({backgroundColor: '#ff7668'});
                        $('.r2').stop().css({backgroundColor: '#fc3b2d'});
                        $('.r1').stop().css({backgroundColor: '#de1d0f'});
                        $('.ratingno').html("<img src=\"images/cancel.png\" />3");
                        $('#rateng').val("3");
                        $('.r4,.r5,.r6,.r7,.r8,.r9,.r10').stop().css({backgroundColor: 'white'});
                    },
                    function(){}        
            )
            $('.r4').hover(
                    function(){ 
                        $('.r4').stop().css({backgroundColor: '#efd816'});
                        $('.r3').stop().css({backgroundColor: '#ff7668'});
                        $('.r2').stop().css({backgroundColor: '#fc3b2d'});
                        $('.r1').stop().css({backgroundColor: '#de1d0f'});
                        $('.ratingno').html("<img src=\"images/cancel.png\" />4");
                        $('#rateng').val("4");
                        $('.r5,.r6,.r7,.r8,.r9,.r10').stop().css({backgroundColor: 'white'});                       
                    },
                    function(){}        
            )
            $('.r5').hover(
                    function(){ 
                        $('.r5').stop().css({backgroundColor: '#fae321'});
                        $('.r4').stop().css({backgroundColor: '#efd816'});
                        $('.r3').stop().css({backgroundColor: '#ff7668'});
                        $('.r2').stop().css({backgroundColor: '#fc3b2d'});
                        $('.r1').stop().css({backgroundColor: '#de1d0f'});
                        $('.ratingno').html("<img src=\"images/cancel.png\" />5");
                        $('#rateng').val("5");
                        $('.r6,.r7,.r8,.r9,.r10').stop().css({backgroundColor: 'white'});
                    },
                    function(){}        
            )
            $('.r6').hover(
                    function(){ 
                        $('.r6').stop().css({backgroundColor: '#edd614'});
                        $('.r5').stop().css({backgroundColor: '#fae321'});
                        $('.r4').stop().css({backgroundColor: '#efd816'});
                        $('.r3').stop().css({backgroundColor: '#ff7668'});
                        $('.r2').stop().css({backgroundColor: '#fc3b2d'});
                        $('.r1').stop().css({backgroundColor: '#de1d0f'});
                        $('.ratingno').html("<img src=\"images/cancel.png\" />6");
                        $('#rateng').val("6");
                        $('.r7,.r8,.r9,.r10').stop().css({backgroundColor: 'white'});
                    },
                    function(){}        
            )
            $('.r7').hover(
                    function(){ 
                        $('.r7').stop().css({backgroundColor: '#9acd32'});
                        $('.r6').stop().css({backgroundColor: '#edd614'});
                        $('.r5').stop().css({backgroundColor: '#fae321'});
                        $('.r4').stop().css({backgroundColor: '#efd816'});
                        $('.r3').stop().css({backgroundColor: '#ff7668'});
                        $('.r2').stop().css({backgroundColor: '#fc3b2d'});
                        $('.r1').stop().css({backgroundColor: '#de1d0f'});
                        $('.ratingno').html("<img src=\"images/cancel.png\" />7");
                        $('#rateng').val("7");
                        $('.r8,.r9,.r10').stop().css({backgroundColor: 'white'});
                    },
                    function(){ }       
            )
            $('.r8').hover(
                    function(){ 
                        $('.r8').stop().css({backgroundColor: '#689543'});
                        $('.r7').stop().css({backgroundColor: '#9acd32'});
                        $('.r6').stop().css({backgroundColor: '#edd614'});
                        $('.r5').stop().css({backgroundColor: '#fae321'});
                        $('.r4').stop().css({backgroundColor: '#efd816'});
                        $('.r3').stop().css({backgroundColor: '#ff7668'});
                        $('.r2').stop().css({backgroundColor: '#fc3b2d'});
                        $('.r1').stop().css({backgroundColor: '#de1d0f'});
                        $('.ratingno').html("<img src=\"images/cancel.png\" />8");
                        $('#rateng').val("8");
                        $('.r9,.r10').stop().css({backgroundColor: 'white'});

                    },
                    function(){ }       
            )
            $('.r9').hover(
                    function(){ 
                        $('.r9').stop().css({backgroundColor: '#305d02'});
                        $('.r8').stop().css({backgroundColor: '#689543'});
                        $('.r7').stop().css({backgroundColor: '#9acd32'});
                        $('.r6').stop().css({backgroundColor: '#edd614'});
                        $('.r5').stop().css({backgroundColor: '#fae321'});
                        $('.r4').stop().css({backgroundColor: '#efd816'});
                        $('.r3').stop().css({backgroundColor: '#ff7668'});
                        $('.r2').stop().css({backgroundColor: '#fc3b2d'});
                        $('.r1').stop().css({backgroundColor: '#de1d0f'});
                        $('.ratingno').html("<img src=\"images/cancel.png\" />9");
                        $('#rateng').val("9");
                        $('.r10').stop().css({backgroundColor: 'white'});
                    },
                    function(){}        
            )
            $('.r10').hover(
                    function(){ 
                        $('.r10').stop().css({backgroundColor: '#305d02'});
                        $('.r9').stop().css({backgroundColor: '#305d02'});
                        $('.r8').stop().css({backgroundColor: '#689543'});
                        $('.r7').stop().css({backgroundColor: '#9acd32'});
                        $('.r6').stop().css({backgroundColor: '#edd614'});
                        $('.r5').stop().css({backgroundColor: '#fae321'});
                        $('.r4').stop().css({backgroundColor: '#efd816'});
                        $('.r3').stop().css({backgroundColor: '#ff7668'});
                        $('.r2').stop().css({backgroundColor: '#fc3b2d'});
                        $('.r1').stop().css({backgroundColor: '#de1d0f'});                                              
                        $('.ratingno').html("<img src=\"images/cancel.png\" />10");
                        $('#rateng').val("10");
                    },
                    function(){}        
            )                                       

		});
</script> </head>
<body>
    <?php require_once('login_popup.php'); ?>
   	  <div id="header_wrapper">
        	<div id="menu">
            <div class="logo"><a href="https://www.aahari.com"><img src="images/Aahari_logo.png" width="158" height="68" /></a></div>
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
    	<div id="slider_wrapper">
        <div class="clear_80"></div>
        	<div id="slider">
    			<div id="restro_slider">
                	<div class="rating">4.5</div>
                    <div class="detail">
	                   <span><?php echo $rest->getRestaurantDisplayName() ?> </span> <?php echo $rest->getAreaName()?> <br />
                       <b>ADDRESS</b> : <?php echo $rest->getDoorno().", ".$rest->getLandmark().", ".$rest->getAreaName().", Hyderabad"?>
                    </div>
                </div>
                	<img src="images/restro/001.jpg" class="cubeRandom" />
                
			    
            </div><!--end of slider-->
            </div><!--end of slider wrapper-->
            <div class="clear_80"></div>
            <div id="content_wrapper">
          <div id="restropage">
          		<div class="menuul">
            	<ul>
            <?php if($page == "info")
                echo "<li><a href='view.php?page=info&name=".$rest->getRestURL()."' class='current'>INFO</a></li>";
               else
                echo "<li><a href='view.php?page=info&name=".$rest->getRestURL()."'>INFO</a></li>";
               if($page == "menu")
                echo "<li><a href='view.php?page=menu&name=".$rest->getRestURL()."' class='current'>MENU</a></li>";
               else
                echo "<li><a href='view.php?page=menu&name=".$rest->getRestURL()."'>MENU</a></li>";
               if($page == "photos")
                echo "<li><a href='view.php?page=photos&name=".$rest->getRestURL()."' class='current'>PHOTOS</a></li>"; 
               else
                echo "<li><a href='view.php?page=photos&name=".$rest->getRestURL()."'>PHOTOS</a></li>"; 
               if($page == "review")
                echo "<li><a href='view.php?page=review&name=".$rest->getRestURL()."' class='current'>REVIEW</a></li>";
               else
                echo "<li><a href='view.php?page=review&name=".$rest->getRestURL()."'>REVIEW</a></li>";
               if($page == "offers")
                echo "<li><a href='view.php?page=offers&name=".$rest->getRestURL()."' class='current'>OFFERS/ COUPONS</a></li>";
               else
                echo "<li><a href='view.php?page=offers&name=".$rest->getRestURL()."'>OFFERS/ COUPONS</a></li>";
               if($page == "map")
                echo "<li><a href='view.php?page=map&name=".$rest->getRestURL()."' class='current'>MAP</a></li>";
               else
                echo "<li><a href='view.php?page=map&name=".$rest->getRestURL()."'>MAP</a></li>";                              
            ?>
                </ul>
                </div>
    <?php if($page == "review") {?>
<!-- Start pf reviews -->
    <div id="login_wrapper">
            <strong style="color:#000";>REVIEW</strong>  <br />        
            <div id="review_message"></div>
           <form  method="post" id="reviewsForm" name="reviewsForm">
                <div class="clear_10"></div>
                <font style="color:#000; position:relative; float:left;">Your Ratings</font> <div class="ratingno"></div>
                <input type='hidden' name='rateng' id = "rateng"/>
                <input type="hidden" name="rev_rest_id" value = "<?php echo $res_id?>"/>
                <div class="clear_3"></div>
                <div class="rating r1"></div>
                <div class="rating r2"></div>
                <div class="rating r3"></div>
                <div class="rating r4"></div>
                <div class="rating r5"></div>
                <div class="rating r6"></div>
                <div class="rating r7"></div>
                <div class="rating r8"></div>
                <div class="rating r9"></div>
                <div class="rating r10"></div>                                
                <br />
                <div class="clear_3"></div>
                <font style="color:#000; margin-bottom:-10px;">Review Title in Short</font><br /><input type="text" id="rev_name" name="rev_name" placeholder="Title" maxlength="50" required="required" /><br />
                <font style="color:#000;">Message</font> <br /><textarea name="rev_message" id="rev_message" placeholder="Review" required="required" style="height:100px;"></textarea><br />
                <div class="clear_10"></div>
              <input type="submit" class="submit_btn" name="rev_submit" value="Post Review" />&nbsp;
            </form>
        </div><!--end of loign wrapper-->          
        <div class="clear_50"></div>
         <hr />
    <div class="comment_sec">
        <?php 
        $rev = new Reviews();
        echo $rev->getRestReviews($res_id);
        ?>
    </div>

        <!-- end pf reviews -->
        <!--
<div class="comment">
            <div class="username">Deepak Jagtap<br />
            <font size="-1">2 Days Ago</font>            
            </div>
           <!--  <div class="rated">
            rated as
            <b>Great !</b>
            </div>
            <div class="point">10</div>
            <div class="clear_10"></div>
            <div class="post">
                <p>Finally visited this place about which all my Pune friends kept raving. They accept reservations and given the rush its safe to book your table in advance. We preferred the indoor sitting ( what with the hot and dry weather in Pune this weekend).</p>

<p>The menu highlights the best dishes from Southeast Asia and to start off we ordered the Thai raw Papaya Salad, Malay Grilled Chicken and Steamed Fish in Pandang style. The salad was amazing with the tangy and chilly notes, the malay chicken grilled on skewers with pepper and kaffir lime leaves was succulent and the fish steamed in pandang leaves with a red chilly paste was average due to the basa selected.</p>

<p>For the main course we ordered the Taiwanese Chicken Stir-fry, Chicken in Red Thai curry, Singapore Chilly Noodles and Coriander rice. The Taiwanese stir-fry was great with chicken tossed in black bean sauce with zucchini and broccoli; the Red Thai curry was spicy and had the perfect mix of lemon grass, peppercorn, ginger, red coconut gravy with chicken which went well with the rice; the noodles were good with a combination of lemony and spicy taste.</p>
            </div>
            <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
    -->
<!-- START: Livefyre Embed 
<div style="width:80%; padding-left:10px">
<div id="livefyre-comments" style=""></div>
</div>
<?php echo $res_id;?>
<script type="text/javascript">
(function () {
    var articleId = fyre.conv.load.makeArticleId(null);
    fyre.conv.load({}, [{
        el: 'livefyre-comments',
        network: "livefyre.com",
        siteId: "355433",
        articleId: <?php echo $res_id?>,
        signed: false,
        collectionMeta: {
            articleId: <?php echo $res_id?>,
            url: fyre.conv.load.makeCollectionUrl(),
        }
    }], function() {});
}());
</script>
 END: Livefyre Embed -->            
    <?php }
     if($page == "info") { ?>
            <div id="middle">   
            <img src="images/services.png" width="18" height="18" />
            <b>SERVICES</b><div class="clear_5"></div>
            <span>
            <?php if($rest->findServices("DD",null)) {?>
             <img src="images/tag_right.png" width="18" height="18" /> Home Delivery &nbsp;&nbsp; 
             <?php }
             if($rest->findServices("TB",null)){  ?>
             <img src="images/tag_right.png" width="18" height="18" /> Table Booking &nbsp;&nbsp;
             <?php }
             if($rest->findServices("TA",null)){ ?>
             <img src="images/tag_right.png" width="18" height="18" /> Take Away &nbsp;&nbsp;
             <?php }
              if($rest->findServices("BH",null)){ ?>
              <img src="images/tag_right.png" width="18" height="18" /> Banquet Halls &nbsp;&nbsp;
              <?php }
              if($rest->findServices("PP",null)){ ?>
              <img src="images/tag_right.png" width="18" height="18" /> Party Planning &nbsp;&nbsp;
              <?php }
              if($rest->findServices("CT",null)){ ?>
              <img src="images/tag_right.png" width="18" height="18" /> Catering &nbsp;&nbsp;
              <?php }?>
 </span>
 <div class="clear_50"></div>
 <img src="images/cuisins.png" />
 <b>CUISINES</b><div class="clear_5"></div>
 <span><?php $dishs->getCuisinesByRestaurant($res_id)?>.</span>
 <div class="clear_50"></div>
 <img src="images/opening.png" />
 <b>OPENING HOURS</b><div class="clear_5"></div>
 <span><?php echo $rest->getDeliveryFrom12()." to ".$rest->getDeliveryTo12()?>.</span>
 <div class="clear_50"></div>
 <img src="images/tag.png" />
 <b>TAGS</b><div class="clear_5"></div>
 <span>
 <?php if($rest->findFeatures("Wifi")) { ?>
    <img src="images/tag_right.png" width="18" height="18" /> Wifi Internet &nbsp; &nbsp;
    <?php  } if($rest->findFeatures("AC")) {?>
    <img src="images/tag_right.png" width="18" height="18" /> Air Conditioned &nbsp; &nbsp;
    <?php } if($rest->findFeatures("BAR")) {?>
    <img src="images/tag_right.png" width="18" height="18" /> Bar &nbsp; &nbsp;
    <?php } if($rest->findFeatures("Smoking")) {?>
    <img src="images/tag_right.png" width="18" height="18" /> Smoking Zone &nbsp; &nbsp;
    <?php } ?>
</span>
<div class="clear_50"></div>
<img src="images/accept.png" />
<b>WE ACCEPT</b><div class="clear_5"></div>
<span><?php  
$comma = false;
if($rest->findPayment("Cash"))
{
    echo "Cash";
    $comma = true;
}
if($rest->findPayment("Sodexo"))
{
    if($comma)
    {
        echo ", ";
        echo "Sodexo";
    }
    else echo "Sodexo";
    $comma = true;
}

if($rest->findPayment("Online"))
{
    if($comma)
    {
        echo ", ";
        echo "Online Payment";
    }
    else echo "Online Payment";
    
    $comma = true;
}

if($rest->findPayment("Card"))
{
    if($comma)
    {
        echo ", ";
        echo "Credit/Debit Card";
    }
    else echo "Credit/Debit Card";
    
    $comma = true;
}   
?></span>
<div class="clear_50"></div>
<img src="images/tag.png" />
<b>ABOUT US</b><div class="clear_5"></div>
<span><?php  echo $rest->getAboutUs() ?></span>
<div class="clear_50"></div>
<!--<b><a href="#" id="show_article1" class="report">REPORT CHANGES</a></b><br />-->
</div><!--end of middle -->
    <?php } ?>
    <?php if($page == "menu") { 
        $util = new Utilities();
        $cat_ary = $util->getCategoriesForRestaurant($res_id);

        ?>
                
                <div id="restromenu_left">                
                <div id="menu_filter">
					<font size="+1"><div class="searchmenu">Search Menu &nbsp;<img src="images/filter_search.png" width="18" height="22" /></div></font>
                    <div class="clear_3"></div>
                    <div class="ulcontainer">
                    <hr />
                    Veg
					<ul>
                        <?php
                        $veg_cat = $cat_ary['Veg'];
                        if(isset($veg_cat))
                        {
                        foreach ($veg_cat as $key => $value) {
                            echo "<li><a href='#'>".$value."</a></li>";
                           }
                        }
                        ?>
                    <!--	<li><a href="#">Pulav</a></li>
                        <li><a href="#">Rice</a></li>
                        <li><a href="#">Paneer Tikka</a></li>
                        <li><a href="#">Veg biryani</a></li>
                        <li><a href="#">Pulav</a></li>
                        <li><a href="#">Rice</a></li>
                        <li><a href="#">Paneer Tikka</a></li>
                        <li><a href="#">Veg biryani</a></li>-->
                    </ul>        
                    <div class="clear_3"></div>
                    
                    <hr />
                    Non Veg
					<ul>
                        <?php 
                        $veg_cat = $cat_ary['NonVeg'];
                        if(isset($veg_cat))
                        {
                        foreach ($veg_cat as $key => $value) {
                            echo "<li><a href='#'>".$value."</a></li>";
                            }
                        }
                        ?><!--
                    	<li><a href="#">Chicken</a></li>
                        <li><a href="#">Biryani</a></li>
                        <li><a href="#">Tanduri</a></li>-->
                    </ul>        
                    <div class="clear_3"></div>
                    
                    <hr />
                    Beverages
					<ul>
                        <?php 
                        $veg_cat = $cat_ary['Beverage'];
                        if(isset($veg_cat))
                        {
                        foreach ($veg_cat as $key => $value) {
                            echo "<li><a href='#'>".$value."</a></li>";
                            }
                        }
                        ?><!--
                    	<li><a href="#">Gulab Jamun</a></li>
                        <li><a href="#">Kheer</a></li> -->
                    </ul>        
                    
                    
					</div><!--end of ulcontainer-->
                  <div class="clear_3"></div> 
                </div><!--end of menu filter-->

                <?php
                
                $dish_ary = $util->getDishesForRestaurant($res_id);
                
                foreach($dish_ary as $key => $value)
                {
                    echo "<div class='restro_menu' style='height:15px; padding-top:5px; background-color: #ECF04A;'> 
                            ".$key."
                            </div>";
                    foreach($value as $ky => $val)
                    {
                        
                        echo "<div class='restro_menu'>
                                ".$val['dish_name']."
                                <a href='javascript:add_to_cart(".$ky.");' class='addbttn'>+</a>
                                
                                <input type='text' id='quant_".$ky."' name='no' placeholder='0' value='1' />                    
                                <div class='price'> Rs. ".$val['dish_price']." &nbsp; </div>
                            </div>";
                        //<input type='submit' value='+' class='addbttn' />
                    }
                        
                }
                
                ?>                
              </div><!--end of restro menu float left-->                               
              <div id="restromenu_right">
                <form action='post_menu.php' method='post'>
              	<div style="background-color:#f55856; height:30px; padding-top:10px; border-radius:5px; font-size:18px; color:#fff;"><center><b>Your Order</b></center></div>
                <div class="clear_10"></div>
                <input type="radio" name="ordertype" />Home Delivery
                <input type="radio" name="ordertype" />Table Booking
                <input type="radio" name="ordertype" />Take Away
                <hr />
                <div class="clear_10"></div>
				<div class="cart_items">
                    <?php
                    $cart = new Cart();
                    echo $cart->display_cart_widget($res_id);
                    ?>
                </div>                                
                <div class="clear_10"></div><div class="clear_10"></div>           
                <center><input type="submit" value="Order Now" class="btn2" /></center>                
                <div class="clear_10"></div>
                </form>
              </div><!--end of restro menu float right-->
<?php } 
if($page == "map")
{
    //echo $rest->getLatitude();
?>

<script type="text/javascript">
var mapDat = <?php echo "{lat:".$rest->getLatitude().",lon:".$rest->getLongitude()."};"?>
loadScript();
</script>
<div class="mapholder" style="height:450px;width:950px"><div id="map-canvas" style="height:100%; width:100%"></div></div>
<?php ////{<?php echo $rest->lat:13.0460760000,lon:80.2331970000};
//var mapDat = {lat:12.826777,lon:80.212906};
}
?>

              <div class="clear_10"></div>     
          </div><!--end of restropage-->
          <div class="clear_80"></div><div class="clear_10"></div>            
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
            <div id="copyright">Aahari © 2013</div>
        </div><!--end of footer-->               
		<script type="text/javascript" src="js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel' ).elastislide();
			
		</script>
    

    
</body>
</html>
