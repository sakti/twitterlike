<?php
require_once("inc/auth.php");
require_once("inc/connection.php");
cekAuth("pindah");
$berhasil=false;
$_SESSION['error']="";
if(!empty($_POST['tmbdaftar'])){
    $username=$_POST['username'];
    $namalengkap=$_POST['namalengkap'];
    $email=$_POST['email'];
    $bio=$_POST['bio'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];
    $valid=true;
    
    if($password!=$password2){
        $_SESSION['error'].="Password tidak cocok<br/>";
        $valid=false;
    }else{
        $password=md5($password);
    }
    if(empty($username)||empty($namalengkap)||empty($email)||empty($bio)||empty($password)||empty($password2)){
        $valid=false;
    }
    if(false!==strpos($username," ")){
        $_SESSION['error'].="Username tidak boleh ada spasi<br/>";
        $valid=false;
    }
    
    if($valid){
        $berhasil=true;
        $sql="INSERT INTO user(username,password,email,fullname,image,bio) VALUES('$username','$password','$email','$namalengkap','default_".rand(0,1).".png','$bio')";
        $hasil=mysql_query($sql);
        if (!$hasil) {
            $pesan  = 'Invalid query: ' . mysql_error() . "\n";
            $pesan .= 'Whole query: ' . $sql;
            $pesan .= '<h1>no error'.mysql_errno().'</h1>';
            if(mysql_errno()==1062){
                $berhasil=false;
                $_SESSION['error']="Nama user $username sudah dipakai";
            }else{
                die($pesan);
            }
        }
        
    }else{
        $_SESSION['error'].="Isi form ada yang salah.";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Twitter Like : Daftar</title>
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
                    <h1>Daftarkan</h1>
                    <?php if(!empty($_SESSION['error'])): ?>
                    <p class="error"><?php echo $_SESSION['error']; ?></p>
                    <?php 
                        $_SESSION['error']="";
                        endif;
                     ?>
                     <?php if($berhasil):?>
                    <h2>Selamat anda telah terdaftar</h2>
                    <p>anda telah terdaftar dengan username <strong><?php echo $username; ?></strong>. untuk langsung masuk klik <a href="masuk.php">ini</a></p>
                     <?php else: ?>
                    <p>isi form pendaftaran berikut ini</p>
                    <form id="daftar" name="daftar" action="daftar.php" method="POST">
                        <fieldset class="round">
                            <legend>Informasi anda</legend>
                            <label for="username">Username</label>
                            <input type="text" required id="username" name="username" size="30" value="<?php echo (empty($username))?'':$username; ?>" autofocus/>
                            <label for="namalengkap">Nama Lengkap</label>
                            <input type="text" required id="namalengkap" name="namalengkap" size="30" value="<?php echo (empty($namalengkap))?'':$namalengkap; ?>"/>
                            <label for="email">Email</label>
                            <input type="email" required id="email" name="email" size="25" value="<?php echo (empty($email))?'':$email; ?>"/>
                            <label for="bio">Bio</label>
                            <textarea name="bio" rows="4" cols="35" required ><?php echo (empty($bio))?'':$bio; ?></textarea>
                            <label for="password">Password</label>
                            <input type="password" required id="password" name="password" size="20"/>
                            <label for="password2">Konfirmasi</label>
                            <input type="password" required id="password2" name="password2" size="20"/>
                        </fieldset>
                        <input type="submit" class="tombol" name="tmbdaftar" id="tmbdaftar" value="Daftar">
                    </form>
                    <?php endif; ?>
                </div>
            </div>
            <div id="footer" class="round">&copy;2010 for education purpose only <a href="http://saktidwicahyono.blogspot.com">Contact</a></div>
        </div>
    </body>
    <script type="text/javascript">
    </script>
</html>
