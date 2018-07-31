



<head>
	<title>Login Page</title>
		<meta charset="utf-8">
		<link href="css/style_login.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--webfonts-->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
		<!--//webfonts-->
</head>
<body>
	 <!-----start-main---->
	 <div class="main">
		<div class="login-form">
			<h1>Member Login</h1>
					
				<form action="<?php echo $current_file ?>" method="POST">
						<input type="text" class="text" name="id" placeholder="Member ID" onfocus="this.value = '';"  >
						<input type="password" placeholder="Password" name="password" onfocus="this.value = '';" >
						<div class="submit">
							<input type="submit" onclick="myFunction()" value="LOGIN" >
					</div>	
				
				</form>
			
</body>
</html>

<?php

	
	
	if(isset($_POST['id'])&&isset($_POST['password']))
	{
		 ($id=$_POST['id']);
		 $password=$_POST['password'];

		if(!empty($id)&&!empty($password))
		{

				$query=" SELECT Id,Password,Category FROM login WHERE Id='$id' AND Password='$password' ";
				if($query_run=mysql_query($query))
			{	

				$num=mysql_num_rows($query_run);
				if($num==1)
				{
						
						
						
						$row=mysql_fetch_assoc($query_run);
						$cat=$row['Category'];
						$_SESSION['id']=$id;
						$_SESSION['cat']=$cat;
						
						header('Location: index.php');

				}
				else
				{

					echo '<div class="invalid">Invalid ID or Password.</div>';

				}
			
			}
		
		}
		else
		{

			echo '<div class="invalid">Please enter Member ID and Password.</div>';
		}




	
	}




?>

