<?php
include 'header.html';

echo $_GET['tt'];

if($_GET['tt']=="page1")
{
include 'page1.html';
}
else if($_GET['tt']=="page2")
{
include '123456.php';
}
else
{
include 'body.html';
}

include 'footer.html';
?>