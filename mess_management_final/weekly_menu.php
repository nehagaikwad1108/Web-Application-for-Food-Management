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
$y3=strtotime('22:30');
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
				<?php if($_SESSION['cat']=='MMC') echo '<a href="admin/committee.php">'.$name;
					else echo '<a href="member.php">'.$name;?></a>
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
                <?php if($_SESSION['cat']=='MMC') echo '<li> <a href="admin/expenses_entry.php">Expenses Entry</a></li>'?>
                <?php if($_SESSION['cat']=='MMC') echo '<li><a href="admin/monthly_expenditure.php">Monthly Expenditure</a></li>'?>
                
                <?php if($_SESSION['cat']=='MMC') echo '<li> <a href="admin/generate_bills.php">Generate Bills</a></li>'?>
                
                <li>
                    <a href="my_bills.php">My Bills</a>
                </li>




                <li>
                    <a href="weekly_menu.php">Weekly Menu</a>
                </li>
				<li>
                    <a href="comments.php">Comments</a>
                </li>
				<li>
					<a href="viewcomments.php">View My Comments</a>
				</li>
				<?php if($_SESSION['cat']=='MMC') echo '<li><a href="admin/allcomments.php">All Comments
						</a></li>'?>
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
					$a=array('MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY');
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
					for($i=0;$i<7;$i++)
					{
						$day=$a[$i];
						echo '<tr>
								<td>'.$day.'</td>';
						$query1="SELECT Name FROM menu,menu_items WHERE (menu.Menu_item_id=menu_items.Menu_item_id) AND (menu.Day='$day') AND (menu.Meal_type='BREAKFAST')";
						$run1=mysql_query($query1);
						$query2="SELECT Name FROM menu,menu_items WHERE (menu.Menu_item_id=menu_items.Menu_item_id) AND (menu.Day='$day') AND (menu.Meal_type='LUNCH')";
						$run2=mysql_query($query2);
						$query3="SELECT Name FROM menu,menu_items WHERE (menu.Menu_item_id=menu_items.Menu_item_id) AND (menu.Day='$day') AND (menu.Meal_type='DINNER')";
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
					}
					echo '</table>';
                    ?>
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