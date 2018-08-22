<?php
session_start();
require_once('manag/php/classes/DBConnect.php');
require_once('manag/php/classes/Restaurant.php');
require_once('manag/php/classes/Utilities.php');
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
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/jquery.skitter.min.js"></script>
    <script src="http://cdn.webrupee.com/js" type="text/javascript"></script>
    <script src="js/modernizr.custom.17475.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <script type="text/javascript" src="js_popup/jquery.leanModal.min.js"></script>
    <script type="text/javascript" src="js_popup/core.js"></script>
    <link rel="stylesheet" href="css_popup/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="css_popup/style.css" />    
    <script type="text/javascript" language="javascript">
    $(document).ready(function(){
			//searchbox slider
			
         $('.restro_rit_bx .delivr').hover(function(){ $(this).children("span").toggle()},function(){ $(this).children("span").toggle() });

         $('.box_skitter_large').skitter({animation: 'fade',easing_default: 'easeOutQuart' , label: false, numbers: false, theme: 'clean'});


         $('#show_article,#show_article1').click(function(e){
            e.preventDefault();

            $('<div></div>').attr('id', 'overlay').appendTo('body').hide().fadeIn("slow");		

            htmlarticle=$(this).attr('class');
            $('<iframe>').attr('src',"images/pop_ups/"+htmlarticle+".html").attr('id', 'overlayiframe').appendTo('#overlay');

            $('#overlay').click(function(e){
                $('#overlay').fadeOut("slow",function(){ $(this).remove(); });
            })
        });

         $('input:checkbox').change(function() {
                //alert($(this).parent().children('a').attr('href'));
                $(location).attr('href',$(this).parent().children('a').attr('href'));
                    //.find('a').attr('href'))
        });
    
});

