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

    <title>Expenses Entry</title>

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
                        <h1>Expenses Entry</h1>
                        <br><br>
                        <p>
                        <?php
                            
                            echo '

                          <form method="POST" action="expenses_entry.php" enctype="multipart/form-data">
 
  <section>
    

      
      
    
    <p>
      <label for="name">
        <span>Order ID: </span>
        <br><input type="text" id="Order_id" name="Order_id" required />
        
      </label>
    </p>
    
     <p>
      <label for="mail">
        <span>Amount: </span>
        <br><input type="text" id="Amount" name="Amount" required />
        
      </label>
    </p>
    <p>
      <label for="mail">
        <span>Inventory Store: </span>
        <br><input type="text" id="Store_name" name="Store_name" required />
        
      </label>
    </p>
    <p>
      <label for="mail">
        <span>Invoice: (in pdf Format)</span>
        <br><input type="file" id="Invoice" name="Invoice" required />
        
      </label>
    </p>
     <p>
      <label for="mail">
        
        <input type="submit" id="Submit" name="Submit" required />
        
      </label>
    </p>
  </section>
 
  
</form>

';



                    if(isset($_POST['Submit']))
                    {

                        if(is_numeric($_POST['Amount']))
                        {


                            



                            $oid=$_POST['Order_id'];
                            $amount=$_POST['Amount'];
                            $store=$_POST['Store_name'];
                            $file=$_FILES['Invoice']['name'];
                            $size=$_FILES['Invoice']['size'];
                            $type=$_FILES['Invoice']['type'];
                            $tmp_name=$_FILES['Invoice']['tmp_name'];
                            
                            $ext=substr($file,strpos($file,'.')+1);
                            $path='invoice_uploads/'.$oid.'.'.$ext;
                            if($ext=='pdf')
                            {

                                if($size<=2097152)
                                {
                            

                            if(move_uploaded_file($tmp_name, $path))
                            {

                            $date=$year.$month.$day;

                            $query="INSERT INTO expenses VALUES('$oid',$date,$amount,$id,'$store','$path')";
                            $run=mysql_query($query);
                            if($run)
                            {
                                echo '<b>Your expense has been registered.</b>';

                            }

                        }




                        


                        }

                        
                        else
                        {

                            echo 'The size should be less than 2MB.';

                        }

                        }
                        else
                        {

                            echo '<b>The file extension must be .pdf.';

                        }


                   }
                        else
                        {

                            echo '<b>Please enter a valid amount.</b>';

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