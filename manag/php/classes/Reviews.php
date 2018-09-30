<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once 'DBConnect.php';
class Reviews{
	private $restaurant_id;
	private $rating;
	private $title;
	private $review;
	private $dtime;
	private $user_id;
	private $review_id;

	function setRestaurantId($rest_id){
		$this->restaurant_id = $rest_id;
	}
	function getRestaurantId()
	{
		return $this->restaurant_id;
	}
	function setReviewId($review_id){
		$this->review_id = $review_id;
	}
	function getReviewId(){
		return $this->review_id;
	}
	function setRating($rating){
		$this->rating = $rating;
	}
	function getRating(){
		return $this->rating;
	}
	function setTitle($title){
		$this->title= $title;	
	}
	function getTitle(){
		return $this->title;
	}
	function setReview($review){
		$this->review = $review;
	}
	function getReview(){
		return $this->review;
	}
	function setDTime($dtime){
		$this->dtime = $dtime;
	}
	function getDTime(){
		return $this->dtime;
	}
	function setUserId($userid){
		$this->user_id = $userid;
	}
	function getUserId(){
		return $this->user_id;
	}

	function saveReview($reviewData){
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("INSERT into reviews(restaurant_id, title, review, rating, dtime, user_id, useragent) VALUES (:restaurant_id, :title, :review, :rating, :dtime, :user_id, :useragent)");
		$st->execute($reviewData) or die(print_r($st->errorInfo(),true));
	}

	function getRestReviews($rest_id){
		//echo "in get rest reviews";
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT id, title, review, rating, dtime, user_id, u.name from reviews r, users u where restaurant_id = ? and u.userid = r.user_id");
		$st->execute(array($rest_id)) or die(print_r($st->errorInfo(),true));
		$revw = array();
		$rev_data = '';
		while ( $rp = $st->fetch()) {
			$rev = array();
			$rev['id'] = $rp['id'];
			$rev['title'] = $rp['title'];
			$rev['review'] = $rp['review'];
			$rev['rating'] = $rp['rating'];
			$rev['dtime'] = $rp['dtime'];
			$rev['user_id'] = $rp['user_id'];
			$rev['name'] = $rp['name'];
			$revw[$rp['id']] = $rev;
			$rev_data = $rev_data."<div class='comment'><div class='username'>".$rp['name']."<br /><font size='-1'>".$rp['dtime']."</font></div>
            <div class='point'>".$rp['rating']."</div>
            <div class='clear_10'></div>
            <div class='post'><p>".$rp['review']."</p></div>            
        	</div><hr/>";

		}
		return $rev_data;
	}


		

/***
<div class='comment'>
            <div class='username'>".$rp['name']."<br />
            <font size='-1'>".$rp['dtime']."</font>
            </div>
            <div class='point'>".$rp['rating']."</div>
            <div class='clear_10'></div>
            <div class='post'>
                <p>".$rp['review']."</p>
            </div>            
        </div>
<!--  <div class='rated'>
            rated as
            <b>Great !</b>
            </div>-->
*/
/****************Raw Rest Reviews***************

function getRestReviews($rest_id){
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT id, title, review, rating, dtime, user_id, u.name from reviews r, users u where restaurant_id = ? and u.userid = r.user_id");
		$st->execute(array($rest_id)) or die(print_r($st->errorInfo(),true));
		$revw = array();
		while ( $rp = $st->fetch()) {
			$rev = array();
			$rev['id'] = $rp['id'];
			$rev['title'] = $rp['title'];
			$rev['review'] = $rp['review'];
			$rev['rating'] = $rp['rating'];
			$rev['dtime'] = $rp['dtime'];
			$rev['user_id'] = $rp['user_id'];
			$rev['name'] = $rp['name'];
			$revw[$rp['id']] = $rev;
		}
		return json_encode($revw);
	}

*/

	//function getRe

	function updateReview($reviewData){
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("UPDATE reviews set title = :title, review = :review, rating = :rating, dtime = :dtime, useragent = :useragent where id = :id");
		$st->execute($reviewData) or die(print_r($st->errorInfo(),true));
	}

	function deleteReview($rev_id)
	{
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("DELETE from reviews where id = ?");
		$st->execute($rev_id) or die(print_r($st->errorInfo(),true));
	}


}
?>