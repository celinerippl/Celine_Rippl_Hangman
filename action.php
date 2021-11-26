<?php
require('inc/words.php');
$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$password_r = isset($_POST["password_r"]) ? $_POST["password_r"] : "";

if (!empty($password) and strcmp($password, $password_r) == 0 and !empty($firstname) and !empty($lastname) and !empty($email)) {
	$sql_select = "SELECT count(*) as user FROM user WHERE eMail = ?";
	$STH = $db->prepare($sql_select);
	$STH->execute([$email]);
	$result = $STH->fetch();
	if ($result["user"] == 0) {
		$sql = "INSERT INTO user (name, surname, eMail, password, hash) VALUES (?,?,?,?,?)";
		$db->prepare($sql)->execute([$firstname, $lastname, $email, $password, hash("sha256", $password)]);
		$result = array(

			"status" => "success"
		);
	}
	else {
		$result = array(

			"status" => "error",
			"message" => "Bitte füllen Sie alle Formularfelder aus"
		);
	}
} else {

	$result = array(

		"status" => "error",
		"message" => "Bitte füllen Sie alle Formularfelder aus"
	);
}

print json_encode($result);
