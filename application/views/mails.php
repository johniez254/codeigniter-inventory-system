<?php
$password='admin';
$salt = sha1(rand());
     $salt = substr($salt, 0, 10);
	 //echo $salt;
	 $encrypted = password_hash($password.$salt, PASSWORD_DEFAULT);
     $hash = array("salt" => $salt, "encrypted" => $encrypted);
	 
	 $encrypted_password = $hash["encrypted"];
	$salt = $hash["salt"];

     //return $hash;
	 
	
	echo $encrypted_password;
	echo'<br>';
	$x=$password.$salt;
		echo'<br>';
		echo $x;
		echo $salt;
		echo'<br>';
	//echo password_verify ($password, $hash);
	if(password_verify ($x, $encrypted_password)){
		echo 'valid';
	}
	else{
		echo 'ivalid';}
	
	echo password_hash("menza", PASSWORD_DEFAULT)."\n";
	$hash = '$2y$10$FwSnwqyh2UVxEAZeO1YaOO62MHe21LcPoy.T23ciN1hzDAOg1xvf2';
	if (password_verify('rasmuslerdorf', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>
<form action="<?php echo base_url().'main/sendMail' ?>" method="post">
<input type="text" name="message" />
<input type="submit" value="send" />
</form>


