<?php 
session_start();
require "src/Form.php";
require "src/User.php";

$form = new Form;
if ($form->emptyData($_POST, $_FILES)) {
	$_SESSION["error"] = "Empty data not accepted";
	header("Location: index.php");
	exit;
}
if (!$form->validEmail($_POST["email"])) {
	$_SESSION["error"] = "Please enter a valid email address";
	header("Location: index.php");
	exit;
}

if (!$form->isEmailUnique($_POST["email"])) {
	$_SESSION["error"] = "This email is already taken";
	header("Location: index.php");
	exit;
}

if (!$form->checkFileSize($_FILES['picture'], 1000000)) {
	$_SESSION["error"] = "Max picture size is 1MB";
	header("Location: index.php");
	exit;
}

if (!$form->checkFileType($_FILES["picture"], "image/png")) {
	$_SESSION["error"] = "Accepted picture type is PNG";
	header("Location: index.php");
	exit;
}

$form->uploadFile($_FILES['picture'], "uploads/");
$user = new User($form->pdo);
if(!$user->create($_POST)) {
	$_SESSION["error"] = "Error, please try again ☹️";
	header("Location: index.php");
	exit;
}
$_SESSION["success"] = "congratulations ! 🥳";
header("Location: index.php");