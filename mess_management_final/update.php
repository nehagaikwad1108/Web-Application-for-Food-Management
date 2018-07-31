<?php

require 'core.inc.php';
require 'connect.inc.php';

$id=$_SESSION['id'];
$name=$_SESSION['name'];
date_default_timezone_set('Asia/Kolkata');
$day=date("d");
$month=date("m");
$year=date("Y");
$cur_time=strtotime('now');
$x1=strtotime('00:00');
$y1=strtotime('10:00');
$x2=strtotime('13:00');
$y2=strtotime('18:30');
$x3=strtotime('20:00');
$y3=strtotime('22:00');
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Weekly Menu</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<style>
table {
  font-family: "Helvetica Neue", Helvetica, sans-serif
}

caption {
  text-align: left;
  color: silver;
  font-weight: bold;
  text-transform: uppercase;
  padding: 5px;
}

thead {
  background: SteelBlue;
  color: white;
}

th,
td {
  padding: 5px 10px;
}

tbody tr:nth-child(even) {
  background: WhiteSmoke;
}

tbody tr td:nth-child(2) {
  text-align:center;
}

tbody tr td:nth-child(3),
tbody tr td:nth-child(4) {
  text-align: right;
  font-family: monospace;
}
</style>
<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
					<a href="member.php"> <?php echo $name;?>   </a>
                </li>
                <li>
                    <a href="current_meal.php">Register for Current Meal</a>
                </li>
                <li>
                    <a href="guest.php">Accompanied by a Guest?</a>
                </li>
                <li>
                    <a href="meal_statistics.php">Meal Statistics</a>
                </li>
                <li>
                    <a href="guest_statistics.php">Guest Statistics</a>
                </li>
				<?php if($_SESSION['cat']=='MMC') echo '<li><a href="admin/general_meal_statistics.php">General Meal Statistics
						</a></li>'?>
                <li>
                    <a href="weekly_menu.php">Weekly Menu</a>
                </li>
                <li>
                    <a href="logout.php" > Logout </a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
         <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
					<?php
$_SESSION['day']=$day="MONDAY";

	$conn = mysqli_connect("localhost", "root", "", "mess_management");
	// Check connection
	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	echo '<table>
							<caption>Weekly Menu</caption>
							<thead>
								<tr>
									<th>Day</th>
									<th>Breakfast</th> 
									<th>Lunch</th>
									<th>Dinner</th>
								</tr>
							</thead>';
echo '<tr>
								<td>'.$day.'</td>';
						$query1="SELECT Name FROM menu,menu_items WHERE (menu.Menu_item_id=menu_items.Menu_item_id) AND (menu.Day='Monday') AND (menu.Meal_type='BREAKFAST')";
						$run1=mysql_query($query1);
						$query2="SELECT Name FROM menu,menu_items WHERE (menu.Menu_item_id=menu_items.Menu_item_id) AND (menu.Day='Monday') AND (menu.Meal_type='LUNCH')";
						$run2=mysql_query($query2);
						$query3="SELECT Name FROM menu,menu_items WHERE (menu.Menu_item_id=menu_items.Menu_item_id) AND (menu.Day='Monday') AND (menu.Meal_type='DINNER')";
						$run3=mysql_query($query3);
						echo '<td>';
						while($row=mysql_fetch_assoc($run1))
						{
							$str=$row['Name'];
							echo $str.'<br>';
						}	
						echo '</td><td>';
						while($row=mysql_fetch_assoc($run2))
						{
							$str=$row['Name'];
							echo $str.'<br>';
						}	
						echo '</td><td>';
						while($row=mysql_fetch_assoc($run3))
						{
							$str=$row['Name'];
							echo $str.'<br>';
						}
						echo '</td></tr>';
?>							
						<form method='post' action ='updatemenu.php'>
<table cellspacing='8' cellpadding='8' border='1' style='border-collapse:collapse;border:3px;solid #000000; width:800px; margin-left:auto;margin-right:auto;margin-top:100px;margin-bottom:auto;'>
			<tr>
				<th>
					Select Breakfast items
				</th>
				<td >  
					<input type='checkbox' name='breakfast[]' value='MIT001'>Poha<br>
					<input type='checkbox' name='breakfast[]' value='MIT002'> Donut<br>
					<input type='checkbox' name='breakfast[]' value='MIT004'>usal<br>
					<input type='checkbox' name='breakfast[]' value='MIT012'>idli<br>
					<input type='checkbox' name='breakfast[]' value='MIT013'>Coconut Chutney<br>
					<input type='checkbox' name='breakfast[]' value='MIT021'>Medu Vada<br>
					<input type='checkbox' name='breakfast[]' value='MIT022'>Sambar<br>
					<input type='checkbox' name='breakfast[]' value='MIT020'>Peanut Cutney<br>
					
		
		</td>
				</tr>
				<tr>
					<th>
					Lunch
					</th>
				<td >   
					<input type='checkbox' name='lunch[]' value='MIT003'>methi<br>
					<input type='checkbox' name='lunch[]' value='MIT005'>Dal<br>
					<input type='checkbox' name='lunch[]' value='MIT006'>Rice<br>
					<input type='checkbox' name='lunch[]' value='MIT007'>Papad<br>
					<input type='checkbox' name='lunch[]' value='MIT008'>Veg Kolhapuri<br>
					<input type='checkbox' name='lunch[]' value='MIT030'>Dal Fry<br>
					<input type='checkbox' name='lunch[]' value='MIT029'>Jeera Rice<br>
					<input type='checkbox' name='lunch[]' value='MIT028'>Egg Curry<br>
					<input type='checkbox' name='lunch[]' value='MIT027'>Dahi Bundi<br>
					<input type='checkbox' name='lunch[]' value='MIT026'> Veg Pulav<br>
					<input type='checkbox' name='lunch[]' value='MIT025'>Chana Masala<br>
					<input type='checkbox' name='lunch[]' value='MIT024'>Dry Vegetable <br>
					<input type='checkbox' name='lunch[]' value='MIT023'>Bhindi Masala<br>
				</td>	
				</tr>
				<tr>
					<th>
					Dinner
					</th>
				<td >   
					<input type='checkbox' name='dinner[]' value='MIT003'>methi<br>
					<input type='checkbox' name='dinner[]' value='MIT005'>Dal<br>
					<input type='checkbox' name='dinner[]' value='MIT006'>Rice<br>
					<input type='checkbox' name='dinner[]' value='MIT007'>Papad<br>
					<input type='checkbox' name='dinner[]' value='MIT008'>Veg Kolhapuri<br>
					<input type='checkbox' name='dinner[]' value='MIT030'>Dal Fry<br>
					<input type='checkbox' name='dinner[]' value='MIT029'>Jeera Rice<br>
					<input type='checkbox' name='dinner[]' value='MIT028'>Egg Curry<br>
					<input type='checkbox' name='dinner[]' value='MIT027'>Dahi Bundi<br>
					<input type='checkbox' name='dinner[]' value='MIT026'> Veg Pulav<br>
					<input type='checkbox' name='dinner[]' value='MIT025'>Chana Masala<br>
					<input type='checkbox' name='dinner[]' value='MIT024'>Dry Vegetable <br>
					<input type='checkbox' name='dinner[]' value='MIT023'>Bhindi Masala<br>
				</td>	
				</tr>
				
				
				<tr><td colspan='2' align='center'>
				<input type='submit' name='submit' value='Update Menu' align='center' /> </td> </tr>
				</table>
                    
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>
</html>
				