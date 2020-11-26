<!doctype html>
<html>
	<head>
		<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php if(isset($_COOKIE["login"]) and isset($_COOKIE["password"])):?>
			Welcome, <?= $_COOKIE["login"]?> <button id="unauth">exit</button>
			<div class="msg-list">

			</div>
			<script src="../js/unauth.js"></script>
		<?php else: ?>
			You must enter or register:
			<form action="classes/IndexM.php" method="post">
				Login<br>
				<input name="login"><br>
				Password<br>
				<input name="password" type="password"><br>
				<button type="submit">Enter</button>
			</form>
			<?php
			if(isset($_SESSION["wrong-pass"]))
			{
			    echo "Wrong login or password";
			    unset($_SESSION["wrong-pass"]);
			};?>

		<?php endif;?>
	</body>
</html>