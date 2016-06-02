<?php include('config/setup.php'); ?>

<!doctype html>

<html>
	
	<head>
		
		<title><?php echo $page['title'].' | '.$site_title; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<?php include('config/css.php'); ?>
		
		<?php include('config/js.php'); ?>	
	
	</head>

	<body>

		<div id="wrap">

			<?php include(D_TEMPLATE.'/navigation.php'); 