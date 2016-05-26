<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SentiWord Mining</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sentinesia - Mining your text value">
    <meta name="keywords" content="sentiword, text mining, sentinesia, sentiword">
    <meta name="author" content="Endang W.P, Albert S (AxQuired24), Mawan B">	
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/dashboard.css">
	<script type="text/javascript" src="assets/js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		include ( "./koneksi.php" );
		include ( "./view/navbar.php" );
		// include ( "./view/try.php" );
		$page = $_GET[p];
		if(isset($page))
		{
			include ( "./view/".$page.".php" );
		}
		else
		{
			include ( "./view/home.php" );
		}
	?>
</body>
</html>