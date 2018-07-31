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
$y3=strtotime('23:59');
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>My Bills</title>
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
					elseif($_SESSION['cat']=='MM') echo '<a href="member.php">'.$name;?></a>
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

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>My Bills</h1>
                        <br><br>
                        <form action="report.php" method="POST">
                        Month: 	<select name="sel_month" value="NULL">
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>								   
                                </select>
                        <br><br>
                        <input type="submit" value="Go">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
         
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