</script> </head>
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
<div class="clear_80"></div>
<div id="content_wrapper">
    <div id="restropage">
        <div id="filter_wrapper">
            <form name='restro_filter' id='restro_filter'>
                <ul id="nav">
                    <li style="font-weight:bold; padding:12px; background-color:#F55856; color:#fff;">Filter</li>
                    <li><a href="#s1"> location</a>
                        <ul class="subs">
                            <div class="clear_3"></div>
                            <li>Locations
                                <div class="float_r"><input type="submit" value="filter"/><input type="reset" value="Reset"/></div>
                                <div class="clear_10"></div>
                                <ul>
                                    <?php
                                // $areas = '';
                                    $areas = $util->getAreas();
                                foreach ($areas as $key => $value) {//area=".$key."
                            if((strpos($_REQUEST['area'], $value)) !== false)
                                 echo "<li><label><input name='rest_areas[]' checked type='checkbox' value='".$key."' /><a href='search.php".$util->getAreaURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],$value)."'>".$value."</a></label></li>";
                            else
                                 echo "<li><label><input name='rest_areas[]' type='checkbox' value='".$key."' /><a href='search.php".$util->getAreaURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],$value)."'>".$value."</a></label></li>";
                         }
                         ?>                                
                     </ul>
                 </li>
             </ul>
         </li>
         <li class="active"><a href="#s2">cuisine</a>
            <ul class="subs">
               <div class="clear_3"></div>
               <li>Cuisine
                <div class="float_r"><input type="submit" value="filter"/><input type="reset" value="Reset"/></div>
                <div class="clear_10"></div> 
                <ul>
                    <?php
                              //   $cuisines ='';
                    $cuisines = $util->getCuisines();
                    foreach ($cuisines as $key => $value) {
                        if((strpos($_REQUEST['cuisine'], $value)) !== false)
                            echo "<li><input name='rest_cuisines[]' checked type='checkbox' value='".$key."' /><a href='search.php".$util->getCuisineURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],$value)."'>".$value."</a></li>";
                        else
                            echo "<li><input name='rest_cuisines[]' type='checkbox' value='".$key."' /><a href='search.php".$util->getCuisineURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],$value)."'>".$value."</a></li>";
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </li>
    <li class="active"><a href="#s3">Type of Food</a>
        <ul class="subs">
            <div class="clear_3"></div>
            <li>Type of Food
                <div class="float_r"><input type="submit" value="filter"/><input type="reset" value="Reset"/></div>
                <div class="clear_10"></div>

                <ul>
                    <?php
                    if((strpos($_REQUEST['ft'], "Veg")) !== false)
                        echo "<li><input type='checkbox' value='Veg' checked /><a href='search.php".$util->getFoodTypeURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"Veg")."'>Veg</a></li>";
                    else
                        echo "<li><input type='checkbox' value='Veg' /><a href='search.php".$util->getFoodTypeURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"Veg")."'>Veg</a></li>";

                    if((strpos($_REQUEST['ft'], "NonVeg")) !== false)
                        echo "<li><input type='checkbox' value='NonVeg' checked /><a href='search.php".$util->getFoodTypeURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"NonVeg")."'>Non Veg</a></li>";
                    else
                        echo "<li><input type='checkbox' value='NonVeg' /><a href='search.php".$util->getFoodTypeURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"NonVeg")."'>Non Veg</a></li>";

                    if((strpos($_REQUEST['ft'], "Beverage")) !== false)
                        echo "<li><input type='checkbox' value='Beverage' checked /><a href='search.php".$util->getFoodTypeURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"Beverage")."'>Beverage</a></li>";
                    else
                        echo "<li><input type='checkbox' value='Beverage' /><a href='search.php".$util->getFoodTypeURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"Beverage")."'>Beverage</a></li>";
                    ?>
                </ul>
            </li>
        </ul>
    </li>
    <li class="active"><a href="#s4">More</a>
        <ul class="subs">
            <div class="clear_3"></div>
            <li>More
                <div class="float_r"><input type="submit" value="filter"/><input type="reset" value="Reset"/></div>
                <div class="clear_10"></div>

                <ul>
                    <?php
                    if((strpos($_REQUEST['fr'], "Wifi")) !== false)
                        echo "<li><input type='checkbox' checked /><a href='search.php".$util->getFeaturesURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"Wifi")."'>Wi-fi</a></li>";
                    else
                        echo "<li><input type='checkbox' /><a href='search.php".$util->getFeaturesURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"Wifi")."'>Wi-fi</a></li>";

                    if((strpos($_REQUEST['fr'], "AC")) !== false)
                        echo "<li><input type='checkbox' checked /><a href='search.php".$util->getFeaturesURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"AC")."'>Air Conditioner</a></li>";
                    else
                        echo "<li><input type='checkbox' /><a href='search.php".$util->getFeaturesURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"AC")."'>Air Conditioner</a></li>";

                    if((strpos($_REQUEST['fr'], "Smoking")) !== false)
                        echo "<li><input type='checkbox' checked /><a href='search.php".$util->getFeaturesURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"Smoking")."'>Smoking Zone</a></li>";
                    else
                        echo "<li><input type='checkbox' /><a href='search.php".$util->getFeaturesURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"Smoking")."'>Smoking Zone</a></li>";

                    if((strpos($_REQUEST['fr'], "BAR")) !== false)
                        echo "<li><input type='checkbox' checked /><a href='search.php".$util->getFeaturesURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"BAR")."'>Bar</a></li><br />";
                    else
                        echo "<li><input type='checkbox' /><a href='search.php".$util->getFeaturesURL($_REQUEST['cuisine'],$_REQUEST['area'],$_REQUEST['ft'],$_REQUEST['fr'],"BAR")."'>Bar</a></li><br />";
                    ?>
                </ul>
            </li>
        </ul>
    </li>
