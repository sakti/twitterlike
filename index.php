<?php
require_once("inc/auth.php");
require_once("inc/connection.php");
cekAuth("pindah");
function getNewestTweet(){
    $sql="SELECT tw.id,tw.username,DATE_FORMAT(tw.tglwaktu,'%h:%i %p, %e %b %Y') tgl,tw.isi,u.image FROM tweet tw, user u where u.username=tw.username ORDER BY tglwaktu DESC LIMIT 15";
    $hasil=query($sql);
    return $hasil;
}
$daftartweetbaru=getNewestTweet();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Twitter Like</title>
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
                    <h1>Selamat datang di twitterlike</h1>
                    <p>Anda baru, silahkan <a href="daftar.php">daftar</a> terlebih dahulu, jika sudah punya akun silahkan <a href="masuk.php">masuk</a></p>
                    <h2>Tweet terbaru<h2>
                    <ul id="daftartweet">
                        <?php foreach($daftartweetbaru as $tweet): ?>
                        <li>
                            <a href="home.php?id=<?php echo $tweet['username']; ?>"><img class="thumb" src="images/<?php echo $tweet['image']; ?>" width="48" height="48" /></a>
                            <span class="isitweet">
                                <span class="usernm"><a href="home.php?id=<?php echo $tweet['username']; ?>"><?php echo $tweet['username']; ?></a></span>
                                <?php echo $tweet['isi']; ?>
                                <div class="addinfo">
                                    <span class="tgl"><?php echo $tweet['tgl']; ?></span>
                                    <span class="operasi">
                                        <!--<a href="#<?php echo $tweet['id']; ?>">reply</a>
                                        <a href="#<?php echo $tweet['id']; ?>">retweet</a>-->
                                    </span>
                                </div>
                            </span>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <div id="footer" class="round">&copy;2010 for education purpose only <a href="http://saktidwicahyono.blogspot.com">Contact</a></div>
        </div>
    </body>
    <script type="text/javascript">
    </script>
</html>
