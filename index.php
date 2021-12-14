<? session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CELEC Project 01</title>
	<style type="text/css">
		input {
			margin: 1%;
		}
		.err {
			padding: 1%;
			background-color: #ffa6b5;
			border-radius: 7px;
			width: 10%;
		}

		.suc {
			padding: 1%;
			background-color: #b2eda4;
			border-radius: 7px;
			width: 10%;
		}
	</style>
</head>
<body>
	<center>
		<? if(isset($_SESSION["error"])): ?>
			<div class="err">
				<h4><? echo $_SESSION["error"]; ?></h4>
			</div>
		<? endif; ?>
		<? if(isset($_SESSION["success"])): ?>
			<div class="suc">
				<h4><? echo $_SESSION["success"]; ?></h4>
			</div>
		<? endif; ?>
		<form method="POST" action="handler.php" enctype="multipart/form-data">
			<input type="text" name="username" placeholder="username">
			<br/>
			<input type="text" name="email" placeholder="email">
			<br/>
			<input type="text" name="password" placeholder="password">
			<br/>
			<input type="file" name="picture">
			<br/>
			<button type="submit" style="padding: 10px; color: white; border-radius: 5px; background-color: cornflowerblue; border: 1px solid white; cursor: pointer;">Save</button>
		</form>
	</center>
</body>
</html>
<?php unset($_SESSION["error"], $_SESSION["success"]); ?>