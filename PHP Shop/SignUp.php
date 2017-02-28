<?PHP

#===============================================#

#File: SignUp.php
#Function: This page lets a new customer sign up for an account. If they are missing any details or they provide details that aren't in the correct format (Such as an incorrect email, an expired credit card number or a letter in the credit card field, it will notify the user and keep the existing data they entered so they don't need to restart the form each time an error occurs.)

#===============================================#

#Comment: Gets the previously entered data if they're being redirected back to the sign up page due to an error which the registration process page has picked up.
if(isset($_GET['ve'])){
	$ea=$_GET['ea'];$eb=$_GET['eb'];$ec=$_GET['ec'];$ed=$_GET['ed'];$ee=$_GET['ee'];$efa=$_GET['efa'];$efb=$_GET['efb'];
	
	$gfn=$_GET['first_name'];
	$gln=$_GET['last_name'];
	$gea=$_GET['email'];
	$gap=$_GET['password'];
	$gcn=$_GET['credit_card_num'];
	$gccem=$_GET['ccem'];
	$gccey=$_GET['ccey'];
	
	#Comment: States which errors occured from the info recieved from the process page, if a certain field had no error then it won't show that error.
	if($ea=="no"){$hea="Use only alphabetic characters in the first name.";$fnc="FF0000";}else{$hea="X";$fnc="FFFFFF";}
	if($eb=="no"){$heb="Use only alphabetic characters in the last name.";$lnc="FF0000";}else{$heb="X";$lnc="FFFFFF";}
	if($ec=="no"){$hec="The provided e-mail address is not valid.";$eac="FF0000";}else{$hec="X";$eac="FFFFFF";}
	if($ed=="no"){$hed="The password must be at least 6 characters long.";$apc="FF0000";}else{$hed="X";$apc="FFFFFF";}
	if($ee=="no"){$hee="The credit card number must be a 16 digit number.";$cnc="FF0000";}else{$hee="X";$cnc="FFFFFF";}
	if($efa=="no"){$hefa="You must provide a credit card expiy date.";$cec="FF0000";}else{$hefa="X";$cec="FFFFFF";}
	if($efa=="yes"){if($efb=="no"){$hefb="The provided credit card has expired.";$cec="FF0000";}else{$hefb="X";$cec="FFFFFF";}}else{$hefb="X";}
	
	}else{$hea="X";$heb="X";$hec="X";$hed="X";$hee="X";$hefa="X";$hefb="X";}

?>

