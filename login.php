<?php 

require_once("koneksi.php");

if(isset($_POST['masuk'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($password, $user["password"])){
            // buat Session
            session_start();
            $_SESSION["user"] = $user;
            // login sukses, alihkan ke halaman timeline
            header("Location: index.php");
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
          <h1>Login</h1>
            <form method="POST" action="">

                <input name="tujuan" type="hidden" value="LOGIN" >

                <label>Username</label>
                <br>
                <input name="username" type="text">
                <br>
                <label>Password</label>
                <br>
                <input name="password" type="password">
                <br>
                <br>
                <input type="submit" name="masuk" value="Login">
                
                <p> Belum punya akun?
                  <a href="register.php">Daftar di sini</a>
                </p>
            </form>
        </div>
    </body>
</html>