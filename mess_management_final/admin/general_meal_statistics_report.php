<?php
require '../core.inc.php';
require '../connect.inc.php';
echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>General Meal Statistics</title>
    <link rel="stylesheet" href="../style.css" media="all" />
  </head>
  <body>';


  if(isset($_POST['sel_month_from']) && isset($_POST['sel_month_to']) && isset($_POST['sel_date_from']) && isset($_POST['sel_date_to']))
          {
            

            $year=date("Y");
            $val_month=$_POST['sel_month_from'];
            $val_date=$_POST['sel_date_from'];
            $val_from = $year.'-'.$val_month.'-'.$val_date;
            $val_month=$_POST['sel_month_to'];
            $val_date=$_POST['sel_date_to'];
            
            $val_to = $year.'-'.$val_month.'-'.$val_date;
            $query="SELECT Member_id,Meal_type,Date FROM attendance WHERE Date BETWEEN '$val_from' AND '$val_to' ORDER BY Date ASC;";
            $run=mysql_query($query);
            if(mysql_num_rows($run)>0)
            {
              

              echo ' 



              <script>window.print();</script>
              <header class="clearfix">
      
      <h1>GENERAL MEAL STATISTICS</h1>
      
   
    </header> ';


               echo '<main>
      <table>
        <thead>
          <tr>
            
            <th class="desc">DATE</th>
            <th>MEMBER ID</th>
            <th>MEAL TYPE</th>
            
          </tr>
        </thead>
        <tbody>';

              while($row=mysql_fetch_assoc($run))
              {
                $mt=$row['Meal_type'];
                $mid=$row['Member_id'];
                $d=$row['Date'];
                    echo '
                  <tr>
            
            <td class="desc">'.$d.'</td>
            <td class="desc">'.$mid.'</td>
            <td class="unit">'.$mt.'</td>
            
            </tr>';
              }
               echo '</tbody></table><a href="general_meal_statistics.php">Back</a>';
              echo '  </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>';
            }
            else
              echo '<br> <b>No such record found.</b><br><a href="general_meal_statistics.php">Back</a>';
          }
          else
{

  die('<b>Session Expired.</b><br><a href="general_meal_statistics.php">Back</a>');
}

?>   