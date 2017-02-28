<?PHP 

#===============================================#

#File: OrderDetails.php
#Function: Displays the information about a certain order that was made from the order's database (Such as date, time, cost, tax, the customers etc.). It will also go to the seat database and pull up which seats were bought in that order.

#===============================================#

if(!isset($_GET['submit'])){header("Location: Main.php");exit();}else{if($_GET['submit']!=9){header("Location: Main.php");exit();}else{}if(isset($_GET['order_id']) and ctype_digit($_GET['order_id'])){}else{header("Location: Main.php");exit();}}

$oid=$_GET['order_id'];

?>



<html><title>Order #<?PHP echo $oid; ?> Details</title>
<style>
/* CSS Styling */
#name:link {color: rgba(255, 255, 255, 0.8);text-decoration: none;}
#name:visited {color: rgba(255, 255, 255, 0.8);text-decoration: none;}
#name:hover {color: #F69;text-decoration: none;}
#name:active {color: #F36;text-decoration: none;}

* {font-family:Arial, Helvetica, sans-serif;}
#small{font-size:10px}

table {
  color: #FFF;
  font-family: Helvetica, Arial, sans-serif;
  border-collapse: collapse; border-spacing: 0; 
}
		
td, th {  border: 0 none; height: 30px; }
			
th {
	background-color:rgba(223, 50, 93, 0.5);
	color: #FFF; font-weight: bold;
	height: 35px;
	font-size:16px;
	text-align:left;
	padding:5px;
}
		
td { background:#FFF; ;padding:5px; padding-left:14px; padding-right:30px; font-size:13px; text-shadow: 0px 0px 10px rgba(0,0,0,0.15) }
		
tr:nth-child(even) td { background: rgba(255, 255, 255, 0.3); } 
tr:nth-child(odd) td { background: rgba(255, 255, 255, 0.5); }

tr:first-child td:first-child { 
  border-radius: 5px 0 0 0; 
} 

tr:first-child td:last-child { 
  border-radius: 0 5px 0 0; 
}

tr:last-child td:last-child { 
  border-radius:0 0 5px 0; 
}

tr:last-child td:first-child { 
  border-radius:0 0 0 5px; 
}

#ttitles{ font-size:14px; font-weight:bold; }
</style>

<link rel='stylesheet' type='text/css' href='Stylesheet.css'>
<div id='or_pan'>
<div id='cu_panl'><br>
<h2 id='he_a'>Order #<?PHP echo $oid; ?> Details</h2>
<div id="centerall">

<table align="center" width="95%">

<?PHP

#Comment: Pulls up the order information and the seats that were purchased in that order from the orders and seats databases.
$db=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
mysql_select_db("ticket") or die (mysql_error());
$SQL="SELECT `orders`.`id`,`orders`.`customer_id`,`orders`.`sub_total`,`orders`.`hst`,`orders`.`total_cost`,`orders`.`date`,`orders`.`time`,`customers`.`last_name`,`customers`.`first_name`,`customers`.`credit_card_num`,`customers`.`credit_card_expiry_date`, `seats`.`seat`,`seats`.`price`,`seats`.`id` FROM `orders` AS `orders`  LEFT OUTER JOIN `customers` AS `customers` ON `customers`.`id` = `orders`.`customer_id` LEFT OUTER JOIN `seats` AS `seats` ON `seats`.`order_id` = `orders`.`id` WHERE `orders`.`id` = ".$oid." ORDER BY `seats`.`id`"; 
$result=mysql_query($SQL) or die(mysql_error());
$num_results=mysql_num_rows($result);
mysql_close($db);
$amount=mysql_num_rows($result);

	
				
		#Comment: Displays the order information.
		echo"
			<table align='center'>
			<tr>
				<td valign='top' id='ttitles'>Seats Ordered:</td><td align='right'>
				";
				
				for ($i=0; $i<$amount;$i++){$row=mysql_fetch_array($result);
					$tprice=number_format((float)$row['price'], 2, '.', '');
					echo "<p><label id='ttitles'>".$row['seat'].":</label> $".$tprice." </li>";
					
				}
				
			
	$tsubtotal=number_format((float)$row['sub_total'], 2, '.', '');
	$thst=number_format((float)$row['hst'], 2, '.', '');
	$ttotal=number_format((float)$row['total_cost'], 2, '.', '');
	
				
			echo"
			</td>
			</tr>
			<tr>
				<td id='ttitles'>Customer Name: </td>
				<td align='right'>".$row['last_name'].", ".$row['first_name']."</td>
			</tr>
			<tr>
				<td id='ttitles'>Subtotal:</td>
				<td align='right'>".$tsubtotal."</td>
			</tr>
			<tr>
				<td id='ttitles'>HST:</td>
				<td align='right'>".$thst."</td>
			</tr>
			<tr>
				<td id='ttitles'>Total:</td>
				<td align='right'>".$ttotal."</td>
			</tr>
			<tr>
				<td id='ttitles'>Date:</td>
				<td align='right'>".$row['date']."</td>
			</tr>
			<tr>
				<td id='ttitles'>Time:</td>
				<td align='right'>".$row['time']."</td>
			</tr>
			<tr>
				<td id='ttitles'>Credit Card Number:</td>
				<td align='right'>".$row['credit_card_num']."</td>
			</tr>
			<tr>
				<td id='ttitles'>Credit Card Expiry Date:</td>
				<td align='right'>".$row['credit_card_expiry_date']."</td>
			</tr>
			";

?>

</table>
<br><br>

</div>
<div id='txt_align'><a href='Orders.php?submit=9&customer_id=all'> RETURN </a><br><br></div>
</div>
</div>
