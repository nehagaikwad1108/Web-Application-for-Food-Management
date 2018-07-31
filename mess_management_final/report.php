<?php
require 'core.inc.php';
require 'connect.inc.php';

if(isset($_POST['sel_month']))
{$id=$_SESSION['id'];
$name=$_SESSION['name'];
date_default_timezone_set('Asia/Kolkata');
$year=date("Y");
$month=$_POST['sel_month'];
switch($month)
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

$query="SELECT Bill_id,Total_meals,Guests,Cost_per_meal,Total_amount FROM bill WHERE Member_id=$id AND Month=$month AND Year=$year ";
$run=mysql_query($query);
if(mysql_num_rows($run)==0)
{
    die('<b>Bill not available.</b> <br><a href="my_bills.php">Back</a>');
}

while($row=mysql_fetch_assoc($run))       //loop will run only once
{
    $bid=$row['Bill_id'];
    $tm=$row['Total_meals'];
    $g=$row['Guests'];
    $cpm=$row['Cost_per_meal'];
    $ta=$row['Total_amount'];
}
$query="SELECT * FROM personal_details WHERE Id=$id  ";
$run=mysql_query($query);
while($row=mysql_fetch_assoc($run))
{
    $mob=$row['Mobile'];
    $em=$row['Email'];
}
$query="SELECT * FROM mess_member WHERE Member_Id=$id  ";
$run=mysql_query($query);
}
else
{
  die('<b>Session Expired.</b> <br> <a href="my_bills.php">Back</a>');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
     <script>window.print();</script>
    <header class="clearfix">
      
      <h1>INVOICE</h1>
      <div id="company" class="clearfix">
        <div>HOSTEL MESS C1</div>
        
      </div>
      <div id="project">
        <div><span>BILL ID</span><?php echo $bid; ?> </div>
        <div><span>NAME</span> <?php echo $name; ?></div>
        
        <div><span>EMAIL</span> <?php echo $em; ?></div>
        <div><span>MONTH</span> <?php echo $mone; ?></div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="desc">SERVICE</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">Meals</td>
            <td class="unit"><?php echo $cpm; ?></td>
            <td class="qty"><?php echo $tm; ?></td>
            <td class="total"><?php echo ($tm*$cpm); ?></td>
          </tr>
          <tr>
            <td class="desc">Guests</td>
             <td class="unit"></td>
            <td class="qty"></td>
           
            <td class="total"><?php echo ($g); ?></td>
          </tr>
          
          <tr>
            <td colspan="3" class="grand total">GRAND TOTAL</td>
            <td class="grand total"><?php echo 'Rs. '.($ta); ?></td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        <div><a href="my_bills.php">Back</a>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>