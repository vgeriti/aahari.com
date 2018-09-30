<?php
// if(isset($_SESSION['user_a']) && )
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Aahari -Manage my Restaurant</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link href="css/core.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	<link href="css/token-input-facebook.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery.min.js" ></script>
	<script type="text/javascript" src="js/jquery.validate.js" ></script>
	<script type="text/javascript" src="js/jquery.tokeninput.js" ></script>
	<script type="text/javascript" src="js/val.js" ></script>
</head>
<body>
	<div id="topbarCore"></div>
	<div class="wraper clearfix">
		<div class="side_bar">
			<ul class="nav nav-list">
				<li class="nav-header">Restaurant Name</li>
				<!-- <li class="active"><a href="/aahari/manage/profile">Profile</a></li> 
                http://localhost/aahari/operations.php?_aXTL=restaurant&name=sitara-->
				<li class="active"><a href="operations.php?_aXTL=restaurant&name=<?php echo $_REQUEST['name']?>">Restaurant</a></li>
				<!-- <li><a href="/aahari/manage/cuisines">Cuisines</a></li> -->
				<li><a href="operations.php?_aXTL=dishes&_id=new&name=<?php echo $_REQUEST['name']?>">Dishes</a></li>
			</ul>
		</div>
		<div class="main_body">
			<!--//Start of profile data	-->
<?php 
	require_once 'php/classes/DBConnect.php';
	$d= new DBConnect();
	$db=$d->getDBConnection();
