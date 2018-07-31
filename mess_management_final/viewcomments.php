<?php
require 'core.inc.php';
require 'connect.inc.php';
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

    <title>My Comments</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

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
                    <a href="logout.php" > Logout</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
		<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
					<h1>My Comments</h1>
                        <p>
                        <?php
$sql = "select * from comments where RegistrationID = '$id'";
			$count = 1;		 

			$result = mysql_query($sql);
			if (mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
					$date = $row["Date"];
					$time = $row["Time"];
					$comments = $row["Comment"];
					$status = $row["Status"];
					echo "<br/>Comment Number :" . $count++."<br/>";
					echo "Date :".$date . "<br/>";
					echo "Time :".$time . "<br/>";
					echo "Comment :".$comments."<br/>";
					echo "Status :".$status."<br/>";
				}
			} 
			else 
			{
				echo 'No comments';
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
