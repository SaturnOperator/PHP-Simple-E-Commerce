<?PHP

#===============================================#

#File: Shop.php
#Function: Lets users buy tickets and select which tickets they want. The shop also displays what tickets are available. If they decide to modify their order and come back to this page, it will save their selection and also display the order total. When an admin visits this page then it only shows them seat availability and does not have the option to buy tickets.

#===============================================#

#Comment: Redirects the user to the main page if they're not logged in.

if(!isset($_GET['submit'])){header("Location: Main.php");exit();}else{}
if(!isset($_GET['id']) or $_GET['id']==""){header("Location: Main.php");exit();}else{}
?>

<html><title>Shop</title>
<style>
* {font-family: sans-serif;}
#inseat{margin:3px; background:rgba(0, 60, 100, 0.75); display:inline-table; border-radius:5px}

<?PHP

#Comment: CSS for the animation

for ($z=0; $z<16;$z++){$timez=($z/15+1);echo"#animate_".$z."_noanim{display:inline-block;alpha(opacity=100);opacity: 1;}
#animate_".$z."{display:inline-block;alpha(opacity=100);opacity: 1;animation-name: ScaleFX; animation-duration: 0.2s; animation-delay: ".$timez."s; animation-iteration-count: 1; animation-timing-function: ease; animation-fill-mode: backwards; animation-direction: normal; -webkit-animation-name: ScaleFX; -webkit-animation-duration: 0.2s; -webkit-animation-delay: ".$timez."s; -webkit-animation-iteration-count: 1; -webkit-animation-timing-function: ease; -webkit-animation-fill-mode: backwards; -webkit-animation-direction: normal; -moz-animation-name: ScaleFX; -moz-animation-duration: 0.2s; -moz-animation-delay: ".$timez."s; -moz-animation-iteration-count: 1; -moz-animation-timing-function: ease; -moz-animation-fill-mode: backwards; -moz-animation-direction: normal; } @keyframes ScaleFX { 0% { -webkit-transform: scale(0);-webkit-transform-origin: 50% 50%;-moz-transform: scale(0);-moz-transform-origin: 50% 50%;-o-transform: scale(0);-o-transform-origin: 50% 50%;-ms-transform: scale(0);-ms-transform-origin: 50% 50%;transform: scale(0);transform-origin: 50% 50%; } 90% { -webkit-transform: scale(1.1);-webkit-transform-origin: 50% 50%;-moz-transform: scale(1.1);-moz-transform-origin: 50% 50%;-o-transform: scale(1.1);-o-transform-origin: 50% 50%;-ms-transform: scale(1.1);-ms-transform-origin: 50% 50%;transform: scale(1.1);transform-origin: 50% 50%; } 100% { -webkit-transform: scale(1.0);-webkit-transform-origin: 50% 50%;-moz-transform: scale(1.0);-moz-transform-origin: 50% 50%;-o-transform: scale(1.0);-o-transform-origin: 50% 50%;-ms-transform: scale(1.0);-ms-transform-origin: 50% 50%;transform: scale(1.0);transform-origin: 50% 50%; } } @-webkit-keyframes ScaleFX { 0% { -webkit-transform: scale(0);-webkit-transform-origin: 50% 50%;-moz-transform: scale(0);-moz-transform-origin: 50% 50%;-o-transform: scale(0);-o-transform-origin: 50% 50%;-ms-transform: scale(0);-ms-transform-origin: 50% 50%;transform: scale(0);transform-origin: 50% 50%; } 90% { -webkit-transform: scale(1.1);-webkit-transform-origin: 50% 50%;-moz-transform: scale(1.1);-moz-transform-origin: 50% 50%;-o-transform: scale(1.1);-o-transform-origin: 50% 50%;-ms-transform: scale(1.1);-ms-transform-origin: 50% 50%;transform: scale(1.1);transform-origin: 50% 50%; } 100% { -webkit-transform: scale(1.0);-webkit-transform-origin: 50% 50%;-moz-transform: scale(1.0);-moz-transform-origin: 50% 50%;-o-transform: scale(1.0);-o-transform-origin: 50% 50%;-ms-transform: scale(1.0);-ms-transform-origin: 50% 50%;transform: scale(1.0);transform-origin: 50% 50%; } } @-moz-keyframes ScaleFX { 0% { -webkit-transform: scale(0);-webkit-transform-origin: 50% 50%;-moz-transform: scale(0);-moz-transform-origin: 50% 50%;-o-transform: scale(0);-o-transform-origin: 50% 50%;-ms-transform: scale(0);-ms-transform-origin: 50% 50%;transform: scale(0);transform-origin: 50% 50%; } 90% { -webkit-transform: scale(1.1);-webkit-transform-origin: 50% 50%;-moz-transform: scale(1.1);-moz-transform-origin: 50% 50%;-o-transform: scale(1.1);-o-transform-origin: 50% 50%;-ms-transform: scale(1.1);-ms-transform-origin: 50% 50%;transform: scale(1.1);transform-origin: 50% 50%; } 100% { -webkit-transform: scale(1.0);-webkit-transform-origin: 50% 50%;-moz-transform: scale(1.0);-moz-transform-origin: 50% 50%;-o-transform: scale(1.0);-o-transform-origin: 50% 50%;-ms-transform: scale(1.0);-ms-transform-origin: 50% 50%;transform: scale(1.0);transform-origin: 50% 50%; } }
";}
?>

#opah{display:inline-block; visibility:hidden}
#sold{background:url(Content/SOB.png); background-position:center; background-repeat:no-repeat; display:inline-table; width:78px;height:78px}
#savail{background:url(Content/Available.png); background-position:center; background-repeat:no-repeat; display:inline-table; width:78px;height:78px}
#sav{background:url(Content/AVB.png); background-position:center; background-repeat:no-repeat; display:inline-table; width:78px;height:78px}
#midit{padding:30px;}
#mini{font-size:5px}
#subalign{margin-left: 25px; margin-top:-20px}
.toohigh{margin-top:-20px}
#inline-table{display:block}
</style> 
<link rel='stylesheet' type='text/css' href='Stylesheet.css'>


<?PHP

#Comment: Displays only the admin information and not the options to buy tickets if the user is an admin.

if($_GET['submit']==9){echo "<div id='adminshop'><h1 id='he_a'> Admin Panel</h1>";}else{echo"<div id='shop' >";} ?>

<?PHP if($_GET['submit']==9){echo "<div id='adminpanel'>";}else{} ?>
    <div id="chart">
    <br />
    <form action="Confirmation.php" method="post">
    <h2 id="he_a"> Concert Seating Plan</h2><br>
    <p id="caption_c">Stage</p>
    <div id="seats" align="center">
    
    
    <?PHP
	
	if($_GET['submit']==9){echo"<div id='centerall' >";}else{echo"<div id='centerall'>";} 
	
	#Comment: Retreives the ticket information from the database such as availability. If it's not available then the system won't let you pick and buy that ticket if the user is a customer.
	
	echo"<input type='hidden' name='id' value=".$_GET['id']." /><input type='hidden' name='usertype' value=".$_GET['submit']." />";
	
	$db=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
	mysql_select_db("ticket") or die (mysql_error());
	$SQL="SELECT * FROM seats"; 
	$result=mysql_query($SQL) or die(mysql_error());
	$num_results=mysql_num_rows($result);
	mysql_close($db);
	$amount=mysql_num_rows($result);
	
		for ($i=0; $i<$amount;$i++){$row=mysql_fetch_array($result);
			
			#Comment: Governs the ticket's state such as if its available or sold and doesn't let the user buy it. Or if the user is returning to this page and has already selected that ticket, this will automatically check the checkbox for them.
			
			if(isset($_GET[$row['seat']])){$schecked="checked";}else{$schecked="";}
			if($row['order_id']!=0){$sdisabled="disabled";}else{$sdisabled="";}
			
			
			if($_GET['submit']==1){
				if($row['order_id']!=0){$opa="opah";}else{$opa="opac";}
				if($row['order_id']!=0){$ssold="sold";}else{$ssold="sav";}
				}
			elseif($_GET['submit']==9){
				$opa="opah";
				if($row['order_id']!=0){$ssold="sold";}else{$ssold="savail";}
				}
			else{header("Location: Main.php");exit();}
			
			
			if($row['order_id']!=0){$rname="rowprice_so";}
			elseif(substr($row['seat'], 0, -1)=="A"){$rname="rowprice_a";}
			elseif(substr($row['seat'], 0, -1)=="B"){$rname="rowprice_b";}
			elseif(substr($row['seat'], 0, -1)=="C"){$rname="rowprice_c";}
			elseif(substr($row['seat'], 0, -1)=="D"){$rname="rowprice_d";}
			else{$rname=="NA";}
			
			
			
			echo"<div id='animate_".$i."'><div id='".$rname."'><div id='inseat'><div id='".$ssold."'><div id='midit'><input id='".$opa."' align='middle' type='checkbox' name=".$row['seat']." value=".$row['price']." ".$schecked." ".$sdisabled."/></div></div></div></div></div>";
			if($i==3 or $i==7 or $i==11 or $i==15){echo"<br>";}else{}}
			
    ?>
    </div></div></div>
    
    <?PHP
	#Comment: Stops the code from displaying the buying options for admins.
	if($_GET['submit']==9){echo "</div><br /><div id='txt_align'><a href='Admin.php?submit=9'> RETURN </a></div></div></div></div>";exit();}else{} ?>
    
   
<!-- Comment:HTML Structure --> 

<div id="infow" ><div id="info""><br />
    <h3 id="he_c"> Order Your Tickets Here!</h3>
    <div id="txt_a">
    <p id="txt_a" align="left" class="toohigh">Select the seats that you want to buy from the seating plan shown to the right. The price of the ticket varies by row. </p> 
    <div id="subalign"><br />
        <table width="90%" border="0" align='left'>
          <tr>
            <td width="64%" id='txt_bb'>First Row:</td>
            <td width=22% id='txt_b'>$20.00</td>
            <td width=14% id='txt_c'>(A)</td>
          </tr>
          <tr>
            <td id='txt_bb'>Second Row: </td>
            <td id='txt_b'>$18.00</td>
            <td id='txt_c'>(B)</td>
          </tr>
          <tr>
            <td id='txt_bb'>Third Row:</td>
            <td id='txt_b'>$16.00</td>
            <td id='txt_c'>(C)</td>
          </tr>
          <tr>
            <td id='txt_bb'>Fourth Row:</td>
            <td id='txt_b'>$14.00</td>
	        <td id='txt_c'>(D)</td>
          </tr>
          <tr>
            <td id='txt_bb'> </td>
            <td id='txt_b'> </td>
	        <td id='txt_c'> </td>
          </tr>
        </table>
        </div>
    <br /><p id="txt_a" align="left" class="toohigh">After selecting seats, press Subtotal, or press Continue to confirm your order. </p> 
    
    <table border="0" align='center'>
      <tr>
        <td ><input type='submit' value='Subtotal:' id='pcbutton' name='pricecheck'></td>
        <td align='left' id='pcb'><?PHP if(isset($_GET['subtotal'])){$subtotal="$".$_GET['subtotal'].".00";}else{$subtotal="$0.00";} echo $subtotal; ?></td>
      </tr>
	</table>
    
    </div>
    <br>
</div>
<div align="right" id="inline-table"><br>


<?PHP

#Comment: Displays an error if no ticket is selected. Otherwise when the user continues, it sends info to the next form what stating what ticket's they're buying.

if(isset($_GET['none'])){echo"<label id='mini_error'> You must select a seat to continue.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>";}
elseif(isset($_GET['error'])){echo"<label id='mini_error'>The seat that you select is sold out.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>";}
else{echo"<label id='mini_error'></label>";}?>
  
  <input id="submit" type="submit" name="continue" value="CONTINUE" align="right">
  
</div>
</div>
</div>

</form>