if(isset($_REQUEST['_aXTL']) && $_REQUEST['_aXTL']=="restaurant"){
	include 'php/classes/Restaurant.php';
	$rest=new Restaurant();	
	if($_REQUEST['name'] != "new")
	{
		echo "from url existing restaurant ";
	$rest->getRestaurant($_REQUEST['name']);
	echo $rest->getId();
	}
	else
	{
		echo "from url new restaurant ";		
			$rest->setNewOne();
	}
	echo $rest->getServices();
	
	
	?>
	<script type="text/javascript">
	$(document).ready(function(e) {

		$('input[name="ResServices[]"].ResServices').each(function() {
			var a=<?php echo $rest->getServices().";"?>
			if(a.indexOf($(this).val())> -1)
				$(this).attr('checked','checked');
		});
		
		$('input[name="ResFeatures[]"].ResFeatures').each(function() {
			var a=<?php echo $rest->getFeatures().";"?>
			if(a.indexOf($(this).val())> -1)
				$(this).attr('checked','checked');
		});
		
		$('input[name="ResClosedOn[]"].ResClosedOn').each(function() {
			var a=<?php echo $rest->getClosedOn().";"?>
			if(a.indexOf($(this).val())> -1)
				$(this).attr('checked','checked');
		});
		$('input[name="paymentOptions[]"].paymentOptions').each(function() {
			var a=<?php echo $rest->getPayment().";"?>
			if(a.indexOf($(this).val())> -1)
				$(this).attr('checked','checked');
		});
	});
	</script>
	<form class="form-horizontal" id="restaurantFrm" name="restaurantFrm">
		<div class="control-group">
			<label class="control-label" for="ResDispName">Display Name</label>
			<div class="controls">
				<input type="text" id="ResDispName" name="ResDispName" placeholder="Display Name" value="<?php echo $rest->getName();?>">
			</div>
		</div>
		<?php
		if($rest->getNewOne())
		echo "<input type='hidden' id='rest_stat' name='rest_stat' value='n'>";
		else
		echo "<input type='hidden' id='rest_stat' name='rest_stat' value='".$rest->getId()."'>";
		?>
		<div class="control-group">
			<label class="control-label" for="ResOrdersEmail">Orders E-mail</label>
			<div class="controls">
				<input type="text" id="ResOrdersEmail" name="ResOrdersEmail" placeholder="Display Name" value="<?php echo $rest->getOrderEmail() ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResFeedEmail">Feedback/Queries E-mail</label>
			<div class="controls">
				<input type="text" id="ResFeedEmail" name="ResFeedEmail" placeholder="Feedback Email" value="<?php echo $rest->getFeedbackEmail() ?>">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="ResArea">Area</label>
			<div class="controls">
            <select name="ResArea" id="ResArea">
            <option selected="selected" disabled="disabled">Select Area</option>
            <?php
			$stmt = $db->prepare("SELECT * from areas");
			$stmt->execute();
			while($ft = $stmt->fetch())
			{
				if($rest->getArea() == $ft['id'])				
					echo "<option value='".$ft['id']."' selected='selected'>".$ft['name']."</option>";
				else
					echo "<option value='".$ft['id']."'>".$ft['name']."</option>";	
			}
			?>
            </select>
		<!--		<input type="text" id="ResArea" name="ResArea" placeholder="Area" value="<?php //echo $rest->getArea() ?>">  -->
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResDoorNumber">Door #</label>
			<div class="controls">
				<input type="text" id="ResDoorNumber" name="ResDoorNumber" placeholder="Door #" value="<?php echo $rest->getDoorno() ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResLandmark">Landmark</label>
			<div class="controls">
				<input type="text" id="ResLandmark" name="ResLandmark" placeholder="Landamrk" value="<?php echo $rest->getLandmark() ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResPincode">Pin code</label>
			<div class="controls">
				<input type="text" id="ResPincode" name="ResPincode" placeholder="Pin Code" value="<?php echo $rest->getPincode() ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResContact1">Contact #1</label>
			<div class="controls">
				<input type="text" id="ResContact1" name="ResContact1" placeholder="Contact #1" value="<?php echo $rest->getContact1() ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResContact2">Contact #2</label>
			<div class="controls">
				<input type="text" id="ResContact2" name="ResContact2" placeholder="Contact #2" value="<?php echo $rest->getContact2() ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResContact3">Contact #3</label>
			<div class="controls">
				<input type="text" id="ResContact3" name="ResContact3" placeholder="Contact #3" value="<?php echo $rest->getContact3() ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResFeatures">Features</label>
			<div class="controls">
				<label class="checkbox-inline"><input type="checkbox" name="ResFeatures[]" class="ResFeatures" value="AC"> Air Conditioner</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResFeatures[]" class="ResFeatures" value="BAR"> Bar</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResFeatures[]" class="ResFeatures" value="Smoking"> Smoking Zone</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResFeatures[]" class="ResFeatures" value="Wifi"> Wifi</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResServices">Services</label>
			<div class="controls">
				<label class="checkbox-inline"><input type="checkbox" name="ResServices[]" class="ResServices" value="DD"> Door Delivery</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResServices[]" class="ResServices" value="TB"> Table Booking</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResServices[]" class="ResServices" value="TA"> Take Away</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResServices[]" class="ResServices" value="BH"> Banquet Halls</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResServices[]" class="ResServices" value="PP"> Party Planing</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResServices[]" class="ResServices" value="CT"> Catering</label>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="ResClosedOn">Closed On</label>
			<div class="controls">
				<label class="checkbox-inline"><input type="checkbox" name="ResClosedOn[]" class="ResClosedOn" value="MON"> Monday</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResClosedOn[]" class="ResClosedOn" value="TUE"> Tuesday</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResClosedOn[]" class="ResClosedOn" value="WED"> Wednesday</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResClosedOn[]" class="ResClosedOn" value="THU"> Thursday</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResClosedOn[]" class="ResClosedOn" value="FRI"> Friday</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResClosedOn[]" class="ResClosedOn" value="SAT"> Saturday</label>
				<label class="checkbox-inline"><input type="checkbox" name="ResClosedOn[]" class="ResClosedOn" value="SUN"> Sunday</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResDeliver">Where we deliver</label>
			<div class="controls">
				<input type="text" id="ResDeliver" name="ResDeliver" placeholder="Where we deliver?" value="<?php echo $rest->getDeliverDistance() ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResEstDeliverTime">Estimated Delivery Time</label>
			<div class="controls">
				<input type="text" id="ResEstDeliverTime" name="ResEstDeliverTime" placeholder="Deliver Time"  value="<?php echo $rest->getDeliveryTime()?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResDeliverFrom">Working time</label>
			<div class="controls">
				<input type="text" id="ResDeliverFrom" name="ResDeliverFrom" placeholder="Opening Time" value="<?php echo $rest->getDeliveryFrom()?>">
				<input type="text" id="ResDeliverTo" name="ResDeliverTo" placeholder="Closing Time" value="<?php echo $rest->getDeliveryTo() ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResMinDeliverAmount">Minimum amount to Deliver</label>
			<div class="controls">
				<input type="text" id="ResMinDeliverAmount" name="ResMinDeliverAmount" placeholder="Amount" value="<?php echo $rest->getMinDeliveryAmount()?>">
			</div>
		</div>
        <div class="control-group">
			<label class="control-label" for="HHStart">Happy hours</label>
			<div class="controls">
				<input type="text" id="HHStart" name="HHStart" placeholder="Start Time" value="<?php echo $rest->getHHStart()?>">
				<input type="text" id="HHEnd" name="HHEnd" placeholder="End Time" value="<?php echo $rest->getHHEnd() ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResServiceTax">Service Tax</label>
			<div class="controls">
				<input type="text" id="ResServiceTax" name="ResServiceTax" placeholder="Service Tax" value="<?php echo $rest->getServiceTax()?>">
			</div>
		</div>
        <div class="control-group">
			<label class="control-label" for="ResVatTax">VAT Tax</label>
			<div class="controls">
				<input type="text" id="ResVatTax" name="ResVatTax" placeholder="Vat Tax" value="<?php echo $rest->getVatTax()?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResDeliveryCharges">Delivery Charges</label>
			<div class="controls">
				<input type="text" id="ResDeliveryCharges" name="ResDeliveryCharges" placeholder="Delivery Charges" value="<?php echo $rest->getDeliveryCharges()?>">
			</div>
		</div>
        <div class="control-group">
			<label class="control-label" for="paymentOptions">Payment options</label>
			<div class="controls">
				<label class="checkbox-inline"><input type="checkbox" name="paymentOptions[]" class="paymentOptions" value="Cash"> Cash</label>
				<label class="checkbox-inline"><input type="checkbox" name="paymentOptions[]" class="paymentOptions" value="Card"> Credit/Debit Card</label>
				<label class="checkbox-inline"><input type="checkbox" name="paymentOptions[]" class="paymentOptions" value="Sodexo"> Sodexo</label>
				<label class="checkbox-inline"><input type="checkbox" name="paymentOptions[]" class="paymentOptions" value="Online"> Pay Online</label>
			</div>
		</div>
        <div class="control-group">
			<label class="control-label" for="ResAboutUs">About us</label>
			<div class="controls">
				<input type="text" id="ResAboutUs" name="ResAboutUs" placeholder="Short Description" value="<?php echo $rest->getAboutUs()?>">
			</div>
		</div>
        <div class="control-group">
			<label class="control-label" for="ResLatitude">Latitude</label>
			<div class="controls">
				<input type="text" id="ResLatitude" name="ResLatitude" placeholder="Latitude" value="<?php echo $rest->getLatitude()?>">
			</div>
		</div>
        <div class="control-group">
			<label class="control-label" for="ResLongitude">Longitude</label>
			<div class="controls">
				<input type="text" id="ResLongitude" name="ResLongitude" placeholder="Short Description" value="<?php echo $rest->getLongitude()?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ResMenuRatesTax">Rates on the card</label>
			<div class="controls">
				<div class="radio">
					<label>
						<input type="radio" name="ResMenuRatesTax" id="ResMenuRatesTax1" value="Yes">
						Including Tax
					</label>
					<label>
						<input type="radio" name="ResMenuRatesTax" id="ResMenuRatesTax2" value="No">
						Excluding Tax
					</label>
				</div>
			</div>
		</div>
		<input type="hidden" name="action" value="save" />
		<div class="control-group">
			<div class="controls">
				<button type="submit" id="Restaurant_bt" class="btn">Save</button>
			</div>
		</div>
	</form>
	
	<?php } ?>
    <form class="form-horizontal dishFrm" id="dishFrm" name="dishFrm">
	<?php	
	/*if(isset($_REQUEST['_aXTL']) && $_REQUEST['_aXTL']=="cuisines")
		{	?>
	<form class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="CuisineAdd">Name</label>
			<div class="controls">
				<input type="text" id="CuisineAdd" placeholder="Enter cusines name">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn">Save</button>
			</div>
		</div>
		</form
		><?php
	}*/
	if(isset($_REQUEST['_aXTL']) && $_REQUEST['_aXTL']=="dishes")
	{
	require 'php/classes/Dishes.php';
	$dsh = new Dishes();
	$rest_name=$_REQUEST['name'];
	if($_REQUEST['_id'] != "new")
	{
		echo "from url existing dish ";
	//$rest_name=$_REQUEST['name'];
	//$rest->getRestaurant($_REQUEST['name']);
	$dsh->getDish($_REQUEST['_id'],$rest_name);
	//echo $rest->getId();
	}
	else
	{
		echo "from url new dish ";		
			$dsh->setNewDish();
	}		
			?>
    
		<div class="control-group">
			<label class="control-label" for="dishName">Name</label>
			<div class="controls">
				<input type="text" id="dishName" name="dishName" placeholder="Enter Dish name" value="<?php echo $dsh->getDishName()?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="cuisineName">Cuisine</label>
			<div class="controls">
				<select name="cuisineName" id="cuisineName" class="form-control">
                <?php 				
				$dsh->getCuisines($_REQUEST['name'], $_REQUEST['_id']);
				?>					
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="dishType">Veg/N.Veg</label>
			<div class="controls">
				<div class="radio">
              <?php if($dsh->getDishType() == "Veg")
						echo "<input type='radio' name='dishType' id='DishVeg' checked='checked' value='Veg'> <label for='DishVeg'>Veg</label>";
					else
						echo "<input type='radio' name='dishType' id='DishVeg' value='Veg'> <label for='DishVeg'>Veg</label>";
					if($dsh->getDishType() == "NonVeg")
						echo "<input type='radio' name='dishType' id='DishnVeg' checked='checked' value='NonVeg'> <label for='DishnVeg'>Non-Veg</label>";
					else
						echo "<input type='radio' name='dishType' id='DishnVeg' value='NonVeg'> <label for='DishnVeg'>Non-Veg</label>";	
					if($dsh->getDishType() == "Beverage")
						echo "<input type='radio' name='dishType' id='DishBev' checked='checked' value='Beverage'> <label for='DishBev'>Beverage</label>";
					else
						echo "<input type='radio' name='dishType' id='DishBev' value='Beverage'> <label for='DishBev'>Beverage</label>";	
						
				?>
					<!--<label><input type="radio" name="dishType" id="DishnVeg" value="NonVeg"> Non-Veg</label>-->
				</div>
			</div>
		</div>
        <?php      
		if($dsh->getNewDish())
		{
        echo "<input type='hidden' name='rest_stat' value='n' />";
		echo "<input type='hidden' name='rest_id' value='".$dsh->getRestIdByName($rest_name)."' />";
		}
		else
		{
		echo "<input type='hidden' name='rest_stat' value='".$dsh->getDishId()."' />";
		echo "<input type='hidden' name='rest_id' value='".$dsh->getRestaurantId()."' />";
		}
		
		
		
		?>
		<div class="control-group">
			<label class="control-label" for="dishPrice">Price</label>
			<div class="controls">
				<input type="text" name="dishPrice" id="dishPrice" placeholder="Enter Dish price INR" value="<?php echo $dsh->getDishPrice()?>">
			</div>
		</div>
        
        <div class="control-group">
			<label class="control-label" for="dishPrice">Category</label>
			<div class="controls">
				<input type="text" name="dishCategory" id="dishCategory" placeholder="Enter Dish category" value="<?php echo $dsh->getDishCategory()?>">
			</div>
		</div>
        
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn">Save</button>
			</div>
		</div>
	</form>
    <table class="table table-hover">
	<tr><th>S.No</th><th>Name of the Dish</th><th>Cuisine</th><th>Price</th></tr>
	<?php
	
	$name=$_REQUEST['name'];
	$stmt = $db->prepare("SELECT r.id as restaurant_id,c.name as cuisine,r.name as restaurant,d.name as name, d.veg as dishType, d.id as id,d.price as price from dishes d,restaurants r,cuisines c where d.restaurant_id=r.id and d.cuisine_id=c.id and r.name=?");
	$stmt->execute(array($name));
	while($row=$stmt->fetch())
	{
		$name=str_replace(' ','-',$row['restaurant']);
	echo "<tr><td>".$row['id']."</td><td><a href='operations.php?_aXTL=dishes&_id=".$row['id']."&name=".$name."'>".$row['name']."</a></td><td>".$row['cuisine']."</td><td>".$row['price']."</td></tr>";
	}
?>
</table>
	<?php
	
}
?>
</div>
</div>
</body>
</html>