<?php

	switch($page) {
		
				
		case 'dashboard':
		break;
				
		case 'pages':
		
			if(isset($_POST['submitted']) == 1) {
				// Dealing with characters in string that break the query
				$title = mysqli_real_escape_string($dbc, $_POST['title']);
				$label = mysqli_real_escape_string($dbc, $_POST['label']);
				$header = mysqli_real_escape_string($dbc, $_POST['header']);
				$body = mysqli_real_escape_string($dbc, $_POST['body']);
			
				if (isset($_POST['id']) && $_POST['id'] != '') {
					$action = 'updated';
					$q = "UPDATE pages SET user = $_POST[user], slug = '$_POST[slug]', title = '$title', label = '$label', header = '$header', body = '$body' WHERE id = $_GET[id]";
				} else {
					$action = 'added';
					$q = "INSERT INTO pages (user, slug, title, label, header, body) VALUES ($_POST[user], '$_POST[slug]', '$title', '$label', '$header', '$body')";
				}
			
				$r = mysqli_query($dbc, $q);
				
				if($r) {
					
					$message = '<p class="bg-success">Page was '.$action.'</p>';
				
				} else {
				
					$message = '<p class="bg-danger">Page could not be '.$action.' because: '.mysqli_error($dbc);
					$message .= '<p class="bg-warning">Query: '.$q.'</p>';
				}
			}
			
			if(isset($_GET['id'])) { $opened = data_page($dbc, $_GET['id']); }
		
		break;
		
		case 'users':
		
			if(isset($_POST['submitted']) == 1) {
				
				$first = mysqli_real_escape_string($dbc, $_POST['first']);
				$last = mysqli_real_escape_string($dbc, $_POST['last']);
				
				if($_POST['password'] != '') {
					
					if($_POST['password'] == $_POST['passwordv']) {
						
						$password = " password = SHA1('$_POST[password]'),";
						$verify = true;
					
					} else {
						
						$verify = false;
					
					} else {
						
						$verify = false;
						
					}
										
				}
				
				if (isset($_POST['id']) != '') {
					
					$action = 'updated';
					$q = "UPDATE users SET first = '$first', last = '$last', $password status = $_POST[status] WHERE id = $_GET[id]";
					
				} else {
					
					$action = 'added';
					if($verify == true) {
						$q = "INSERT INTO users (first, last, password, status) VALUES ('$first', '$last', SHA1('$_POST[password]'), '$_POST[status]')";
					} 
					
					
				}
			
				$r = mysqli_query($dbc, $q);
				
				if($r) {
					
					$message = '<p class="bg-success">User was '.$action.'</p>';
				
				} else {
				
					$message = '<p class="bg-danger">User could not be '.$action.' because: '.mysqli_error($dbc);
					if($verify == false) {
						$message .= '<p class="bg-danger">Password fields empty and/or do not match.</p>';
					}
					$message .= '<p class="bg-warning">Query: '.$q.'</p>';
				}
			}
		
			if(isset($_GET['id'])) { $opened = data_user($dbc, $_GET['id']); }
		
		break;
		
		case 'settings':
		break;
		
		default:
		break;

	}



?>