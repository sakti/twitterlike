<?php
require_once("inc/auth.php");
require_once("inc/connection.php");
require_once("inc/lib.php");
cekAuth("user");
$username=$_SESSION['username'];
if(!empty($_GET['putus'])){
    if(cekUsername($_GET['putus'])){
        $sql="DELETE FROM follow where usera='{$_GET['putus']}' and userb='$username'";
        $hasil=mysql_query($sql);
        if (!$hasil) {
            $pesan  = 'Invalid query: ' . mysql_error() . "\n";
            $pesan .= 'Whole query: ' . $sql;
            die($pesan);
        }
        header('Location: follower.php');
    }
}
function getFollower($nama){
    $sql="select u.username,u.fullname,u.image,t.isi,DATE_FORMAT(t.tglwaktu,'%h:%i %p, %e %b %Y') tgl  from user u left join tweet t on u.lasttweet = t.id where u.username in( select usera from follow where userb='$nama')";
    $hasil=query($sql);
    return $hasil;
}
$info=getInfoUser($username);
$info=$info[0];
$info['jml']=getJmlTweet($username);
$listfollower=getFollower($username);
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
                <div id="content">
                    <div id="wcontent">
                        <h2>Pengikut anda</h2>
                        <ul id="daftartweet">
                            <?php if(count($listfollower)==0):?>
                                <li><h1>Anda belum mempunyai pengikut</h1><p>Anda bisa memulai mencarinya di menu <a href="cari.php">cari</a></p></li>
                            <?php else:?>
                            <?php foreach($listfollower as $person): ?>
                            <li>
                                <a href="home.php?id=<?php echo $person['username']; ?>"><img class="thumb" src="images/<?php echo $person['image']; ?>" width="48" height="48" /></a>
                                <span class="isitweet">
                                    <span class="usernm"><a href="home.php?id=<?php echo $person['username']; ?>"><?php echo $person['username']; ?></a></span>
                                    <span class="desc"><?php echo $person['fullname']; ?></span>
                                    <span class="status">
                                    <?php echo $person['isi']; ?>
                                    </span>
                                    <div class="addinfo">
                                        <span class="tgl"><?php echo $person['tgl']; ?></span>
                                        <span class="operasi">
                                            <a href="follower.php?putus=<?php echo $person['username']; ?>">putus</a>
                                        </span>
                                    </div>
                                </span>
                            </li>
                            <?php endforeach;?>
                            <?php endif;?>
                        </ul>
                        <p>Tidak akan ada konfirmasi pemutusan hubungan, jadi berhati-hatilah dalam menghapus pengikut anda</p>
                    </div>
                </div>
                <div id="sidepanel">
                    <div id="wsidepanel">
                        <div id="infouser">
                            <img src="images/<?php echo $info['image'];?>" height="48" width="48" class="thumb"/>
                            <a href="#">
                            <span id="nama"><?php echo $username;?></span>
                            <span id="sjmltweet"><span id="jmltweet"><?php echo $info['jml'];?></span> tweets</span>
                            </a>
                            <br style="clear:both"/>
                            <p>Nama  <span id="fullname"><?php echo $info['fullname'];?></span></p>
                            <p>Email  <span id="email"><?php echo $info['email'];?></span></p>
                            <p>Bio  <span id="bio"><?php echo $info['bio'];?><span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer" class="round">&copy;2010 for education purpose only <a href="http://saktidwicahyono.blogspot.com">Contact</a></div>
        </div>
    </body>
    <script type="text/javascript">
    </script>
</html>
