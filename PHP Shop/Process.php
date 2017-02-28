<?PHP

#===============================================#

#File: Process.php
#Function: Retrieves the order details from the confirmation page and updates the database with the order information such as which seats were purchased, the total cost and date and time of the purchase.

#===============================================#

if(isset($_POST['process'])){
	
	#Comment: Gets the date and time, order details and the cusomter's ID
	date_default_timezone_set('America/New_York');
	$date=date("Y/m/d");
	$time=date("H:i:s");
	$sub_total=$_POST['sub_total'];
	$hst=$_POST['hst'];
	$total_cost=$_POST['total_cost'];
	$customer_id=$_POST['customer_id'];

	#Comment: Publishes the order details into the orders section databse. (Date, time, subtotal, total, tax and the customer's ID number who made the purchase.
	$db=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
	mysql_select_db("ticket") or die (mysql_error());
	$SQL="INSERT INTO `orders`(`id`, `date`, `time`, `sub_total`, `hst`, `total_cost`, `customer_id`) VALUES (NULL,'".$date."','".$time."',".$sub_total.",".$hst.",".$total_cost.",".$customer_id.")";
	$result=mysql_query($SQL) or die(mysql_error());
	$order_id=mysql_insert_id();
	mysql_close($db);
	
	#Comment: Connects to the database into the seats section of the database and changes the property called "Order ID" that each seat has to the order number of the seats which were purchased. 
	$dbx=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
	mysql_select_db("ticket") or die (mysql_error());
	$SQLx="SELECT * FROM seats";
	$resultx=mysql_query($SQLx) or die(mysql_error());
	$num_resultsx=mysql_num_rows($resultx);
	mysql_close($dbx);
	$amountx=mysql_num_rows($resultx);
	for ($i=0; $i<$amountx;$i++){$rowx=mysql_fetch_array($resultx);
		
		if(isset($_GET[$rowx['seat']])){
			$dba=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
			mysql_select_db("ticket") or die (mysql_error());
			$SQLa="UPDATE `ticket`.`seats` SET `order_id` = ".$order_id." WHERE `seats`.`seat` = '".$rowx['seat']."';";
			$resulta=mysql_query($SQLa) or die(mysql_error());
			mysql_close($dba);
			
		}
	}
	
	#Comment: Prompts the user if they wish to logout or buy more tickets.
	echo "
		<html><title>Order Processed</title>
		<link rel='stylesheet' type='text/css' href='Stylesheet.css'>
		<div id='confirm'>
		<div id='confirm_panel'>
		<h2 id='he_a'>Thank your for your order</h2>
		<p align='center' id='txt_a'> We will see you at the show! </p>
		<table width='100%' border='0' align='center'>
		  <tr>
			<td align='center'>
				<form action=' Shop.php?submit=1&id=".$customer_id."' method='post'>
				<input id='process' type='submit' name='process' value='BUY MORE' align='right'>
				</form>
			</td>
			<td align='center'>
				<form action='Main.php' method='post'>
				<input id='process' type='submit' name='process' value='LOG OUT' align='right'>
				</form>
			</td>
		  </tr>
		</table>
		</div>
		</div>
	";
	exit();
	
}#first if
else{header("Location: Main.php");exit();}


?>