<!-- HTML form for the sign up page -->
<html>
<title>Sign Up</title>
<style> 
* {font-family: sans-serif;}
a:link {color: rgba(255, 255, 255, 0.8);text-decoration: none;}
a:visited {color: rgba(255, 255, 255, 0.8);text-decoration: none;}
a:hover {color: #F69;text-decoration: none;}
a:active {color: #F36;text-decoration: none;}

#b_fn {color:#<?PHP if(isset($_GET['ve'])){echo $fnc;}else{echo"FFFFFF";} ?>; text-transform:uppercase;font-size: 30px;}
#b_ln {color:#<?PHP if(isset($_GET['ve'])){echo $lnc;}else{echo"FFFFFF";} ?>; text-transform:uppercase;font-size: 31px;}
#b_ea {color:#<?PHP if(isset($_GET['ve'])){echo $eac;}else{echo"FFFFFF";} ?>; text-transform:uppercase;font-size: 23px;}
#b_ap {color:#<?PHP if(isset($_GET['ve'])){echo $apc;}else{echo"FFFFFF";} ?>; text-transform:uppercase;font-size: 16px;}
#b_cn {color:#<?PHP if(isset($_GET['ve'])){echo $cnc;}else{echo"FFFFFF";} ?>; text-transform:uppercase;font-size: 16px;}
#b_ce {color:#<?PHP if(isset($_GET['ve'])){echo $cec;}else{echo"FFFFFF";} ?>; text-transform:uppercase;font-size: 14px;}

</style> 
<link rel='stylesheet' type='text/css' href='Stylesheet.css'>

<div id="error">
<div id='su_pan'>
<div align="center">
<form action="Register.php" method="post">
<h1 align="center" id="he_a"> SIGN UP</h1>

<?PHP
if(isset($_GET['ve'])){
echo "<div id='emsg' align='left'>";

#Comment: Displays the errors that occured when signing up if there were any incorrect fields
if($hea=="X"){}else{echo "<li>".$hea."</li></br>";}
if($heb=="X"){}else{echo "<li>".$heb."</li></br>";}
if($hec=="X"){}else{echo "<li>".$hec."</li></br>";}
if($hed=="X"){}else{echo "<li>".$hed."</li></br>";}
if($hee=="X"){}else{echo "<li>".$hee."</li></br>";}
if($hefa=="X"){}else{echo "<li>".$hefa."</li></br>";}
if($hefb=="X"){}else{echo "<li>".$hefb."</li></br>";}
echo"</div><br><br>";}else{}

#Comment: The form will also automatically fill out the form with any previously entered information if there was an error and you were redirected back to this page.
?>

<table width="500px" border="0">
  <tr>
    <td width="208" height="40" valign="middle"  align="left"><p id="b_fn"><b>First Name:</b></p></td>
    <td width="272" align="right"><input id="textbox" type="text" name="first_name" <?PHP if(isset($_GET['ve'])){echo "value=".$gfn."";}else{} ?> /></td>
  </tr>
  <tr>
    <td height="40" valign="middle"  align="left"><p id="b_ln"><b>Last Name:</b></p></td>
    <td align="right"><input id="textbox" type="text" name="last_name" <?PHP if(isset($_GET['ve'])){echo "value=".$gln."";}else{} ?> /></td>
  </tr>
  <tr>
    <td height="40" valign="middle"  align="left"><p id="b_ea"><b>E-mail Adress:</b></p></td>
    <td align="right"><input id="textbox" type="email" name="email" <?PHP if(isset($_GET['ve'])){echo "value=".$gea."";}else{} ?>/></td>
  </tr>
  <tr>
    <td height="40" valign="middle"  align="left"><p id="b_ap"><b>Account &nbsp; Password:</b></p></td>
    <td align="right"><input id="textbox" type="password" name="password" <?PHP if(isset($_GET['ve'])){echo "value=".$gap."";}else{} ?> /></td>
  </tr>
   <tr>
    <td height="40" valign="middle"  align="left"><p id="b_cn"><b>Credit Card Number:</b></p></td>
    <td align="right"><input id="textbox" type="text" name="credit_card_num" maxlength="16" <?PHP if(isset($_GET['ve'])){echo "value=".$gcn."";}else{} ?>/></td>
  </tr>
  <tr>
    <td height="40" valign="middle"  align="left"><p id="b_ce"><b>Credit Card Expiry Date:</b></p></td>
    <td align="right">
    <?PHP
	
	#Comment: Automatically creates the drop down meny for the months and years instead of manually entering tons of years in a row.
    echo"<label id='caption_a'><b>MONTH:</b></label> <select name='cce_m' id='input'>";
		if(isset($_GET['ve'])){if($gccem=="X"){}else{echo "<option value=".$gccem.">".$gccem."</option>";}}else{}
		echo"<option value='X'>SELECT</option>";
		for($q=1;$q<=12;$q++){echo"<option value=".$q.">".$q."</option>";}echo"</select>&nbsp;";
    echo"<label id='caption_a'><b>YEAR:</b></label> <select name='cce_y' id='input'>";
		if(isset($_GET['ve'])){if($gccey=="X"){}else{echo "<option value=".$gccey.">".$gccey."</option>";}}else{}
		echo"<option value='X'>SELECT</option>";
		for($s=2014;$s<=2030;$s++){echo"<option value=".$s.">".$s."</option>";} echo"</select>";
    ?>
    </td>
  </tr>
  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr align="right"><td></td><td><input id="submit" type="submit" name="submit" value="SIGN UP"></td></tr>
</table>
<br><br>
<a align="center" href="Main.php"> RETURN </a>
</form> 
</div>
</div>
</div>

</html>