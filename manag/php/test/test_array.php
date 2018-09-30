<?php

$ary= array('hi'=>'jagan','hello'=>'vijji');
echo "<br/>".json_encode($ary)."<br/>";
echo strpos(json_encode($ary),"\"");


?>