<html>

<!-- 
===============================================

#File: Main.php
#Function: Login page, sends the login details to the signin.php file to be processed.

===============================================
-->

<title>Log In</title>
<style> 
/* CSS Styling */

* {font-family: sans-serif;}
a:link {color: rgba(255, 255, 255, 0.8);text-decoration: none;}
a:visited {color: rgba(255, 255, 255, 0.8);text-decoration: none;}
a:hover {color: #F69;text-decoration: none;}
a:active {color: #F36;text-decoration: none;}
</style> 
<link rel='stylesheet' type='text/css' href='Stylesheet.css'>

<div id="signin">
<div id="main_pan">
<div align="center">
<form action="Signin.php" method="post">
<h1 align="center" id="he_a"> SIGN IN</h1>

<?PHP

#Comment: Login validation, displays the error if something is wrong like a missing username or incorrect password.

if(isset($_GET['created'])){
echo "<div align='left'>";
echo "<p align='center' id='msg_a'>Please sign in with your new account.</p>";
echo"</div>";}else{}
if(isset($_GET['blank'])){
echo "<div align='left'>";
echo "<p align='center' id='msg'>Please fill out all the fields.</p>";
echo"</div>";}else{}
if(isset($_GET['error'])){
echo "<div align='left'>";
echo "<p align='center' id='msg'>The username or password was incorrect.</p>";
echo"</div>";}else{}

?>

<!-- Comment: HTML structure -->

<table width="375" border="0">
  <tr>
    <td width="127" height="30" align="left"><p id="a_ee"><b>E-mail:</b></p></td>
    <td width="219" align="right"><input id="textbox" type="email" name="email" /></td>
  </tr>
  <tr>
    <td height="30" align="left"><p id="a_pp"><b>Password:</b></p></td>
    <td align="right"><input id="textbox" type="password" name="password" /></td>
  </tr>
  <tr>
    <td height="30" align="left"><p id="a_ss"><b>Sign-In As:</b></p></td>
    <td align="right"><select name="user" id="textbox"><option value="customers">CUSTOMER &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option><option value="admin">ADMIN</option></select></td>
  </tr>
  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr align="right"><td></td><td><input id="submit" type="submit" name="submit" value="SIGN IN"></td></tr>
</table>
<br><br>
<a align="center" href="SignUp.php"> CREATE A NEW ACCOUNT </a>
</form> 
</div>
</div>
</div>

</html>