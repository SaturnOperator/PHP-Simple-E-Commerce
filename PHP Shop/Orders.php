<?PHP 

#===============================================#

#File: Orders.php
#Function: Part of the admin panel, displays all orders that customers have made. Clicking on the order ID will display more information about the order (Such as date or purchase and which seats were purchased). Clicking on the customer's name displays all orders they've made.

#===============================================#

#Comment: Makes sure the user is logged on as an admin
#Comment: Checks to see if you want to sell all the orders or only the orders of one customer
if(!isset($_GET['submit'])){header("Location: Main.php");exit();}else{if($_GET['submit']!=9){header("Location: Main.php");exit();}else{}if(isset($_GET['customer_id']) and ctype_digit($_GET['customer_id'])){}elseif(isset($_GET['customer_id']) and $_GET['customer_id']=="all"){}else{header("Location: Main.php");exit();}}

$cid=$_GET['customer_id'];

if($cid=="all"){$cid="`customer_id`";}

?>


<html><title>Orders</title>
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
		
td { background:#FFF;padding:5px; padding-left:14px; padding-right:30px; font-size:13px; text-shadow: 0px 0px 10px rgba(0,0,0,0.15) }
		
tr:nth-child(even) td { background: rgba(255, 255, 255, 0.3); } 
tr:nth-child(odd) td { background: rgba(255, 255, 255, 0.5); }

tr:first-child th:first-child { 
  border-radius: 5px 0 0 0; 
} 

tr:first-child th:last-child { 
  border-radius: 0 5px 0 0; 
}

tr:last-child td:last-child { 
  border-radius:0 0 5px 0; 
}

tr:last-child td:first-child { 
  border-radius:0 0 0 5px; 
}

</style>

<link rel='stylesheet' type='text/css' href='Stylesheet.css'>
<div id='cu_pan'>
<div id='cu_panl'><br>
<h2 id='he_a'>Orders</h2>
<div id="centerall">

<p align="center" style="color:white">Click on the order's ID to see more details about an order.</p>

<table align="center" width="95%">
<tr>
    <th id='small' width="10%">ORDER ID:</th>
    <th width="25%">DATE & TIME:</th>
    <th width="25%">CUSTOMER NAME:</th>
    <th width="15%">SUBTOTAL:</th>
    <th width="12%">HST:</th>
    <th width="13%">TOTAL:</th>
</tr>
<?PHP

#Comment: Gets all the orders from the orders database, this will display either all orders or the orders of a specific customer depending on what the admin user selects.
$db=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
mysql_select_db("ticket") or die (mysql_error());
$SQL="SELECT *, `orders`.`id` AS `order_number`FROM `orders` INNER JOIN `customers` ON `orders`.`customer_id`=`customers`.`id` WHERE `orders`.`customer_id` = ".$cid." ORDER BY `orders`.`id` ASC"; 
$result=mysql_query($SQL) or die(mysql_error());
$num_results=mysql_num_rows($result);
mysql_close($db);
$amount=mysql_num_rows($result);

if($amount==0){echo "<tr><td colspan='6' align='center'><b> THERE ARE NO ORDERS </b> </td></tr>";}else{}

	for ($i=0; $i<$amount;$i++){$row=mysql_fetch_array($result);
	$tsubtotal=number_format((float)$row['sub_total'], 2, '.', '');
	$thst=number_format((float)$row['hst'], 2, '.', '');
	$ttotal=number_format((float)$row['total_cost'], 2, '.', '');
	
	
		#Comment: Clicking on the order ID redirects you to a page displaying more info about the order.
		echo"
			<tr>
				<td><a id='name' href='OrderDetails.php?submit=9&order_id=".$row['order_number']."'>".$row['order_number']."</a></td>
				<td>".$row['date']," At ".$row['time']."</td>
				<td><a id='name' href='Orders.php?submit=9&customer_id=".$row['customer_id']."'>".$row['last_name'],", ".$row['first_name']."</a></td>
				<td>$".$tsubtotal."</td>
				<td>$".$thst."</td>
				<td>$".$ttotal."</td>
			</tr>";
		}

?>

</table>
<br><br>

</div>
<?PHP
if($_GET['customer_id']=='all'){echo"<div id='txt_align'><a href='Admin.php?submit=9'> RETURN </a><br><br></div>";}else{echo"<div id='txt_align'><a href='Customers.php?submit=9'> RETURN </a><br><br></div>";}
?>
</div>
</div>
