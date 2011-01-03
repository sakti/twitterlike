<?php
require_once("inc/auth.php");
require_once("inc/connection.php");
cekAuth("pindah");
$_SESSION['error']="";
if(!empty($_POST['tmbmasuk'])){
    $valid=true;
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    if(!empty($username)&&!empty($password)){
        if(false!==strpos($username," ")){
            $_SESSION['error'].="Username tidak boleh ada spasi<br/>";
            $valid=false;
        }
        if($valid){
            $password=md5($password);
            $sql="SELECT * FROM user WHERE username='$username' and password='$password'";
            $hasil=mysql_query($sql);
            $jml=mysql_num_rows($hasil);
            if($jml==1){
                $data=mysql_fetch_assoc($hasil);
                $_SESSION['error']="selamat anda berhasil";
                $_SESSION['username']=$data['username'];
                header("Location: home.php");
                die();
            }else{
                $_SESSION['error']="Username atau password anda tidak valid";
            }
        }
    }else{
        $_SESSION['error'].="isi form dengan benar";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Twitter Like : Masuk</title>
        <link rel="stylesheet" href="gaya.css" type="text/css" />
        <style type="text/css">
        </style>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <a id="logo" href="/"><img src="images/logo.png"></a>
                <ul id="nav" class="round">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="daftar.php">Daftar</a></li>
                    <li><a href="masuk.php">Masuk</a></li>
                    <li><a href="tentang.php">Tentang</a></li>
                </ul>
            </div>
            <div id="wrap" class="round">
                <div id="frontpage" class="round">
                    <h1>Masuk</h1>
                    <?php if(!empty($_SESSION['error'])): ?>
                    <p class="error"><?php echo $_SESSION['error']; ?></p>
                    <?php 
                        $_SESSION['error']="";
                        endif;
                     ?>
                    <form id="masuk" name="masuk" action="masuk.php" method="POST">
                        <fieldset class="round">
                            <legend>Masukkan username dan password</legend>
                            <label for="username">Username</label><input type="text" id="username" name="username" size="25" maxsize="30" value="<?php echo (empty($username))?'':$username; ?>" required autofocus/>
                            <label for="password">Password</label><input type="password" id="password" name="password" size="25" required/>
                        </fieldset>
                        <input type="submit" class="tombol" name="tmbmasuk" id="tmbmasuk" value="Masuk">
                    </form>                    
                </div>
            </div>
            <div id="footer" class="round">&copy;2010 for education purpose only <a href="http://saktidwicahyono.blogspot.com">Contact</a></div>
        </div>
    </body>
    <script type="text/javascript">
    </script>
</html>
