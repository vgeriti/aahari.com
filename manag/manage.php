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
		<div class="main_body">
<?php if(isset($_REQUEST['tt']) && $_REQUEST['tt'] == "restaurants")	
{ ?>
<table class="table table-hover">
<tr><th>S.No</th><th>Name of the restaurant</th><th>Area</th></tr>
<?php
include 'php/classes/DBConnect.php';
$d= new DBConnect();
$db=$d->getDBConnection();
$stmt = $db->prepare("SELECT r.name as restaurant,a.name as area,r.id as sno, r.rest_url as url from restaurants r, areas a where r.area_id=a.id");
$stmt->execute();
//filter_var($name,FILTER_SANITIZE_ENCODED)
while($row=$stmt->fetch())
{
//	$name=str_replace(' ','-',$row['restaurant']);
echo "<tr><td>".$row['sno']."</td><td><a href='operations.php?_aXTL=restaurant&name=".$row['url']."'>".$row['restaurant']."</a></td><td>".$row['area']."</td></tr>";
}
?>
</table>
<?php } ?>
<?php if(isset($_REQUEST['tt']) && $_REQUEST['tt'] == "orders")	
{ ?>
<h3>Orders</h3>
<table class="table table-hover">
<tr><th>S.No</th><th>Order.No</th><th>Name of the restaurant</th><th>Area</th><th>Status</th><th>Ordered at</th></tr>
<?php
include 'php/classes/DBConnect.php';
$d= new DBConnect();
$db=$d->getDBConnection();
$stt = $db->prepare("SELECT o.id as id,r.name as name,a.name as area, order_status, dtime from orders o, restaurants r, areas a where o.restaurant_id = r.id and o.area = a.id");
$stt->execute();
//filter_var($name,FILTER_SANITIZE_ENCODED)
$i = 0;
while($rw=$stt->fetch())
{
	$i++;
//	$name=str_replace(' ','-',$row['restaurant']);
echo "<tr><td>".$i."</td><td><a href='man_orders.php?order=".$rw['id']."'>".$rw['id']."</a></td><td>".$rw['name']."</td><td>".$rw['area']."</td><td>".$rw['order_status']."</td><td>".date('d-m-Y h:i A', strtotime($rw['dtime']))."</td></tr>";
//echo "<tr><td>".$row['sno']."</td><td><a href='operations.php?_aXTL=restaurant&name=".$row['url']."'>".$row['restaurant']."</a></td><td>".$row['area']."</td></tr>";
}
?>
</table>
<?php } ?>
</div>
</div>
</body>
</html>