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

    <title>General Meal Statistics</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<style>
table {
  font-family: "Helvetica Neue", Helvetica, sans-serif;
}caption {
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
				<li> <a href="expenses_entry.php">Expenses Entry</a></li>
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
                        <h1>Order Items</h1>
						<br><br>
						<form action="inventory_order.php" method="post">
						Select item:
						<select name="inv_order">
						<?php 
							$sql = "SELECT * from inventory WHERE 1";
							$result = mysql_query($sql);
							if(mysql_num_rows($result)>0)
							{
								while($row = mysql_fetch_assoc($result))
								{
									$item_id = $row["Item_id"];
									$description = $row["Description"];
									echo "<option value='$item_id'>$description</option>";
								}
							}
						?>
						</select><br/>
						Enter Order ID: <input type="text" name="orderid" required><br/>
						Enter Quantity: <input type="text" name="qty" required>
						<br/>Enter Rate: <input type="text" name="rate" required>
						<input type="submit" value="Go" name="submit">
					</form>
					<?php 
						if(isset($_POST["submit"]))
						{
							$orderid = $_POST["orderid"];
							$qty = $_POST["qty"];
							$rate = $_POST["rate"];
							$inv_order = $_POST["inv_order"];
							$amt = $qty * $rate;
							$sql = "Insert into inventory_orders values ('$orderid', '$inv_order', '$qty', '$rate', '$amt')";
							$result = mysql_query($sql);
							if($result)
							{
								echo "Item inserted successfully";
							}
							else
							{
								echo "Unsuccessful!!";
							}
						}
					?>
					</div>
                </div>
            </div>
        </div>

        <br><br>
        
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
