<?php

    $host = 'localhost';
	$db= 'final_database';
	$user = 'root';
	$pass = '';
	$charset = 'utf8';

	$dsn= "mysql:host=$host;dbname=$db;charset=$charset";
	
	$opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false,];
    $pdo= new PDO($dsn, $user, $pass, $opt);
    

    function signup($pdo,$data=[]) {
        //sanitize
        $data[0] = filter_var($data[0], FILTER_SANITIZE_EMAIL);
	    $data[1] = filter_var($data[1], FILTER_SANITIZE_STRING);
		$data[2] = filter_var($data[2], FILTER_SANITIZE_STRING);
        
        //encrypt password
        $data[2] = password_hash($data[2], PASSWORD_DEFAULT);
        
        //see if email already exists
        $query = $pdo->prepare('SELECT * from user WHERE email = "'.$data[0].'"');
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        //if it does, then it fails
        if($result){
            die('Email already exists');
        }

        //otherwise, we insert it into the table
        $query = $pdo->prepare('INSERT INTO user(email, username, password) VALUES (?,?,?)');
        $query->execute($data);
        
        // Log user in when after sign up.
        session_start();
        $query = $pdo->prepare('SELECT * from user WHERE email = "'.$data[0].'"');
        $query->execute();
        $_SESSION['userID'] = $query->fetch(PDO::FETCH_ASSOC)["userID"];
        
        // redirect after sign in
        header('location: index.php');
    }
    
    function signin($pdo,$data=[]) {
        
        //sanitize
    
        $data[0] = filter_var($data[0], FILTER_SANITIZE_EMAIL);
	    $data[1] = filter_var($data[1], FILTER_SANITIZE_STRING);


        //finds email
        $query = $pdo->prepare('SELECT * from user WHERE email = "'.$data[0].'"');
        $query->execute();
        
        $result = $query->fetch(PDO::FETCH_ASSOC);

        //if it cant find the email, it fails
        if(!$result){
            die('Email not found.');
        }

        //otherwise, continue
        $testemail = $result["email"];


        //finds password
        $query = $pdo->prepare('SELECT * from user WHERE email = "'.$data[0].'"');
        $query->execute();
        $testpassword = $result["password"];

        //checks the email and password        
        if ($data[0] == $testemail and password_verify($data[1],$testpassword)) {
            //log in after sign in
            session_start();
            $query = $pdo->prepare('SELECT * from user WHERE email = "'.$data[0].'"');
            $query->execute();
            $_SESSION['userID'] = $result["userID"];
            header('location: index.php');
        }
        else {
            die('Incorrect password.');
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
    function accountdetails($pdo,$data)
    {
        $query = $pdo->prepare('SELECT * from user WHERE userID = "'.$data[0].'"');
        $query->execute();
        return $result = $query->fetch(PDO::FETCH_ASSOC);
    }
    function changepassword($pdo,$data) {
        //check if passwords are the same
        if ($data[1] == $data[2]) {
            //finds userID
            $query = $pdo->prepare('SELECT * from user WHERE userID="'.$data[0].'"');
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            //if it cant find the user, it fails
            if(!$result){
                die('Error. User not found.');
            }

            //otherwise, continue

            $data[1] = password_hash($data[2], PASSWORD_DEFAULT);

            $sql='UPDATE user SET password=? WHERE userID=?';
            $query= $pdo->prepare($sql);
            $query->execute([$data[1],$_SESSION['userID']]);
            header('location: index.php');
        }
        else {
            die('Passwords were not the same.');
        }
    }
    function deleteaccount($pdo,$data){
        $sql='DELETE from user WHERE userID=?';
        $query= $pdo->prepare($sql);
        $query->execute([$_SESSION['userID']]);
        signout();
    }
    function recipeAdd($pdo,$data=[]){
        //sanitize
        $data[1] = filter_var($data[1], FILTER_SANITIZE_NUMBER_INT);
        $data[2] = filter_var($data[2], FILTER_SANITIZE_STRING);
        $data[3] = filter_var($data[3], FILTER_SANITIZE_NUMBER_INT);
        $data[4] = cleanData($data[4]);
        $data[5] = filter_var($data[5], FILTER_SANITIZE_STRING);
        $data[6] = filter_var($data[6], FILTER_SANITIZE_NUMBER_INT);
        $data[7] = filter_var($data[7], FILTER_SANITIZE_STRING);

        $query = $pdo->prepare('INSERT INTO recipe(userID, recipeID, recipeName, timeCooked, instructions, ingredient, numMeasure, catMeasure) VALUES (?,?,?,?,?,?,?,?)');
        $query->execute($data);

        // redirect after sign in
        echo "<script type='text/javascript'>alert('Your Recipe has been added!');window.location.href = 'index.php';</script>";
    }

    function cleanData($str) {
        $str = urldecode ($str );
        $str = filter_var($str, FILTER_SANITIZE_STRING);
        $str = filter_var($str, FILTER_SANITIZE_SPECIAL_CHARS);
        return $str ;
    }
?>