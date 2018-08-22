<?php
date_default_timezone_set('Asia/Calcutta');
echo date_default_timezone_get()."<br/>";
$sunrise = "12:30:00";
$sunset = "23:00:00";

$date1 = strtotime(date('H:i:s'));
$date2 = strtotime($sunrise);
$date3 = strtotime($sunset);
if ($date1 >= $date2 && $date1 <= $date3)
   echo 'Yes, it is opened';
else
	echo 'Closed now';

echo "<br/>".date('H:i:s');
?>