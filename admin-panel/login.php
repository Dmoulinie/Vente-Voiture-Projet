<?php
try {
    include("../dbConnexion.php");
} catch (PDOException $e) {
    echo("Erreur : " . $e ->getMessage());
}


try {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = hash('sha256',$_POST['password']);
        $req = $conn->prepare("select * from admin where username= :username AND password= :password");
        $req->bindParam('username', $username, PDO::PARAM_STR);
        $req->bindValue('password', $password, PDO::PARAM_STR);
        $req->execute();
        $count = $req->rowCount();
        if ($count == 1) {
			session_start();
			$_SESSION['login'] = $_POST['username'];
			die(header("Location:home.php"));
		} else {
            die(header("Location:admin-login.php?error=true&reason=invalid"));
        }
    } else {
        die(header("Location:admin-login.php?error=true&reason=champvide"));
        
    }
    
} catch (Exception $e) {
    echo($e->getMessage()); 
}
?>