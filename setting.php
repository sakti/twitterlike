<?php
require_once("inc/auth.php");
require_once("inc/connection.php");
require_once("inc/lib.php");
cekAuth("user");
$berhasil=false;
$_SESSION['error']="";
$username=$_SESSION['username'];
if(!empty($_POST['tmbupdate'])){
    $valid=true;
    $foto=false;
    $namalengkap=$_POST['namalengkap'];
    $bio=$_POST['bio'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    if(empty($username)||empty($namalengkap)||empty($email)||empty($bio)){
        $valid=false;
    }
    if($valid){
        if($_FILES['foto']['error']==UPLOAD_ERR_OK ){
            $foto=true;
            $namafile=md5_file($_FILES['foto']['tmp_name']);
            $ext=substr($_FILES['foto']['name'],strrpos($_FILES['foto']['name'],"."));
            $namafile.=$ext;
            $filter=array(".png",".jpg",".jpeg",".bmp");
            if(in_array(strtolower($ext),$filter)&&strstr(mime_content_type($_FILES['foto']['tmp_name']),"image")){
                if (move_uploaded_file($_FILES['foto']['tmp_name'],"./images/".$namafile)) {
                    $image = new Imagick("./images/".$namafile);
                    $image->cropThumbnailImage(48, 48);
                    $image->writeImage();
                    $image = new Imagick("./images/".$namafile);
                    $image->cropThumbnailImage(24, 24);
                    $image->writeImage("./images/mini-".$namafile);
                } else {
                    $_SESSION['error'].="File gagal di upload.";
                    $foto=false;
                }
            }else{
                $_SESSION['error'].="File gambar yang bisa di upload .png .jpg .jpeg .bmp";
                $foto=false;
            }
        }else if($_FILES['foto']['error']==UPLOAD_ERR_INI_SIZE){
            $_SESSION['error'].="File terlalu besar.";
        }
        if($foto){
            $ufoto=",image='$namafile'";
        }else{
            $ufoto="";
        }
        if($password!=""){
            $upassword=",password='".md5($password)."'";
        }else{
            $upassword="";
        }
        $sql="UPDATE  `user` SET  fullname='$namalengkap',bio='$bio',email='$email' $ufoto $upassword WHERE  `user`.`username` =  '$username';";
        $hasil=mysql_query($sql);
        if (!$hasil) {
            $pesan  = 'Invalid query: ' . mysql_error() . "\n";
            $pesan .= 'Whole query: ' . $sql;
            die($pesan);
        }
        $berhasil=true;
    }else{
        $_SESSION['error'].="Isi form ada yang salah.";
    }
}
$info=getInfoUser($username);
$info=$info[0];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Twitter Like</title>
        <link rel="stylesheet" href="gaya.css" type="text/css" />
        <link rel="stylesheet" href="subgaya.css" type="text/css" />
        <style type="text/css">
        </style>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <a id="logo" href="/"><img src="images/logo_small.png"></a>
                <ul id="nav" class="round">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="following.php">Following</a></li>
                    <li><a href="follower.php">Follower</a></li>
                    <li><a href="reply.php">Reply</a></li>
                    <li><a href="cari.php">Cari</a></li>
                    <li><a href="setting.php">Setting</a></li>
                    <li><a href="home.php?op=logout">Keluar</a></li>
                </ul>
            </div>
            <div id="wrap" class="round">
                <div id="frontpage" class="round">
                    <h1>Setting</h1>
                    <?php if(!empty($_SESSION['error'])): ?>
                    <p class="error"><?php echo $_SESSION['error']; ?></p>
                    <?php
                        $_SESSION['error']="";
                        endif;
                     ?>
                     <?php if($berhasil):?>
                    <h2>Proses update berhasil</h2>
                     <?php endif; ?>
                    <form enctype="multipart/form-data" id="setting" name="setting" action="setting.php" method="POST">
                        <fieldset class="round">
                            <legend>Settingan Anda</legend>
                            <img src="images/<?php echo $info['image'];?>" class="gambar"/>
                            <label for="namalengkap">Nama Lengkap</label>
                            <input type="text" id="namalengkap" name="namalengkap" size="30" required value="<?php echo $info['fullname'];?>"/>
                            <label for="bio">Bio</label>
                            <textarea name="bio" rows="4" cols="15" required><?php echo $info['bio'];?></textarea>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" required value="<?php echo $info['email'];?>" />
                            <label for="password">Password (isi untuk mengganti password)</label><input type="password" id="password" name="password" size="20"/>
                            <label for="foto">Foto</label><input type="file" name="foto" id="foto" accept="image/png"/>
                        </fieldset>
                        <input type="submit" class="tombol" name="tmbupdate" id="tmbupdate" value="Update">
                    </form>
                </div>
            </div>
            <div id="footer" class="round">&copy;2010 for education purpose only <a href="http://saktidwicahyono.blogspot.com">Contact</a></div>
        </div>
    </body>
    <script type="text/javascript">
    </script>
</html>