</ul>
</form>
</div>
<div class = "restro_data">
    <?php
    $db=new DBConnect();
    $con = $db->getDBConnection();
    $fil_areas    = isset($_REQUEST['area'])?explode(',', $_REQUEST['area']): array();
    $fil_cuisines    = isset($_REQUEST['cuisine'])?explode(',', $_REQUEST['cuisine']):array();
    $fil_food = isset($_REQUEST['ft'])?explode(',', $_REQUEST['ft']):array();
    $area_params = !empty($fil_areas)?implode(",", array_fill(0, count($fil_areas), "?")):"";
    $cuisines_params = !empty($fil_cuisines)?implode(",", array_fill(0, count($fil_cuisines), "?")):"";
    $food_params = !empty($fil_food)?implode(",", array_fill(0, count($fil_food), "?")):"";

    if(isset($_REQUEST['dt']))
    {
        $fil_delivery_type    = explode(',', $_REQUEST['dt']);
        $delivery_type_params = implode(" and ", array_fill(0, count($fil_delivery_type), "r.services LIKE ?"));
        foreach ($fil_delivery_type as $key => &$value)
            $value = "%".$value."%";
    }

    if(isset($_REQUEST['fr']))
    {
        $fil_features    = explode(',', $_REQUEST['fr']);
        $features_params = implode(" and ", array_fill(0, count($fil_features), "r.features LIKE ?"));
        foreach ($fil_features as $key => &$value)
            $value = "%".$value."%";
    }

    $final_array = array();

   // echo "%%%".$delivery_type_params."%%%";
    //echo "%%%".$cuisines_params."%%%";
    //echo "%%%".$food_params."%%%";
    if(isset($_REQUEST['area']) && isset($_REQUEST['cuisine']) && isset($_REQUEST['ft']))
    {
        $delivery_type_params = isset($_REQUEST['dt'])?" and ".$delivery_type_params:"";
        $features_params = isset($_REQUEST['fr'])?" and ".$features_params:"";
        $sql_q = "SELECT DISTINCT r.id,r.name as rest_name, r.rest_url, mindeliveryamount, start_time, end_time, a.name as area_name from restaurants r, areas a, cuisines c, dishes d where r.area_id=a.id and d.restaurant_id = r.id and d.cuisine_id = c.id 
        and a.name IN ($area_params) and c.name IN($cuisines_params) and d.veg IN($food_params) $delivery_type_params $features_params";
        //echo "<br/>".$sql_q."<br/>";
        //echo "<br/>".$sql_q."<br/>";
        $st = $con->prepare($sql_q);

        if(!empty($fil_areas)) 
            $final_array = array_merge($final_array,$fil_areas);
        if(!empty($fil_cuisines))
            $final_array = array_merge($final_array,$fil_cuisines);
        if(!empty($fil_delivery_type))
            $final_array = array_merge($final_array,$fil_delivery_type);
        if(!empty($fil_features))
            $final_array = array_merge($final_array,$fil_features);
        if(!empty($fil_food))
            $final_array = array_merge($final_array,$fil_food);
        //var_dump($final_array);
        $st->execute($final_array);
    }
    else if(isset($_REQUEST['area']) && isset($_REQUEST['cuisine']))
    {
        $delivery_type_params = isset($_REQUEST['dt'])?" and ".$delivery_type_params:"";
        $features_params = isset($_REQUEST['fr'])?" and ".$features_params:"";
        $sql_q = "SELECT DISTINCT r.id,r.name as rest_name, r.rest_url, mindeliveryamount, start_time, end_time, a.name as area_name from restaurants r, areas a, cuisines c, dishes d where r.area_id=a.id and d.restaurant_id = r.id and d.cuisine_id = c.id 
        and a.name IN ($area_params) and c.name IN($cuisines_params) $delivery_type_params $features_params";
        //echo "<br/>".$sql_q."<br/>";
        //echo "<br/>".$sql_q."<br/>";
        $st = $con->prepare($sql_q);

        if(!empty($fil_areas)) 
            $final_array = array_merge($final_array,$fil_areas);
        if(!empty($fil_cuisines))
            $final_array = array_merge($final_array,$fil_cuisines);
        if(!empty($fil_delivery_type))
            $final_array = array_merge($final_array,$fil_delivery_type);
        if(!empty($fil_features))
            $final_array = array_merge($final_array,$fil_features);
        if(!empty($fil_food))
            $final_array = array_merge($final_array,$fil_food);
        //var_dump($final_array);
        $st->execute($final_array);
    }
    else if(isset($_REQUEST['cuisine']) && isset($_REQUEST['ft']))
    {
        $delivery_type_params = isset($_REQUEST['dt'])?" and ".$delivery_type_params:"";
        $features_params = isset($_REQUEST['fr'])?" and ".$features_params:"";
        $sql_q = "SELECT DISTINCT r.id,r.name as rest_name, r.rest_url, mindeliveryamount, start_time, end_time, a.name as area_name from restaurants r, areas a, cuisines c, dishes d where r.area_id=a.id and d.restaurant_id = r.id and d.cuisine_id = c.id 
        and c.name IN($cuisines_params) and d.veg IN($food_params) $delivery_type_params $features_params";
        //echo "<br/>".$sql_q."<br/>";
        //echo "<br/>".$sql_q."<br/>";
        $st = $con->prepare($sql_q);

        if(!empty($fil_areas)) 
            $final_array = array_merge($final_array,$fil_areas);
        if(!empty($fil_cuisines))
            $final_array = array_merge($final_array,$fil_cuisines);
        if(!empty($fil_delivery_type))
            $final_array = array_merge($final_array,$fil_delivery_type);
        if(!empty($fil_features))
            $final_array = array_merge($final_array,$fil_features);
        if(!empty($fil_food))
            $final_array = array_merge($final_array,$fil_food);
        //var_dump($final_array);
        $st->execute($final_array);
    }
    else if(isset($_REQUEST['area']) && isset($_REQUEST['ft']))
    {
        $delivery_type_params = isset($_REQUEST['dt'])?" and ".$delivery_type_params:"";
        $features_params = isset($_REQUEST['fr'])?" and ".$features_params:"";
        $sql_q = "SELECT DISTINCT r.id,r.name as rest_name, r.rest_url, mindeliveryamount, start_time, end_time, a.name as area_name from restaurants r, areas a, cuisines c, dishes d where r.area_id=a.id and d.restaurant_id = r.id and d.cuisine_id = c.id 
        and a.name IN ($area_params) and d.veg IN($food_params) $delivery_type_params $features_params";
        //echo "<br/>".$sql_q."<br/>";
        //echo "<br/>".$sql_q."<br/>";
        $st = $con->prepare($sql_q);

        if(!empty($fil_areas)) 
            $final_array = array_merge($final_array,$fil_areas);
        if(!empty($fil_cuisines))
            $final_array = array_merge($final_array,$fil_cuisines);
        if(!empty($fil_delivery_type))
            $final_array = array_merge($final_array,$fil_delivery_type);
        if(!empty($fil_features))
            $final_array = array_merge($final_array,$fil_features);
        if(!empty($fil_food))
            $final_array = array_merge($final_array,$fil_food);
        //var_dump($final_array);
        $st->execute($final_array);
    }
    else if(isset($_REQUEST['ft']))
    {
        $delivery_type_params = isset($_REQUEST['dt'])?" and ".$delivery_type_params:"";
        $features_params = isset($_REQUEST['fr'])?" and ".$features_params:"";
        $sql_q = "SELECT DISTINCT r.id,r.name as rest_name, r.rest_url, mindeliveryamount, start_time, end_time, a.name as area_name from restaurants r, areas a, cuisines c, dishes d where r.area_id=a.id and d.restaurant_id = r.id and d.cuisine_id = c.id 
        and d.veg IN($food_params) $delivery_type_params $features_params";
        //echo "<br/>".$sql_q."<br/>";
        //echo "<br/>".$sql_q."<br/>";
        $st = $con->prepare($sql_q);

        if(!empty($fil_areas)) 
            $final_array = array_merge($final_array,$fil_areas);
        if(!empty($fil_cuisines))
            $final_array = array_merge($final_array,$fil_cuisines);
        if(!empty($fil_delivery_type))
            $final_array = array_merge($final_array,$fil_delivery_type);
        if(!empty($fil_features))
            $final_array = array_merge($final_array,$fil_features);
        if(!empty($fil_food))
            $final_array = array_merge($final_array,$fil_food);
        //var_dump($final_array);
        $st->execute($final_array);
    }
    else if(isset($_REQUEST['area'])){
        $delivery_type_params = isset($_REQUEST['dt'])?" and ".$delivery_type_params:"";
        $features_params = isset($_REQUEST['fr'])?" and ".$features_params:"";

        $sql_q = "SELECT DISTINCT r.id,r.name as rest_name, r.rest_url, mindeliveryamount, start_time, end_time, a.name as area_name from restaurants r, areas a, cuisines c, dishes d where r.area_id=a.id and d.restaurant_id = r.id and d.cuisine_id = c.id and a.name IN ($area_params) $delivery_type_params $features_params";
        $st = $con->prepare($sql_q);
        if(!empty($fil_areas))
            $final_array = array_merge($final_array,$fil_areas);
        if(!empty($fil_cuisines))
            $final_array = array_merge($final_array,$fil_cuisines);
        if(!empty($fil_delivery_type))
            $final_array = array_merge($final_array,$fil_delivery_type);
        if(!empty($fil_features))
            $final_array = array_merge($final_array,$fil_features);
        if(!empty($fil_food))
            $final_array = array_merge($final_array,$fil_food);

        $st->execute($final_array);
    }
    else if(isset($_REQUEST['cuisine'])){
        $delivery_type_params = isset($_REQUEST['dt'])?" and ".$delivery_type_params:"";
        $features_params = isset($_REQUEST['fr'])?" and ".$features_params:"";

        $sql_q = "SELECT DISTINCT r.id,r.name as rest_name, r.rest_url, mindeliveryamount, start_time, end_time, a.name as area_name from restaurants r, areas a, cuisines c, dishes d where r.area_id=a.id and d.restaurant_id = r.id and d.cuisine_id = c.id and c.name IN($cuisines_params)  $delivery_type_params $features_params";
        $st = $con->prepare($sql_q);
        if(!empty($fil_areas))
            $final_array = array_merge($final_array,$fil_areas);
        if(!empty($fil_cuisines))
            $final_array = array_merge($final_array,$fil_cuisines);
        if(!empty($fil_delivery_type))
            $final_array = array_merge($final_array,$fil_delivery_type);
        if(!empty($fil_features))
            $final_array = array_merge($final_array,$fil_features);
        if(!empty($fil_food))
            $final_array = array_merge($final_array,$fil_food);
        $st->execute($final_array);
    }
    else if(isset($_REQUEST['dt']) || isset($_REQUEST['fr']))
    {
        $delivery_type_params = isset($_REQUEST['dt'])?" and ".$delivery_type_params:"";
        $features_params = isset($_REQUEST['fr'])?" and ".$features_params:"";

        $sql_q = "SELECT DISTINCT r.id,r.name as rest_name, r.rest_url, mindeliveryamount, start_time, end_time, a.name as area_name from restaurants r, areas a, cuisines c, dishes d where r.area_id=a.id and d.restaurant_id = r.id and d.cuisine_id = c.id  $delivery_type_params $features_params";
        $st = $con->prepare($sql_q);
        if(!empty($fil_areas))
            $final_array = array_merge($final_array,$fil_areas);
        if(!empty($fil_cuisines))
            $final_array = array_merge($final_array,$fil_cuisines);
        if(!empty($fil_delivery_type))
            $final_array = array_merge($final_array,$fil_delivery_type);
        if(!empty($fil_features))
            $final_array = array_merge($final_array,$fil_features);
        if(!empty($fil_food))
            $final_array = array_merge($final_array,$fil_food);

        $st->execute($final_array);

    }
    else if(!isset($_REQUEST['ft']) && !isset($_REQUEST['fr']) && !isset($_REQUEST['area']) && !isset($_REQUEST['cuisine']))
    {
        $sql_q = "SELECT DISTINCT r.id,r.name as rest_name, r.rest_url, mindeliveryamount, start_time, end_time, a.name as area_name from restaurants r, areas a, cuisines c, dishes d where r.area_id=a.id and d.restaurant_id = r.id and d.cuisine_id = c.id";
        $st = $con->prepare($sql_q);
        $st->execute();
    }

    while($rp=$st->fetch())
    {
      $rest = new Restaurant();
      $rest->getRestaurant($rp['rest_url']);   
      ?>
      <div class="clear_40"></div>
      <div class="restro_info">
        <?php 
        date_default_timezone_set('Asia/Calcutta');
        $date = date('H:i:s');
        if($rest->isOpen($date))
            echo "<div class='open'>Open Now</div>";
        else
            echo "<div class='open' style='background-color:#FF6E6E;'>Closed Now</div>";
                //$name=str_replace('-',' ',$name);
                //urlencode(str_replace(' ', '-', $rp['rest_name']))
                //$rp['rest_name']
        ?>
        <div class="clear_10"></div>
        <div class="heading"><a href="view.php?page=info&name=<?php echo $rest->getRestURL()?>"><?php echo $rest->getName()?></a><font size="-1">, <?php echo $rp['area_name']?></font> &nbsp;
            <br />
            <img src="images/star.png" width="23" height="23" />
            <img src="images/star.png" width="23" height="23" />
            <img src="images/star.png" width="23" height="23" />
            <img src="images/star.png" width="23" height="23" />
        </div>                
        <div class="restro_middle">

            <div class="clear_10"></div>
            <?php
            try{
                $prt = $con->prepare("SELECT DISTINCT c.name from cuisines c, dishes d,restaurants r where d.restaurant_id=r.id and d.cuisine_id=c.id and r.id=? order by name ASC");
                $prt->execute(array($rp['id']))or die(print_r($prt->errorInfo(),true));
                            //echo $prt->rowCount();
                echo "<b>";
                while($pt = $prt->fetch())
                {
                    echo $pt['name'].", ";                          
                }
                echo "</b>";
            }
            catch(Exception $e)
            {
                $e->getMessage();
                print_r($e->getTraceAsString());
            }
            ?>
            <br /><div class="clear_10"></div><div class="clear_10"></div>
            Minimum Delivery Amount :<div class="coin"><font color="#333333" ><b>Rs.<?php echo $rest->getMinDeliveryAmount()?></b></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| Open time : <?php echo $rest->getDeliveryFrom12()?>  to <?php echo $rest->getDeliveryTo12()?></div> 
        </div>
        <div class="restro_right">
            <div class="restro_right_fade">
                <?php
                    //$rp['mindeliveryamount']
                if($rest->findServices("DD",$rp['id']))                    
                    echo "<img src='images/home_delivery.png' width='30' height='30' />&nbsp;&nbsp;";
                else
                    echo "<img src='images/home_delivery.png' class='not_available' width='30' height='30' />&nbsp;&nbsp;";
                if($rest->findServices("TB",$rp['id']))                    
                    echo "<img src='images/table_booking_2.png' width='30' height='30' />&nbsp;&nbsp;";
                else
                    echo "<img src='images/table_booking_2.png' class='not_available' width='30' height='30' />&nbsp;&nbsp;";
                if($rest->findServices("TA",$rp['id']))                    
                    echo "<img src='images/take_away_2.png' width='30' height='30' />";
                else
                    echo "<img src='images/take_away_2.png' class='not_available' width='30' height='30' />";

                ?>
            </div>
            <div class="clear_40"></div>
            <div class= "restro_rit_bx">
             <a class="delivr" href=""><span>Where we Deliver?</span><span style="display: none"><?php echo $rest->getDeliverDistance()."Kms";?></span></a><br />
             <a href="view.php?page=map&name=<?php echo $rest->getRestURL()?>">Locate Us</a><br />                    
             <a href="">Offers and Coupons</a>
         </div>
     </div>                   

 </div><!--end of restro info-->
 <?php
}
?>

</div>
<div class="clear_10"></div>     
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
<script type="text/javascript" src="js/jquerypp.custom.js"></script>
<script type="text/javascript" src="js/jquery.elastislide.js"></script>
<script type="text/javascript">

$( '#carousel' ).elastislide();

</script>



</body>
</html>
