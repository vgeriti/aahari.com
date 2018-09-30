<?php
if(isset($_POST['order_id']) && isset($_POST['ch_status']))
{

  require_once 'php/classes/DBConnect.php';
  $d= new DBConnect();
  $db=$d->getDBConnection();
  $stmt = $db->prepare("UPDATE orders set order_status = :order_status where id = :id");
  $stmt->execute(array(':order_status'=>$_POST['ch_status'],':id'=>$_POST['order_id'])) or die($stmt->errorInfo());
  //echo $_POST['order_id']."/".$_POST['ch_status'];
  header('"Location:man_orders.php?order="'.$_POST['order_id']);


}
else?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link href="css/core.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="topbarCore"></div>
<div class="wraper clearfix">
	<div class="side_bar">
		<ul class="nav nav-list">
			<li class="active"><a href="manage.php?tt=restaurants">List of Restaurants</a></li>
			<li class=""><a href="manage.php?tt=orders">Orders</a></li>
  	</ul>
	</div>
  <div class="main_body container">



<?php if(isset($_REQUEST['order']) && $_REQUEST['order'] != "")	
{ 

require_once 'php/classes/DBConnect.php';
$d= new DBConnect();
$db=$d->getDBConnection();
$stmt = $db->prepare("SELECT o.id as id,r.name as rest_name,a.name as area, order_status, dtime,o.items as items,o.email as email, o.mobile as pri_mobile,o.alternate_mobile as alt_mobile, payment_method,special_request  from orders o, restaurants r, areas a where o.restaurant_id = r.id and o.area = a.id and o.id = ?");
$stmt->execute(array($_REQUEST['order']));
echo "<form action='' method='post'>";
while($row=$stmt->fetch())
{
echo "<h1>Order# ".$row['id']."</h1>";
echo "<input type='hidden' value=".$row['id']." name='order_id'/>";
echo "Restaurant Name: <b>".$row['rest_name']."</b><br/>";
echo "Area: <b>".$row['area']."</b><br/>";
echo "Ordered at: <b>".date('d-m-Y h:i A', strtotime($row['dtime']))."</b><br/>";
echo "Email: <b>".$row['email']."</b><br/>";
echo "Mobile Number: <b>".$row['pri_mobile']."</b><br/>";
echo "Secondary Number: <b>".$row['alt_mobile']."</b><br/>";
echo "Payment Method: <b>".$row['payment_method']."</b><br/>";
echo "Special Request: <b>".$row['special_request']."</b><br/>";
echo "Order Status: <b>".$row['order_status']."</b><br/>";

echo "Change Status <b><select name=\"ch_status\">";
echo  "<option value=''>Update Status</option>";
if($row['order_status'] == "OPEN" || $row['order_status'] == "PENDING")
echo  "<option value=\"COOKING\">COOKING</option>";
else if($row['order_status'] == "COOKING" || $row['order_status'] == "PENDING")
echo  "<option value=\"COMPLETED\">COMPLETED</option>";
else if($row['order_status'] == "PENDING")
  echo  "<option value=\"OPEN\">OPEN</option>";
if($row['order_status'] != "PENDING")
echo "<option value=\"PENDING\">PENDING</option>";

echo "</select></b><br/>";
echo "<input type='submit' name ='change_status'/>";
}
?>
</form>
<?php } ?>
  </div>
</div>
</body>
</html>
