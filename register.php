<?php
require_once("koneksi.php");

if(isset($_POST['register'])){
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    $sql = "INSERT INTO users (nama, username, password, email) 
            VALUES (:nama, :username, :password, :email)";
    $stmt = $db->prepare($sql);

   
    $params = array(
        ":nama" => $nama,
        ":username" => $username,
        ":password" => $password,
        ":email" => $email
    );

    $saved = $stmt->execute($params);

    
    if($saved) header("Location: login.php");
}


?>

<!DOCTYPE html>
<head>
        <title>REGISTRASI</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <div class="container">
          <h1>Daftar</h1>
            <form method="POST" action="">

                <input type="hidden" name="tujuan" value="DAFTAR">

                <br>
                <label>Nama</label>
                <br>
                <input name="nama" type="text">
                <br>
                <label>Username</label>
                <br>
                <input name="username" type="text">
                <br>
                <label>Password</label>
                <br>
                <input name="password" type="password">
                <br>
                <label>Email</label>
                <br>
                <input name="email" type="text">
                <br>
                <br>
                <input type="submit" name="register" value="Daftar">
                <p> Sudah punya akun?
                  <a href="login.php">Login di sini</a>
                </p>
            </form>
        </div>
    </body>
</html>