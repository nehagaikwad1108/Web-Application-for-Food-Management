<?php
require '../core.inc.php';
require '../connect.inc.php';

$id=$_SESSION['id'];
$name=$_SESSION['name'];

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

$status="";
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>All Comments</title>
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
	<style>
	table {
	  font-family: "Helvetica Neue", Helvetica, sans-serif;
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
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
					<a href="committee.php"><?php echo $name; ?></a>
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
                    <a href="../logout.php" > Logout</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
		<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>All Comments</h1><br><br>
                        <p>
						<?php 
						if(isset($_SESSION['id']))
						{
							if(isset($_POST["submit"]))
							{
								$status = ($_POST['status']);
								$order = $_POST["order"];
								
								date_default_timezone_set("Asia/Kolkata");
								$time = date("h:i:sa");
								$date = date("Y-m-d");
							
								$sql = "SELECT * FROM comments WHERE Status='$status' ORDER BY $order ASC;";	 
								$result = mysql_query($sql);
								if (mysql_num_rows($result) > 0)
								{
									echo '<table>
											<thead>
												<tr>
													<th>ID</th>
													<th>Comment</th>
													
													<th>Date</th>
													<th>Time</th>';
													if($status=="Pending")
														echo'<th>Change Status</th>';
											echo	'</tr>
											</thead>
											<tbody>';
									while($row = mysql_fetch_assoc($result))
									{
										$id = $row["RegistrationID"];
										$comments = $row["Comment"];
										$commentid = $row["CommentID"];
										$date = $row["Date"];
										$time = $row["Time"];
										echo '<tr>
												<td>'.$id.'</td>
												<td>'.$comments.'</td>
												
												<td>'.$date.'</td>
												<td>'.$time.'</td>';
										if($status=="Pending")
											{
												echo'<td><form action="resolvecomments.php" method="post"> <input type="hidden" name="commentid" value="'.$commentid.'" />
												<input type="submit" value="Resolve Comment"></form></td>
													</tr>';
											}		
									}
									echo '</tbody></table>';
								} 
								else 
								{
									echo 'No comments';
								}
							}
							else
							{
								$id = $_SESSION['id'];	
								date_default_timezone_set("Asia/Kolkata");
								$time = date("h:i:sa");
								$date = date("Y-m-d");
								echo'<form method="post" action ="allcomments.php">
								<b>Select Status: </b>
								<select name="status">
									<option value="Pending">Pending</option>
									<option value="Resolved">Resolved</option>
								</select><br/><br/>
								<b>Sort by: </b>
								<select name="order">
									<option value="Date">Date</option>
									<option value="RegistrationID">RegistrationID</option>
								</select><br/><br/>
								<input type="submit" name="submit" value="Submit" align="align" />
								</form>';
							}
						}
						?>
						</p>
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