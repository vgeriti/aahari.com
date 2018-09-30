<?php
require_once 'DBConnect.php';
class Dishes
{

private $dishId;
private $cuisineId;
private $dishName;
private $dishType;
private $dishCuisine;
private $dishPrice;
private $dishCategory;
private $restaurantId;
private $newDish;

function setNewDish()
{
	$this->newDish = true;
}
function getNewDish()
{
	return $this->newDish;
}
function setDishId($dish_id)
{
	$this->dishId = $dish_id;
}
function getDishId()
{
	return $this->dishId;
}
function setCuisineId($cuisine_id)
{
	$this->cuisineId = $cuisine_id;
}
function getCuisineId()
{
	return $this->cuisineId;
}
function setDishName($dish_name)
{
	$this->dishName = $dish_name;
}
function getDishName()
{
	return $this->dishName;
}
function setDishType($dish_type)
{
	$this->dishType = $dish_type;
}
function getDishType()
{
	return $this->dishType;
}
function setDishCuisine($dish_cuisine)
{
	$this->dishCuisine = $dish_cuisine;
}
function getDishCuisine()
{
	return $this->dishCuisine;
}
function setDishPrice($dish_price)
{
	$this->dishPrice = $dish_price;
}
function getDishPrice()
{
	return $this->dishPrice;
}
function setDishCategory($dish_cat)
{
	$this->dishCategory = $dish_cat;
}
function getDishCategory()
{
	return $this->dishCategory;
}
function setRestaurantId($rest_id)
{
	$this->restaurantId = $rest_id;
}
function getRestaurantId()
{
	return $this->restaurantId;
}

function getDish($id,$name)
{
	try{
		$db = new DBConnect();
		$con = $db->getDBConnection();
//		$name=str_replace('-',' ',$name);
		$stmt = $con->prepare("SELECT r.id as restaurant_id, d.cuisine_id as cuisine_id,d.name as name, d.veg as veg, d.id as id,d.price as price, d.category as category from dishes d,restaurants r where d.restaurant_id=r.id and d.id =? and r.rest_url=?");
		$stmt->execute(array($id,$name));
		$row=$stmt->fetch();
		echo $stmt->rowCount();
		if($stmt->rowCount() == 1)
		{
			$this->restaurantId = $row['restaurant_id'];
			$this->cuisineId = $row['cuisine_id'];
			$this->dishName = $row['name'];
			$this->dishPrice = $row['price'];
			$this->dishType = $row['veg'];
			$this->dishId = $row['id'];
			$this->dishCategory = $row['category'];
		}
	}
	catch(Exception $e)
	{
		$e->getMessage();
	}
				
}

function getDishById($id){
	
	$db = new DBConnect();
	$con = $db->getDBConnection();
	
	$st = $con->prepare("SELECT * from dishes where id=?") or die(print_r($st->errorInfo()));
	$st->execute(array($id));
	
	if($st->rowCount() > 0)
	{
		$rw = $st->fetch();
		$ary['dish_id'] = $rw['id'];
		$ary['dish_name'] = $rw['name'];
		$ary['dish_price'] = $rw['price'];
		$ary['restaurant'] = $rw['restaurant_id'];
		$ary['category'] = $rw['category'];
		return $ary;
	}
	else
	return -1;
	
}

function getRestIdByName($name)
{
	$db = new DBConnect();
	$con = $db->getDBConnection();
	$name=str_replace('-',' ',$name);
	$st=$con->prepare("SELECT id from restaurants where name=?");
	$st->execute(array($name));
	
	//echo "$".$name."$".var_dump($rp);
	if($st->rowCount() == 1)
	{
		$rp=$st->fetch();
	return $rp['id'];
	}
	else
	return false;
}

function getRestIdByURL($url)
{
	$db = new DBConnect();
	$con = $db->getDBConnection();	
	$st=$con->prepare("SELECT id from restaurants where rest_url=?");
	$st->execute(array($url));
	
	//echo "$".$name."$".var_dump($rp);
	if($st->rowCount() == 1)
	{
		$rp=$st->fetch();
	return $rp['id'];
	}
	else
	return false;
}
function getAllDishes($name)
{
try{
		$db = new DBConnect();
		$con = $db->getDBConnection();
		$name=str_replace('-',' ',$name);
		$stmt = $con->prepare("SELECT r.id as restaurant_id, dishes d,d.name as name, d.veg as veg, d.id as id,d.price as price, d.category as category from dishes d,restaurants r where d.restaurant_id=r.id and r.name=?");
		$stmt->execute(array($name));
		while($row=$stmt->fetch())
		{
			
		}
		
		$row=$stmt->fetch();
		echo $stmt->rowCount();
		if($stmt->rowCount() == 1)
		"only 1";
	
}
catch(Exception $e)
{
	$e->getMessage();
}
}
function getCuisines($name,$id)
	{
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$name=str_replace('-',' ',$name);
		$st = $con->prepare("SELECT c.id from cuisines c, dishes d where d.cuisine_id=c.id and d.id=?");
		$st->execute(array($id));
		$tc=$st->rowCount();
		$rw=$st->fetch();
		echo "<script>console.log(".$tc.")</script>";
		
		$stmt = $con->prepare("SELECT DISTINCT c.id, c.name from cuisines c");
		$stmt->execute();
		$t=$stmt->rowCount();
		echo "<script>console.log(".$t.")</script>";
		//echo $stmt->rowCount();
		while($row=$stmt->fetch())
		{
			
			if($rw['id'] == $row['id'])
			{
				echo "<script>console.log('".$rw['id']."+" .$row['id']."');</script>";			
				echo "<option value='".$row['id']."' selected >".$row['name']."</option>";
			}
			else
			{
				echo "<script>console.log('".$rw['id']."+" .$row['id']."');</script>";			
				echo "<option value='".$row['id']."'>".$row['name']."</option>";
				
			}
		}
	}
function getDishCat($id,$rest_id)
	{
		$db = new DBConnect;
		$con = $db->getDBConnection();
		//$name=str_replace('-',' ',$name);
		$st = $con->prepare("SELECT cat.id from dish_category cat, dishes d, restaurants r where d.category=cat.id and d.id=? and r.id=?");
		$st->execute(array($id,$rest_id));
		$tc=$st->rowCount();
		$rw=$st->fetch();
//		echo "<script>console.log(".$tc.")</script>";
		
		$stmt = $con->prepare("SELECT DISTINCT cat.id, cat.name from dish_category cat where restaurant_id=?");
		$stmt->execute(array($rest_id));
		$t=$stmt->rowCount();
		echo "<script>console.log('$".$rest_id."$+".$t."')</script>";
		//echo $stmt->rowCount();
		while($row=$stmt->fetch())
		{
			
			if($rw['id'] == $row['id'])
			{
//				echo "<script>console.log('".$rw['id']."+" .$row['id']."');</script>";			
				echo "<option value='".$row['id']."' selected >".$row['name']."</option>";
			}
			else
			{
//				echo "<script>console.log('".$rw['id']."+" .$row['id']."');</script>";			
				echo "<option value='".$row['id']."'>".$row['name']."</option>";
				
			}
		}
	}	

function getCuisinesByRestaurant($id)
	{
		$db = new DBConnect;
		$con = $db->getDBConnection();
		//SELECT DISTINCT c.id,c.name as name from cuisines c, dishes d where c.id=d.cuisine_id and d.restaurant_id=? order by name DESC
		$st = $con->prepare("SELECT DISTINCT c.id,c.name as name from cuisines c, dishes d where c.id=d.cuisine_id and d.restaurant_id=? order by name ASC");
		$st->execute(array($id)) or die(print_r($st->errorInfo()));
		$tc=$st->rowCount();
		$i=0;
		while($rw=$st->fetch()){
			$i++;
			echo $rw['name'];
			if($i<$tc)
			echo ", ";
		}
	}	

function saveDish($data,$rest_status)
{
	$db = new DBConnect();
	$con= $db->getDBConnection();
	echo "#outside if#";
	if($rest_status =='n' && !isset($data[':id']))
		{
			echo "inserting new one";
			$stmt = $con->prepare("INSERT into dishes(name, veg, cuisine_id, price, category, restaurant_id,updated) VALUES (:name, :veg, :cuisine_id, :price, :category, :restaurant_id, :updated)");
			array_pop($data);	
		}
		
		else if($rest_status!='n' && isset($data[':id']) && !empty($data[':id']))
		{
			echo "updating old value/";
			$stmt = $con->prepare("UPDATE dishes set name=:name, veg=:veg, cuisine_id=:cuisine_id, price=:price, category=:category, restaurant_id=:restaurant_id, updated=:updated where id=:id");
			//$stmt->execute(array($this->name));
		}
		$stmt->execute($data) or die(print_r($stmt->errorInfo(),true));
}
}
?>