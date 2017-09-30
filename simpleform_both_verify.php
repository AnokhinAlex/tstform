<?php
 session_start();
 header('Content-Type: text/html; charset=utf-8');
 require('db/db.php');
 if (!empty($_POST["sender"]) or !empty($_POST["enter"]) or !empty($_POST["destroy"])){	 
 require('inc/validate.php');
    header("Location: ".$_SERVER["REQUEST_URI"]);
    exit;
  } 
?>
    <!doctype html>
    <html>

    <head>
        <title>Авторизация</title>
        <meta http-equiv="Content-Style-Type" content="text/css">
        <meta name="keywords" content="Ключевые слова для поисковиков">
        <meta name="description" content="Описание сайта">
        <link href="css/style.css" rel="stylesheet" media="all">
        <link href="css/font-awesome.min.css" rel="stylesheet" media="all">
        <script src="js/jquery-3.2.1.min.js"></script>
    </head>

    <body>
        <?php
    if (empty($_SESSION['logged']))
    {
?>
            <div class="container">
                <div class="left-block">
                    <div class="form_wrapper">
                        <div class="form_container">
                            <div class="title_container">
                                <h2>Login Please</h2> </div>
                            <div class="row clearfix">
                                <div class="">
                                    <form name="loginplease" id="" action='' method="post">
                                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-id-card-o"></i></span>
                                            <input type="text" name="login_field" placeholder="Email or Login" value="<?php echo $_SESSION['tmp_loginfield_holder']; ?>" /> </div>
                                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                            <input type="password" name="password_field" placeholder="Your Password" /> </div>
                                        <input class="button" type="submit" value="Enter" name="enter" /> </form>
                                    <p class="pcenter">Or</p>
                                    <input id="show" class="button" type="submit" value="Show" /> </div>
                                <div> </div>
                            </div>
                        </div>
                    </div>
                    <div class="error-log form_wrapper">
                        <h2 class="pcenter">Inform</h2>
                        <?php
if ($_SESSION['err']){
	if($_SESSION['err']){
	foreach($_SESSION['err'] as $value){
		echo "<p> $value </p>" . "<br>";
	}
}
$_SESSION['err'] = "";
}
?>
                    </div>
                </div>
                <div class="right-block">
                    <div id="content" class="form_wrapper">
                        <div class="form_container">
                            <div class="title_container">
                                <h2>Registration Form</h2> </div>
                            <div class="row clearfix">
                                <div class="">
                                    <form method="post" action="">
                                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                            <input type="email" name="email" value="<?php echo $_SESSION['form_email_holder']; ?>" placeholder="Email" required /> </div>
                                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-address-card"></i></span>
                                            <input type="text" name="login" value="<?php echo $_SESSION['form_login_holder']; ?>" placeholder="Login" required /> </div>
                                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                            <input type="password" name="password" placeholder="Password" required /> </div>
                                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                            <input type="password" name="password_retype" placeholder="Re-type Password" required /> </div>
                                        <div class="row clearfix">
                                            <div class="col_half">
                                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                                    <input type="text" name="firstname" value="<?php echo $_SESSION['form_firstname_holder']; ?>" placeholder="First Name" required /> </div>
                                            </div>
                                            <div class="col_half">
                                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                                    <input type="text" name="lastname" value="<?php echo $_SESSION['form_lastname_holder']; ?>" placeholder="Last Name" required /> </div>
                                            </div>
                                        </div>
                                        <div class="input_field select_option select_option_m">
                                            <p class="pcenter"> Birthday date </p>
                                            <select name="day">
                                                <?php
												   $i = 1;
												   while($i<32){
													 echo "<option value='".$i. "'>" . "$i</option>";
													 $i++;
												   }
												   ?>
                                            </select>
                                            <select name="month">
                                                <?php
												   $month = ["January","February","March","April", "May", "June","July","August","September","October","November", "December"];
												   foreach($month as $value){
													 echo "<option value='".$value. "'>" . "$value</option>";
													 $i++;
												   }
												   ?>
                                            </select>
                                            <select name="year">
                                                <?php
												   $i = 1970;
												   while($i<2000){
													 echo "<option value='".$i. "'>" . "$i</option>";
													 $i++;
												   }
												   ?>
                                            </select>
                                            <div class="select_arrow"></div>
                                        </div>
                                        <div class="input_field select_option">
                                            <select name="countries">
                                                <?php
												  $result = $pdo->query("SELECT country FROM `countries`");
									   
													while ($row = $result->fetch()) {
													  echo "<option value='".$row['country']."'>{$row['country']}</option>";
													}
													
												  ?>
                                            </select>
                                            <div class="select_arrow"></div>
                                        </div>
                                        <div class="input_field checkbox_option">
                                            <div class="agreement"> THIS AMENDMENT NO. 8 TO LICENSE AND SERVICE AGREEMENT ("Amendment") is entered into as of the 16th day of November, 2009 and amends the License and Service Agreement dated as of the 19th day of March, 2008 ("Agreement"), by and between TELENAV, INC., a corporation incorporated under the laws of the State of Delaware, having its principal place of business at 1130 Kifer Road, Sunnyvale, CA 94086 ("LICENSOR"), and AT&T MOBILITY LLC, a Delaware limited liability company, having a place of business at 5565 Glenridge Connector Atlanta, GA 30342 ("AT&T"). Capitalized terms not otherwise defined herein will have the meanings ascribed to them in the Agreement. RECITALS WHEREAS, the parties have amended the Agreement by the: 1. First Amendment, dated as of November 13, 2008; 2. Second Amendment, dated as of November 20, 2008; 3. Fourth Amendment, dated as of June 16, 2009; 4. Sixth Amendment, dated as of October 13, 2009; 5. Seventh Amendment, dated as of October 27, 2009; and </div>
                                            <input type="checkbox" id="cb2" name="term" value="agree">
                                            <label for="cb2">Term of use</label>
                                        </div>
                                        <input class="button" type="submit" value="Register" name="sender" /> </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
			}else{
				echo "<div class='container'>";  
					echo "<div class='form_wrapper logged'>";
							echo "<h2 class='pcenter'>Personal information </h2>";
							echo "<p> Your email: " . $_SESSION['entered_email'] . "</p>" . "<br>";
							echo "<p> Your login: " . $_SESSION['entered_login'] . "</p>" . "<br>";
							echo "<p> Registration date: " . $_SESSION['entered_date'] . "</p>" . "<br>";
							echo "<p> Your Country: " .	$_SESSION['entered_country'] . "</p>" . "<br>";
							echo	"<form method='post' action=''>";
							echo	"<input class='button' type='submit' value='Logout' name='destroy'/>";
							echo    "</form>";
				echo "</div>";
			echo "</div>";
			}
		  ?>
    </body>
    <script>
        $(document).ready(function () {
            $("#show").click(function () {
                if ($("#content").is(":hidden")) {
                    $("#content").show("fast");
                }
                else {
                    $("#content").hide("fast");
                }
                return false;
            });
        });
    </script>

    </html>