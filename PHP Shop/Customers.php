<?PHP 

#===============================================#

#File: Customers.php
#Function: Displays the list of customers it retreives from the database along with their account details.

#===============================================#


#Comment: Account validation

if(!isset($_GET['submit'])){header("Location: Main.php");exit();}else{if($_GET['submit']!=9){header("Location: Main.php");exit();}else{}}
?>

<!-- Comment: HTML structure of the page, displays info as a table -->

<html><title>Customers</title>
<style>

<!-- Comment: CSS Styling for the page -->

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
<h2 id='he_a'>Customers</h2>
<div id="centerall">
<p align="center" style="color:white">Click on a customer's name to see their purchase history.</p>

<table align="center" width="95%">
<tr>
    <th width="27%">NAME:</th>
    <th width="27%">E-MAIL:</th>
    <th width="18%">PASSWORD:</th>
    <th id='small'  width="18%">CREDIT CARD NUMBER:</th>
    <th id='small' width="12%">CREDIT CARD EXPIRY DATE:</th>
</tr>
<?PHP

#Comment: Gets the accounts from the database and then loops through them, outputting each account as a row.

$db=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
mysql_select_db("ticket") or die (mysql_error());
$SQL="SELECT * FROM customers ORDER BY last_name ASC, first_name ASC"; 
$result=mysql_query($SQL) or die(mysql_error());
$num_results=mysql_num_rows($result);
mysql_close($db);
$amount=mysql_num_rows($result);

#Comment: Looping through the results

if($amount==0){echo "<tr align='center'><td colspan='6' align='center'><b> THERE ARE NO CUSTOMERS </b> </td></tr>";}else{}

	for ($i=0; $i<$amount;$i++){$row=mysql_fetch_array($result);
		echo"
			<tr>
				<td><a id='name' href='Orders.php?submit=9&customer_id=".$row['id']."'>".$row['last_name'],", ".$row['first_name']."</a></td>
				<td>".$row['email']."</td>
				<td>".$row['password']."</td>
				<td>".$row['credit_card_num']."</td>
				<td>".$row['credit_card_expiry_date']."</td>
			</tr>";
		}

?>
</table>
<br><br>

</div>
<div id='txt_align'><a href='Admin.php?submit=9'> RETURN </a><br><br>
</div>
</div>
</div>
