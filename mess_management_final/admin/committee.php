<?php
require '../core.inc.php';
require '../connect.inc.php';

if(!isset($_SESSION['name']))
{	
	$id=$_SESSION['id'];
	$query="SELECT Name FROM personal_details WHERE Id='$id' ";
	if($query_run=mysql_query($query))
	{
		$ans=mysql_fetch_assoc($query_run);
		$name=$ans['Name'];
		$_SESSION['name']=$name;
	}
}
else
{
	$id=$_SESSION['id'];
	$name=$_SESSION['name'];
}
date_default_timezone_set('Asia/Kolkata');
$day=date("d");
$month=date("m");
$year=date("Y");
$cur_time=strtotime('now');
$x1=strtotime('08:00');
$y1=strtotime('11:00');
$x2=strtotime('12:00');
$y2=strtotime('14:30');
$x3=strtotime('20:00');
$y3=strtotime('23:59');
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="committee.php"> <?php echo $name;?>   </a>
                </li>
                <li>
                    <a href="../current_meal.php">Register for Current Meal</a>
                </li>
                <li>
                    <a href="../guest.php">Accompanied by a Guest?</a>
                </li>
                <li>
                    <a href="../meal_statistics.php">Meal Statistics</a>
                </li>
                <li>
                    <a href="../guest_statistics.php">Guest Statistics</a>
                </li>
				<li>
					<a href="general_meal_statistics.php">General Meal Statistics</a>
				</li>
                <li>
                    <a href="expenses_entry.php">Expenses Entry</a>
                </li>
                <li>
                    <a href="monthly_expenditure.php">Monthly Expenditure</a>
                </li>
                <li>
                    <a href="generate_bills.php">Generate Bills</a>
                </li>
                 <li>
                    <a href="../my_bills.php">My Bills</a>
                </li>
                <li>
					<a href="inventory_order.php">Inventory Order</a>
				</li>
                <li>
                    <a href="../weekly_menu.php">Weekly Menu</a>
                </li>
				<li>
                    <a href="../comments.php">Comments</a>
                </li>
				<li>
					<a href="../viewcomments.php">View My Comments</a>
				</li>
				<li>
					<a href="allcomments.php">All Comments</a>
				</li>
                <li>
                    <a href="../logout.php" > Logout </a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Welcome!</h1>
                        <br><br>
                        <p>
                        <?php
                            $query="SELECT Email, Mobile FROM personal_details WHERE Id=$id";
                            if($run=mysql_query($query))
                            {
                                $row=mysql_fetch_assoc($run);
                                $e=$row['Email'];
								$m = $row["Mobile"];
								$query="SELECT Type, Salary FROM mess_monitoring_committee WHERE Committee_id='$id'";
								if($run=mysql_query($query))
								{
									$row=mysql_fetch_assoc($run);
									$type=$row["Type"];
									$sal=$row["Salary"];
									echo '<table cellspacing="5" cellpadding="5">
											<tr>
												<th>ID:</th>
												<td>'.$id.'</td>
											</tr>
											<tr>
												<th>Name:</th>
												<td>'.$name.'</td>
											</tr>
											<tr>
												<th>E-Mail:</th>
												<td>'.$e.'</td>
											</tr>
											<tr>
												<th>Mobile:</th>
												<td>'.$m.'</td>
											</tr>
											<tr>
												<th>Type:</th>
												<td>MESS '.$type.'</td>
											</tr>
											
										</table>';
								}
                            }
                        ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
		<br><br>
		<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Current Meal</h1>
                        <br><br>
                        <?php 
                        if(($cur_time>=$x1&&$cur_time<=$y1)||($cur_time>=$x2&&$cur_time<=$y2)||($cur_time>=$x3&&$cur_time<=$y3))
                        {
                            if($cur_time>=$x1&&$cur_time<=$y1)
								$meal_type='BREAKFAST';
							else if($cur_time>=$x2&&$cur_time<=$y2)
								$meal_type='LUNCH';
							else
								$meal_type='DINNER';
								$date=$year.'-'.$month.'-'.$day;
								$day1= strtoupper(jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("m"),date("d"), date("Y")) , 1 )); 
								$query="SELECT Name FROM menu,menu_items WHERE (menu.Menu_item_id=menu_items.Menu_item_id) AND (menu.Day='$day1') AND (menu.Meal_type='$meal_type')";
								echo '<table>
										<caption>'.$day1.'</caption>
										<thead>
                                            <tr>
												<th>'.$meal_type.'</th>
                                            </tr>
										</thead>
                                            <tr>
												<td>';
								if($query_run=mysql_query($query))
								{
									while($row=mysql_fetch_assoc($query_run))
									{
										$str=$row['Name'];
										echo $str.'<br>';
									}
								}
								echo '			</td>
                                            </tr>
                                    </table>';

                        }
                        else
                        {
                            echo '<b>There is no meal available at the moment.</b>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>
</html>