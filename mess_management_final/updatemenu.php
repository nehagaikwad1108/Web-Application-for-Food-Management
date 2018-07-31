<?php

require 'core.inc.php';
require 'connect.inc.php';
$day=$_SESSION['day'];
if($_POST['breakfast'])
{   $query="DELETE FROM `menu` WHERE Day='Monday' and Meal_Type='BREAKFAST'";
	$run1=mysql_query($query);
		

	foreach($_POST['breakfast'] as $breakfastvar)
	{	
		$query1=" INSERT INTO `menu`(`Menu_item_id`, `Day`, `Meal_type`) VALUES ('$breakfastvar','MONDAY','BREAKFAST')";
		$run1=mysql_query($query1);
		

	}
	
		

	
	
}
if($_POST['lunch'])
{   $query="DELETE FROM `menu` WHERE Day='$day' and Meal_Type='LUNCH'";
	$run1=mysql_query($query);
		

	foreach($_POST['lunch'] as $lunchvar)
	{	
		$query1=" INSERT INTO `menu`(`Menu_item_id`, `Day`, `Meal_type`) VALUES ('$lunchvar','$day','LUNCH')";
		$run1=mysql_query($query1);
		

	}
	
}
if($_POST['dinner'])
{   $query="DELETE FROM `menu` WHERE Day='$day' and Meal_Type='DINNER'";
	$run1=mysql_query($query);
		

	foreach($_POST['dinner'] as $dinnervar)
	{	
		$query1=" INSERT INTO `menu`(`Menu_item_id`, `Day`, `Meal_type`) VALUES ('$dinnervar','$day','DINNER')";
		$run1=mysql_query($query1);
		

	}
	
}
header('Location: update.php');

?>