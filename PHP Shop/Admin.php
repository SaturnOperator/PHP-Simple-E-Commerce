<?PHP 

#===============================================#

#File: Admin.php
#Function: Admin panel lets you reset the database (refund) and has links forwarding you to order, customers or the seating chart pages.

#===============================================#


#Comment: Verifies if the login info matches with the admin account in the database

if(!isset($_GET['submit'])){header("Location: Main.php");exit();}else{if($_GET['submit']!=9){header("Location: Main.php");exit();}
	
#Comment: Erases the database if it receives the command to refund tickets.
	
	if(isset($_GET['erase'])==true && $_GET['erase']==1){
		
		
		$db=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
		mysql_select_db("ticket") or die (mysql_error());
		$SQL="DELETE FROM `ticket`.`orders` WHERE `orders`.`id` = `orders`.`id`;";
		$result=mysql_query($SQL) or die(mysql_error());
		$SQL="UPDATE `ticket`.`seats` SET `order_id` = '0' WHERE `seats`.`id` = `seats`.`id`;";
		$result=mysql_query($SQL) or die(mysql_error());
		$num_results=mysql_num_rows($result);
		mysql_close($db);
		}else{}
	
}

?>

<!-- Comment: HTML code that displays the panel and button -->

<html>
<title>Admin Control Panel</title>
<link rel='stylesheet' type='text/css' href='Stylesheet.css'>
<div id='adminshop'>
  <div id='admin_pan'><br>
    <h2 id='he_a'>Admin Control Panel</h2>
    <table width='100%' border='0' align='center'>
      <tr>
        <td align='center' height="45px"><form action=' Shop.php?submit=9&id=0' method='post'>
            <input id='ad_bu' type='submit' name='submit' value='Seating Chart' align='center'>
          </form></td>
      </tr>
      <tr>
        <td align='center' height="45px"><form action='Customers.php?submit=9&id=0' method='post'>
            <input id='ad_bu' type='submit' name='submit' value='Customers' align='center'>
          </form></td>
      </tr>
      <tr>
        <td align='center' height="45px"><form action='Orders.php?submit=9&customer_id=all' method='post'>
            <input id='ad_bu' type='submit' name='submit' value='Orders' align='center'>
          </form></td>
      </tr>
      
        <td align='center' height="45px"><form action='Admin.php?submit=9&erase=1' method='post'>
            <input id='ad_bu' type='submit' name='submit' value='REFUND TICKETS' align='center'>
          </form></td>
      </tr>
      <tr>
        <td align='center' height="45px"><form action='Main.php' method='post'>
            <input id='ad_bu' type='submit' name='submit' value='LOG OUT' align='center'>
          </form></td>
      </tr>
    </table>
  </div>
</div>
