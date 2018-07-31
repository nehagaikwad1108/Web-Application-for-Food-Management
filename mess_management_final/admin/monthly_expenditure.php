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

    <title>Monthly Expenditure</title>

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
  text-align: center;
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
                        <h1>Monthly Expenditure</h1>
                       
                        <p>
                        
                        <br>
                                 
                        <form action="monthly_expenditure.php" method="POST" >
                        Month:  <select name="sel_month" value="null" required >
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
                        <input type="submit" name="submit" value="Go" />
                        </form>


                            





                            
                        


                        
                        </p>
                    </div>
                </div>
            </div>
        </div>
         <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                    if(isset($_POST['sel_month']))
                    {
                        

                        $val=$_POST['sel_month'];
                        $query="SELECT Order_id,Date,Amount,Store_name FROM expenses WHERE  (DATE LIKE '$year-$val-__') ORDER BY Date;";
                        $run=mysql_query($query);
                        switch($val)
                        {
                            case 01: $mone='JANUARY';
                                    break;
                            case 02: $mone='FEBRUARY';
                                    break;
                            case 03: $mone='MARCH';
                                    break;
                            case 04: $mone='APRIL';
                                    break;
                            case 05: $mone='MAY';
                                    break;
                            case 06: $mone='JUNE';
                                    break;
                            case 07: $mone='JULY';
                                    break;
                            case 08: $mone='AUGUST';
                                    break;
                            case 09: $mone='SEPTEMBER';
                                    break;
                            case 10: $mone='OCTOBER';
                                    break;
                            case 11: $mone='NOVEMBER';
                                    break;
                            case 12: $mone='DECEMBER';
                                    break;






                        }


                        if(mysql_num_rows($run)>0)
                        {
                            echo "
                                <p>
                                <table>
                                <caption>ORDERS $mone </caption>
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Amount(in Rs.)</th>
                                        <th> Inventory Store Name</th>
                                    </tr>
                                </thead>";
                            while($row=mysql_fetch_assoc($run))
                            {
                                $oi=trim($row['Order_id']);
                                $d=trim($row['Date']);
                                $amt=trim($row['Amount']);
                                $inam=trim($row['Store_name']);

                                echo '<tr>
                                        <td>'. $oi .'</td>
                                        <td>'. $d .'</td>
                                        <td>'. $amt .'</td>
                                        <td>'. $inam .'</td>
                                    </tr>';
                            }
                            
                            echo '<tr>
                                    <td colspan="2"><b>Total:</b></td>';

                                    $query="SELECT SUM(Amount) AS Total FROM expenses  WHERE (DATE LIKE '$year-$val-__')";
                                    $ans=mysql_query($query);
                                    while($row=mysql_fetch_assoc($ans))
                                    {

                                        $ans1=$row['Total'];

                                    }
                                    $query="SELECT SUM(Salary) AS Salary FROM mess_staff";
                                    $ans=mysql_query($query);
                                    while($row=mysql_fetch_assoc($ans))
                                    {

                                        $ans2=$row['Salary'];

                                    }
                                    $query="SELECT COUNT(*) AS Meals FROM attendance WHERE (DATE LIKE '$year-$val-__') AND Meal_type='BREAKFAST'";
                                    $ans=mysql_query($query);
                                    while($row=mysql_fetch_assoc($ans))
                                    {

                                        $nom1=$row['Meals'];

                                    }
                                    $query="SELECT COUNT(*) AS Meals FROM attendance WHERE (DATE LIKE '$year-$val-__') AND Meal_type='LUNCH'";
                                    $ans=mysql_query($query);
                                    while($row=mysql_fetch_assoc($ans))
                                    {

                                        $nom2=$row['Meals'];

                                    }
                                    $query="SELECT COUNT(*) AS Meals FROM attendance WHERE (DATE LIKE '$year-$val-__') AND Meal_type='DINNER'";
                                    $ans=mysql_query($query);
                                    while($row=mysql_fetch_assoc($ans))
                                    {

                                        $nom3=$row['Meals'];

                                    }

                                    $nom=($nom1*0.5)+$nom2+$nom3;

                            echo "<td><b>$ans1</b></td></tr>";




                        

                            echo '</table></p>';

                           echo '<br><br>';
                           echo '<h1> Total Expenditure</h1>';
                           $final=$ans1+$ans2;
                           echo "
                                <br><br>
                                <p><b>

                                Total Expenditure= Total Amount(Orders) + Joint Mess Committee Bills
                                <br>
                                <br>
                                Total Expenditure= Rs. $ans1 + Rs. $ans2
                                <br>
                                <br>
                                Total Expenditure= Rs. $final
                                <br>
                                <br>
                                Total Number of Meals= $nom";

                            if($nom>0)
                            {

                                $cpm=$final/$nom;
                                $cpm1=round($cpm,2);
                                echo"

                                <br><br>
                                Cost per Meal= Rs. $cpm1 


                                ";
                            }

                            else
                            {

                                echo " </b> </p>";

                          

                            }














                         




                            




                        }
                        else
                            echo '<br> <b>No such record found.</b>';
                    




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