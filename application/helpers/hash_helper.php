<?php

function hash_password($password=NULL,$salt=NULL)
{
	if($password!=NULL && $salt!=NULL)
	{
		//echo $password;
		//echo "<br>";
		//echo $salt;
		//echo "<br>";
		$password_length = strlen($password);
		$split_at = ceil($password_length / 2);
		$password_array = str_split($password, $split_at);
		$hash = sha1($password_array[0] . $salt . $password_array[1]);
	
		return $hash;
	}
	else
		return NULL;
} 


?>