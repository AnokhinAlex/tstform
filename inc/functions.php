<?php
function execute_sql_query($query,$array){
    global $pdo;
     try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($array);
     } catch(PDOException $e) {
    $reply = $e->getMessage();//Remove or change message in production code
	echo $reply;
    }
}
function check_email($email){
    global $pdo;
    $is_equal = false;
    
    $stmt = $pdo->query('SELECT email FROM users');
        while ($row = $stmt->fetch()){
            if($row['email'] == $email){
                $is_equal = true;
            }
        }
    return $is_equal;
}
function check_login($login){
    global $pdo;
    $is_equal = false;
    
    $stmt = $pdo->query('SELECT login FROM users');
        while ($row = $stmt->fetch()){
            if($row['login'] == $login){
                $is_equal = true;
            }
        }
    return $is_equal;
}
function check_user_email($email, $pass){
    global $pdo;
	//$stmt = $pdo->query("SELECT password FROM users WHERE email='$email'");
	$stmt = $pdo->prepare("SELECT password FROM users WHERE email=?");  
        $stmt->execute(array("$email"));
        while ($row = $stmt->fetch()){
            if($row['password']){
				$hashbd = $row['password'];
            }
        }
	if(password_verify($pass, $hashbd)){
		try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");  
        $stmt->execute(array("$email"));
	foreach ($stmt as $row){
			$mail = $row['email'];
			$login = $row['login'];
			$date = $row['date'];
			$country = $row['country'];			
		}
     } catch(PDOException $e) {
    $reply = $e->getMessage();//Remove or change message in production code
	echo $reply;
    }
	}
	if($mail && $login && $date && $country){
		return array($mail,$login,$date,$country);
	}else{
		return false;
	}
    
}
function check_user_login($login, $pass){
    global $pdo;
	$stmt = $pdo->prepare("SELECT password FROM users WHERE login=?");  
        $stmt->execute(array("$login"));
        while ($row = $stmt->fetch()){
            if($row['password']){
				$hashbd = $row['password'];
            }
        }
	if(password_verify($pass, $hashbd)){
		try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login=?");  
        $stmt->execute(array("$login"));
	foreach ($stmt as $row){
			$mail = $row['email'];
			$login = $row['login'];
			$date = $row['date'];
			$country = $row['country'];			
		}
     } catch(PDOException $e) {
    $reply = $e->getMessage();//Remove or change message in production code
	echo $reply;
    }
	}
	if($mail && $login && $date && $country){
		return array($mail,$login,$date,$country);
	}else{
		return false;
	}
    
}
?>