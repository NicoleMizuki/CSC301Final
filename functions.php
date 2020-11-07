<?php
function signup($data, $userDatabaseFile, $bannedEmailsFile)
{
    if (isset($data['email'])) {

		// Check database and banned email CSV files exist.
		if(!file_exists($userDatabaseFile)) die('User database not found');
		if(!file_exists($bannedEmailsFile)) die('Banned emails database not found');

		$banned = fopen($bannedEmailsFile, 'r');

		// Look for empty fields. If found, tell user what field is empty and kill page.
		foreach($data as $d){
			if(empty($d)) die('Missing field: ' . ucfirst(key($data)));
			next($data);
		}

		// Check if user email is banned.
		while (!feof($banned)) {
			$line = explode(',', fgets($banned));
			if(trim($line[0]) == $data['email']) {
				die('This email is banned.');
			}
		}
		fclose($banned);


		$userDatabase = fopen($userDatabaseFile, 'r');	

		// Check if email already exists in the database.
		if($userDatabase){
			while (!feof($userDatabase)) {
				$line = explode(',', fgets($userDatabase));
				if(isset($line[1]) && trim($line[1]) == $data['email']) {
					die('This email is taken.');					
				}
			}
		}
		fclose($userDatabase);
	

		$userDatabase = fopen($userDatabaseFile, 'a');
		
		if($userDatabase){

			// Sanitize inputs.
			$data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
			$data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
			$data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);

			// Validate Email on server-side.
			if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) die('Invalid email');			

			// Check if any of the fields are empty.
			foreach($data as $d){
				if(empty($d)) die('Error signing up.');
			}

			// Hash the password so that it is stored securely in the database.
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

			// Put the data into the CSV.
			fputcsv($userDatabase, $data);

			session_start();
			
			// Log user in when after sign up.
			$_SESSION['userID'] = $data['email'];
			
			fclose($userDatabase);

			// Redirect user to the home page.
			header('location: index.php');

		} else {
			die('Failed to connect to database.');
		}
		
    }
}

function signin($data, $userDatabaseFile)
{
	if (isset($data['email'])) {

		// Sanitize email input.
		$data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);

		// Check if any of the fields are empty.
		foreach($data as $d){
			if(empty($d)) die('Missing field: ' . ucfirst(key($data)));
			next($data);
		}

		// Check if database CSV exists.
		if(!file_exists($userDatabaseFile)){
			die('Database not found');
		}

		$userDatabase = fopen($userDatabaseFile, 'r');
		
		if($userDatabase){
			// Looping through the user database CSV.
			while (!feof($userDatabase)) {
				$line = explode(',', fgets($userDatabase));
				// Check if the input email and the database email match.
				if (isset($line[1]) && $line[1] == $data['email']) {
					// Check if the input password and the database match.
					if(password_verify($data['password'], trim($line[2]))){
						fclose($userDatabase);
						session_start();
						// Set user to logged in.
						$_SESSION['userID'] = $data['email'];

						// Redirect user to the home page.
						header('location: index.php');
					} else {
						die('Wrong password');
					}
				}
			}
			die('The user does not exist.');

		} else {
			die('Failed to connect to database.');			
		}
    }
    
}

function signout()
{
	// Destroy the session so that the user is logged out.
	session_start();
	session_unset();
    session_destroy();
	header('location: index.php');
}
