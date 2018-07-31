<?php

	
	require 'connect.inc.php';
	require 'core.inc.php';
	if(isset($_SESSION['id']))
	{

		
		if($_SESSION['cat']=='MM')
			{
			
				header('Location: member.php');
			}
		
		else if($_SESSION['cat']=='MMC')
	{
		header('Location: admin/committee.php');
	}



		else
			{echo 'HI Staff';
			echo '<a href="logout.php"> LOGOUT </a>';
			}
	}
	else
	{

		include 'login_form.php';


	}






?>