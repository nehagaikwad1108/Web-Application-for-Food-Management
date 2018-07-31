<?php
require 'core.inc.php';
require 'connect.inc.php';


echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Meal Statistics</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>';
  if(isset($_POST['sel_month']))
{







$id=$_SESSION['id'];
$name=$_SESSION['name'];
date_default_timezone_set('Asia/Kolkata');
$year=date("Y");
$val=$_POST['sel_month'];
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




            $query="SELECT Meal_type,Date FROM attendance WHERE Member_id='$id' AND Month='$val' AND (DATE LIKE '2015-__-__') ORDER BY Date;";
            $run=mysql_query($query);
            if(mysql_num_rows($run)>0)
            {
              


              echo ' 

               <script>window.print();</script>
              <header class="clearfix">
      
      <h1>MEAL STATISTICS - '. $mone .'  <br>'.$name.'</h1>
      
   
    </header> ';
        echo '<main>
      <table>
        <thead>
          <tr>
            <th class="desc">MEAL TYPE</th>
            <th>DATE</th>
            
          </tr>
        </thead>
        <tbody>';






              
              while($row=mysql_fetch_assoc($run))
              {
                $mt=$row['Meal_type'];
                $d=$row['Date'];
                
                echo '
                  <tr>
            <td class="desc">'.$mt.'</td>
            <td class="unit">'.$d.'<?php echo $cpm; ?></td>
            
            </tr>';
            
            }
              echo '</tbody></table> <a href="meal_statistics.php">Back</a>';
              echo '  </main>
    



    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>';
            }
            else
              echo '<br> <b>No such record found.</b><br><a href="meal_statistics.php">Back</a>';



}
else
{

  die('<b>Session Expired.</b><br><a href="meal_statistics.php">Back</a>');
}






?>






      
  