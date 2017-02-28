<?PHP

#===============================================#

#File: Confirmation.php
#Function: Retreives the user's selection of seats they wish to purchase from the shop and then displays the details of the order a customer is about to make, such as the tickets they're buying, the cost of each ticket, the total before and after tax and the user's name and last 4 digits of their creditcard number. If the user decides to modify the order, the code sends back what seats were selected to save their options if they wish to change something. This script will also send the user back to the shop if they try to buy a ticket that has already been purchased if they find out a way to bypass system in the shop.

#===============================================#



if(isset($_POST['pricecheck']) or isset($_POST['continue'])){
	
	#Comment: Creating a new blank array.
	$seats=array();
	
	#Comment: Connecting to the database and retrieves all the ticket information.  
	$db=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
	mysql_select_db("ticket") or die (mysql_error());
	$SQL="SELECT * FROM seats";
	$result=mysql_query($SQL) or die(mysql_error());
	$num_results=mysql_num_rows($result);
	mysql_close($db);
	
	#Comment: Checks what seats the user wishes to buy and adds these seats into an array.
	$amount=mysql_num_rows($result);
		for ($i=0; $i<$amount;$i++){$row=mysql_fetch_array($result);
		if(isset($_POST[$row['seat']]) and $row['order_id']==0){array_push($seats, array($row['seat'],$_POST[$row['seat']]));}else{}
		}
		
		#Comment: Redirects the user back to the shop if they attempt to buy a ticket that has already been purchased.
		if(isset($_POST[$row['seat']]) and $row['order_id']!=0){header("Location: Shop.php?submit=".$_POST['usertype']."&id=".$_POST['id']."&error");exit;}else{}
			$subtotal=0;
			$purchased="";
			
			#Comment: This adds up the total cost of the tickets and then calculates the final cost including tax.
			for ($i=0; $i<count($seats);$i++){
				$subtotal=$subtotal+$seats[$i][1];
				$purchased=$purchased.$seats[$i][0]."&";
			}
		if(isset($_POST['pricecheck'])){
			header("Location: Shop.php?submit=".$_POST['usertype']."&id=".$_POST['id']."&".$purchased."subtotal=".$subtotal."");
			exit();}
		elseif(isset($_POST['continue'])){
			
			#Comment: Sends the user back to the shop if they selected no tickets
			if(count($seats)==0){header("Location: Shop.php?submit=".$_POST['usertype']."&id=".$_POST['id']."&none");exit;}else{}
			
			#Comment: Connects to the database and pulls up the account's information such as name and the last digits of the credit card number the user is using.
			$db=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
			mysql_select_db("ticket") or die (mysql_error());
			$SQL="SELECT * FROM customers WHERE id=".$_POST['id']."";
			$result=mysql_query($SQL) or die(mysql_error());
			$num_results=mysql_num_rows($result);
			mysql_close($db);
			$row=mysql_fetch_array($result);
			echo"
			
			<html><title>Order Confirmation</title>
			<link rel='stylesheet' type='text/css' href='Stylesheet.css'>

			
            <style>
            #tblabel{color:#FFF; font-family:'TYPOGRAPHPRO-Light';src: url(Content/TYPOGRAPHPRO-Light.ttf); text-shadow:0px 0px 10px rgba(0,0,0,0); text-transform:uppercase; }
			.td_a{font-size:18px}
			.td_b{font-size:18px}
			.td_c{font-size:18px}
			.td_d{font-size:12px}
			.td_e{font-size:23px}
			.td_f{font-size:13px}
			#tbvalue{color:#F36; font-family:'TYPOGRAPHPRO-Light';src: url(Content/TYPOGRAPHPRO-Light.ttf); text-shadow:0px 0px 10px rgba(0,0,0,0); font-size: 15px; }
            </style>
			
            <div id='confirm'>
            <div id='confirm_panel'>
            <h1 id='he_a'>Order Confirmation</h1>
            
            <table width='90%' border='0' align='center'>
              <tr>
                <td height='35px' width='47%' align='left' id='tblabel' class='td_a'>Cutomer Name:</td>
                <td width='53%' align='right' id='tbvalue'>"; 
                
                echo $row['first_name'].", ". $row['last_name']; 
				
				echo"</td>
              </tr>
              <tr>
                <td height='35px' valign='top' align='left' id='tblabel' class='td_b'>Seats Ordered:</td>
                <td align='right' id='tbvalue' valign='top'>
                
                    <table border='0'>
                      <tr>
                        <td width='60px' align='left' id='tblabel'>Seat</td>
                        <td align='left' id='tblabel'>Price</td>
                      </tr>";
                      
					  for ($i=0; $i<count($seats);$i++){
					  	echo"<tr>
                        	<td align='left' id='tbvalue'>".$seats[$i][0]."</td>
                        	<td align='Left' id='tbvalue'> $".$seats[$i][1].".00</td>
                      		</tr>";
					  }
					 echo"
                    </table>
                    
                </td>
              </tr>
              <tr>
                <td height='35px' align='left' id='tblabel' class='td_c'>SubTotal Cost:</td>
                <td align='right' id='tbvalue'>$"; 
				
				#Comment: Rounds the subtotal to 2 decimal places.
				$subtotal=number_format((float)$subtotal, 2, '.', '');
				echo $subtotal;
				
				echo"</td>
              </tr>
              <tr>
                <td height='35px' align='left' id='tblabel' class='td_d'>Harmonized Sales Tax:</td>
                <td align='right' id='tbvalue'>$"; 
				
				#Comment: Calculates tax and rounds to 2 decimal places.
				$hst=$subtotal*0.13;
				$hst=number_format((float)$hst, 2, '.', '');
				echo $hst;
				
				echo"</td>
              </tr>
              <tr>
                <td height='35px' align='left' id='tblabel' class='td_e'>Total Cost:</td>
                <td align='right' id='tbvalue'>$"; 
				
				#Comment: Calculates total price and rounds.
				$total=$subtotal+$hst;
				$total=number_format((float)$total, 2, '.', '');
				echo $total;
				
				echo"</td>
              </tr>
              <tr>
                <td height='35px' align='left' id='tblabel' class='td_f'>Credit Card Number:</td>
                <td align='right' id='tbvalue'>"; 
				
				#Comment: Gets the user's credit card number and then only display's the last 4 digits.
				$credit_card_number=$row['credit_card_num'];
				$lastdigits=substr($credit_card_number, 12, 4);
				echo "XXXX-XXXX-XXXX-".$lastdigits;
				
				#Comment: Sends the order information to the process.php page to process the information.
				echo"</td>
              </tr>
            </table>
			<br />
			<table width='90%' border='0' align='center'>
			  <tr>
				<td  align='center'>
				
					<form method='POST' action='Process.php?".$purchased."'>
						<input type='hidden' name='customer_id' value=".$_POST['id'].">
						<input type='hidden' name='sub_total' value=".$subtotal.">
						<input type='hidden' name='hst' value=".$hst.">
						<input type='hidden' name='total_cost' value=".$total.">
						<input id='process' type='submit' name='process' value='PROCESS ORDER' align='right'>
					</form>
				
				</td>
				<td  align='center'>
				
					<!-- Comment: If the user wishes to modify their order, their current selection will be sent to the shop. -->
					<form method='POST' action='Shop.php?submit=".$_POST['usertype']."&id=".$_POST['id']."&".$purchased."subtotal=".$subtotal."'>
					<input id='submit' type='submit' name='Cancel' value='CANCEL' align='right'>
					</form>
				
				</td>
			  </tr>
			</table>
			
			
			
            </div>
            </div>";
			
			

			}
		else{}
	}
	else{}

#Comment: Redirects the user to the homepage if they're not logged in and try to access the page.
if(!isset($_POST['continue'])){header("Location: Main.php");exit();}else{}
if(!isset($_POST['id']) or $_POST['id']==""){header("Location: Main.php");exit();}else{}
?>
