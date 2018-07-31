<?php
require 'core.inc.php';
require 'connect.inc.php';
$id=$_SESSION['id'];
$name=$_SESSION['name'];
date_default_timezone_set('Asia/Kolkata');
$cur_time=strtotime('now');
$day=date("d");
$month=date("m");
$year=date("Y");
$date=$year.'-'.$month.'-'.$day;
$x1=strtotime('00:00');
$y1=strtotime('11:00');
$x2=strtotime('12:00');
$y2=strtotime('19:30');
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
    <title>Guests</title>
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
                        <h1>Guests</h1>
                        <?php
                        if(($cur_time>=$x1&&$cur_time<=$y1)||($cur_time>=$x2&&$cur_time<=$y2)||($cur_time>=$x3&&$cur_time<=$y3))
                        {
							if($cur_time>=$x1&&$cur_time<=$y1)
								$meal_type='BREAKFAST';
							else if($cur_time>=$x2&&$cur_time<=$y2)
								$meal_type='LUNCH';
							else
								$meal_type='DINNER';
							echo'<form action="guest.php" method="POST">
								Number of Guests: <select name="no_guests" value="NULL">
                                    <option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
								</select><br><br>
								<input type="submit" value="Go">
								</form>';
						}
                        else
                            echo '<b>There is no meal available at the moment.</b>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <?php  
                    if(isset($_POST['no_guests']))
                    {
						$no_guests=$_POST['no_guests'];
						$_SESSION['no_guests']=$no_guests;
						echo 'Enter Guest Details: <br><br><form action="guest.php" method="POST">';
						for($i=1;$i<=$no_guests;$i++)
						{
							echo 'Guest '.$i.' :'.'<br><br>';
							echo 'Name: '.'<input type="text" name="guest_'.$i.'"> <br><br>';
						}
						echo '<input type="submit" value="Submit">';
						echo ' </form>';
					}
					else
					{  
						if(!isset($_SESSION['no_guests']))
                            $no_guests=0;
                        else
							$no_guests=$_SESSION['no_guests'];
					}
					?>   
                    </div>
                </div>
            </div>
        </div>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">  
                    <p>
					<?php 
					if(!isset($_POST['no_guests']))
					{
						for($j=1;$j<=$no_guests;$j++)
						{
							$g_name='guest_'.$j;
							if(isset($_POST[$g_name]))
							{
								if(!empty($_POST[$g_name]))
								{   
									$name=$_POST[$g_name];
									$que="SELECT * FROM guest WHERE Member_id='$id' AND Guest_name='$name' AND Month='$month' AND Meal_type='$meal_type' AND Date='$date' ";
									$q_r=mysql_query($que);
									if(mysql_num_rows($q_r)>0)
										echo "<b>Guest ".$j." Already registered. </b><br>";
									else
									{
										$que="INSERT INTO guest VALUES('$id','$name','$month','$meal_type','$date')";
										if($q_r=mysql_query($que))
										{
											echo "<b>".$name." registered with you for the current meal.</b><br>";
										}
									}
                                }
                                else
                                {
                                    echo "<b>Invalid value for guest ".$j."</b><br>";
                                }
						    }
                        }
					}
					?>
					</p>    
                    </div>
                </div>
            </div>
        </div>
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