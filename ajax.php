<?php

require('inc/words.php');

if (isset($_POST["email"]) and isset($_POST["password"])) {

	$sql = "SELECT hash FROM user WHERE eMail = ?";
	$STH = $db->prepare($sql);
	$STH->execute([$_POST["email"]]);
	$hash = $STH->fetch();
	if (hash("sha256", $_POST["password"]) == $hash["hash"]) {

		$result = array("status" => "success");
	} else {

		$result = array("status" => "Login nicht erfolgreich");
	}

	echo json_encode($result);
}
