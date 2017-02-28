<?PHP

#===============================================#

#File: Register.php
#Function: Gets the user's signup information from the sign up page and will process it determining if there is anything wrong with the format entered for each field.

#===============================================#

#Comment: Gets the information from the sign up form
if(isset($_POST['submit'])){
	$fname=$_POST['first_name'];
	$lname=$_POST['last_name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$ccn=$_POST['credit_card_num'];
	$ccem=$_POST['cce_m'];
	$ccey=$_POST['cce_y'];
	$cmonth=date("n");
	$cyear=date("Y");
	
	/*#Comment: Removes any excess spaces "such as     like   this" and also checks to see if the infomation follows the current format: 
		- All fields are filled
		- There only letters in the first and last name fields (No numbers or symbols)
		- The email is in the correct format: x@y.z
		- The password is at least 6 symbols long
		- The credit card number is exactly 16 numbers long and only consists of numbers
		- The credit card is not expired (entering an expiry date from any date from the past.)
		
		Any field that does not follow this format becomes an error
	*/
	
	if(!ctype_alpha(trim($fname))){$error_a="ea=no&first_name='".$fname."'";$ea=true;}else{$error_a="ea=yes&first_name='".$fname."'";$ea=false;}
	if(!ctype_alpha(trim($lname))){$error_b="eb=no&last_name='".$lname."'";$eb=true;}else{$error_b="eb=yes&last_name='".$lname."'";$eb=false;}
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)){$error_c="ec=no&email='".$email."'";$ec=true;}else{$error_c="ec=yes&email='".$email."'";$ec=false;}
	if (strlen($password)<=5){$error_d="ed=no&password='".$password."'";$ed=true;}else{$error_d="ed=yes&password='".$password."'";$ed=false;}
	if (strlen($ccn)!=16 or !ctype_digit($ccn)){$error_e="ee=no&credit_card_num='".$ccn."'";$ee=true;}else{$error_e="ee=yes&credit_card_num='".$ccn."'";$ee=false;}
	if($ccem=="X" or $ccey=="X"){$error_fa="efa=no&ccem=".$ccem."&ccey=".$ccey."";$efa=true;}else{$error_fa="efa=yes&ccem=".$ccem."&ccey=".$ccey."";$efa=false;}
	if($efa==false){if($ccey<$cyear or ($ccey<=$cyear && $ccem<=$cmonth)){$error_fb="efb=no&ccem=".$ccem."&ccey=".$ccey."";$efb=true;}else{$error_fb="efb=yeso&ccem=".$ccem."&ccey=".$ccey."";$efb=false;}}else{}
	
	#Comment: Checks to make sure there are no errors in the entered data
	if($ea==false and $eb==false and $ec==false and $ed==false and $ee==false and $efa==false and $efb==false){
		
	#If everything is good, the user gets signed up and their information get stored into the database under the customers section and is redirected back to the main login page.
	$cce=$ccem."/".$ccey;	
	$db=mysql_connect("localhost","root","root") or die('Not connected : ' . mysql_error());
	mysql_select_db("ticket") or die (mysql_error()); 
	$SQL="INSERT INTO `customers`(`id`, `last_name`, `first_name`, `email`, `password`, `credit_card_num`, `credit_card_expiry_date`) VALUES (NULL,'".$lname."','".$fname."','".$email."','".$password."','".$ccn."','".$cce."')";
	$result=mysql_query($SQL) or die(mysql_error());
	header("Location: Main.php?created");exit();}
	
	#Comment: If there is an error in any of the fields, it's flagged and all the user's data is sent back to the sign up page. The sign up page will automatically fill in what the user had already previously entered and also display what errors are present with the info they provided.
	else{header("Location: SignUp.php?ve&".$error_a."&".$error_b."&".$error_c."&".$error_d."&".$error_e."&".$error_fa."&".$error_fb."");exit();}
	}
	
#Comment: If someone tries to access this page manually by entering it in the URL, they're redirected back to the main login page.
else{header("Location: Main.php");exit();}

?>