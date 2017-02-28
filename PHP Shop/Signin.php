<?PHP

#===============================================#

#File: Signin.php
#Function: Processes the sign in details provided from the main login page.

#===============================================#

#Comment: Gets the sign in info that was entered from the login page
if(isset($_POST['submit'])){
	$user=$_POST['user'];
	$email=$_POST['email'];
	$email=strtolower($email);
	$password=$_POST['password'];
	
	#Comment: If a username or password are missing then it sends the user back to the main page and also tells the main page to display an error saying there's a missing field.
	if($email=="" or $password==""){header("Location: Main.php?blank");exit();}else{}
	
	#Comment: Connects to the database
	$db=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
	mysql_select_db("ticket") or die (mysql_error());
	$SQL="SELECT * FROM ".$user.""; 
	$result=mysql_query($SQL) or die(mysql_error());
	$num_results=mysql_num_rows($result);
	mysql_close($db);
	$amount=mysql_num_rows($result);
		for ($i=0; $i<$amount;$i++){$row=mysql_fetch_array($result); 
		
			#Checks to see if the provided login information is correct.
			if($email==$row['email'] and $password==$row['password']){
				
				#Comment: If the user is a customer, they get directed to the shop.
				if($user=="customers"){header("Location: Shop.php?submit=1&id=".$row['id']."");exit();}
				
				#If the user is an admin, they get directed to the admin panel.
				elseif($user=="admin"){header("Location: Admin.php?submit=9");exit();}
				else{header("Location: Main.php");exit();}
				
			}
		}
	
	#Comment: If the password or username is incorrect, the user gets directed back to the main page and displays an error saying something was incorrect.
	header("Location: Main.php?error");exit();
	}
else{header("Location: Main.php");exit();}

?>