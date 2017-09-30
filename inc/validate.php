<?php
require('functions.php');
if($_SERVER['REQUEST_METHOD']=='POST'){
	if($_POST['destroy'] == "Logout"){
		//session_destroy();
		$_SESSION['logged'] = "";
		session_unset();
	}
}
if($_SERVER['REQUEST_METHOD']=='POST'){
	$_SESSION['err'] = NULL;
	if($_POST['sender'] == "Register"){
	//$_SESSION['err'] = NULL;
	$errors =[];
	if ($_POST['email']){
		$_SESSION['form_email_holder'] = $_POST['email'];
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			if(!check_email($_POST['email'])){
				$email = $_POST['email'];
			}else{
				$errors[] = "user with this email is already registered";
			}
		}else{
			$errors[] = $_POST["email"] . " - this is not email ";			
			}
	}else{
		$errors[] = "Enter email";
	}
	if($_POST['login']){
		$_SESSION['form_login_holder'] = $_POST['login'];
		$str = $_POST['login'];
		if (preg_match("#^[aA-zZ0-9\-_]+$#",$str)) {
		   if(!check_login($str)){
				$login = $str;
			}else{
				$errors[] = "user with this login is already exist";
			}
		} else {
			$errors[] = "There are illegal characters in the login";

		}
		
	}else{
		 $errors[] = "Enter login";
	}
	if($_POST['password']){
		$str = $_POST['password'];
		if (preg_match("#^[aA-zZ0-9\-_]+$#",$str)) {
		   $password1 = $str;
		   
		} else {
			$errors[] = "There are illegal characters in the password";
		   
		}
		
	}else{
		$errors[] = "Enter password";
	}
	if($_POST['password_retype']){
		$str = $_POST['password_retype'];
		if ($str == $password1){
			$password_verified = $password1;
		}else{
		$errors[] = "Passwords do not match";
	}
	}
	$_SESSION['err'] = $errors;
	
	if($_POST['firstname']){
		$_SESSION['form_firstname_holder'] = $_POST['firstname'];
		$str = $_POST['firstname'];
		if (preg_match("#^[aA-zZ0-9\-_]+$#",$str)) {
		   $firstname = $str;
		   
		} else {
			$errors[] = "There are illegal characters in the firstname";
		}
		
	}else{
		$errors[] = "Enter firstname";
	}
		if($_POST['lastname']){
		$_SESSION['form_lastname_holder'] = $_POST['lastname'];	
		$str = $_POST['lastname'];
		if (preg_match("#^[aA-zZ0-9\-_]+$#",$str)) {
		   $lastname = $str;
		   
		} else {
			$errors[] = "There are illegal characters in the lastname";
		}
		
	}else{
		 $errors[] = "Enter lastname";
	}
	if($_POST['day']){
		$day = $_POST['day'];		
	}	
	if($_POST['month']){
		$month = $_POST['month'];		
	}
	if($_POST['year']){
		$year = $_POST['year'];		
	}	
	if($_POST['countries']){
		$country = $_POST['countries'];		
	}
	if($_POST['term']){
		if($_POST['term'] == "agree"){
			$agree = $_POST['term'];
		}else{
			$errors[] = "the user's agreement is not accepted";
		}
	}else{
			$errors[] = "the user's agreement is not accepted";
		}	
	}
	
	if($_POST['enter'] == "Enter"){
		if($_POST['login_field'] != "" && $_POST['password_field'] != ""){
			$_SESSION['tmp_loginfield_holder'] = $_POST['login_field'];
			if(check_email($_POST['login_field'])){
				$user_email = $_POST['login_field'];
					if($user_email){
						list ($zero, $one, $two, $three) = check_user_email($_POST['login_field'], $_POST['password_field']);
							if($zero){
							$_SESSION['entered_email'] = $zero;
							$_SESSION['entered_login'] = $one;
							$_SESSION['entered_date'] = $two;
							$_SESSION['entered_country'] = $three;
							$_SESSION['logged'] = true;
							}else{
								$errors[] = "Incorrect password";
							}
					}
			}elseif(check_login($_POST['login_field'])){
				$user_login = $_POST['login_field'];
					if($user_login){
						list ($zero, $one, $two, $three) = check_user_login($_POST['login_field'], $_POST['password_field']);
							if($zero){
							$_SESSION['entered_email'] = $zero;
							$_SESSION['entered_login'] = $one;
							$_SESSION['entered_date'] = $two;
							$_SESSION['entered_country'] = $three;
							$_SESSION['logged'] = true;
							}else{
								$errors[] = "Incorrect password";
							}
					}
			}else{
				$errors[] = "User is not found. Do you want to register?";
			}			
		}else{
			$errors[] = "fill the fields";
		}

		
	}

			$_SESSION['err'] = $errors;
} // POST


if($email && $login && $password_verified && $firstname && $lastname && $day && $month && $year && $country && $agree){
	//echo "Данные валидны" . "$email && $login && $password_verified && $firstname && $lastname && $day && $month && $year && $country && $agree";
	$time = date("Y-m-d H:i:s");
	$timestamp = time();
	$birthday = $year . "-" . $month . "-" . $day;
	$hash = password_hash("$password_verified", PASSWORD_BCRYPT);
	$query = "INSERT INTO users (email, login, password, date, timestamp,country,birthday, firstname, lastname) VALUES(?,?,?,?,?,?,?,?,?)";
        $array = array("$email","$login","$hash","$time","$timestamp","$country","$birthday","$firstname","$lastname");
        execute_sql_query($query,$array);
		$_SESSION['entered_email'] = $email;
		$_SESSION['entered_login'] = $login;
		$_SESSION['entered_date'] = $time;
		$_SESSION['entered_country'] = $country;
		$_SESSION['logged'] = true;
}
?>