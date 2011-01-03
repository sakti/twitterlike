<?php
require_once("inc/auth.php");
require_once("inc/connection.php");
require_once("inc/lib.php");
cekAuth("user");
$username=$_SESSION['username'];

function getReply($nama){
    $sql="SELECT tw.id,tw.username,DATE_FORMAT(tw.tglwaktu,'%h:%i %p, %e %b %Y') tgl,tw.isi,u.image FROM tweet tw, user u where u.username=tw.username and isi like '%@$nama%' ORDER BY tglwaktu DESC LIMIT 30";
    $hasil=query($sql);
    return $hasil;
}

$info=getInfoUser($username);
$info=$info[0];
$info['jml']=getJmlTweet($username);
$listreply=getReply($username);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Twitter Like</title>
        <link rel="stylesheet" href="gaya.css" type="text/css" />
        <link rel="stylesheet" href="subgaya.css" type="text/css" />
        <style type="text/css">
            #posting{
                display:none;
            }
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
                        <div id="posting">
                            <div id="counter">140</div>
                            <h2>Apa yang terjadi?</h2>
                            <form id="posttweet" action="home.php" method="POST">
                                <textarea name="isi" id="isi" autocomplete="off" rows="2" cols="40"></textarea>
                                <input type="submit" name="tweet" value="Tweet" class="tombol"/>
                            </form>
                        </div>
                        <h2>Reply</h2>
                        <ul id="daftartweet">
                            <?php if(count($listreply)==0):?>
                                <li><h1>Tidak ada reply untuk anda</h1><p> </p><p> </p></li>
                            <?php else:?>
                            <?php foreach($listreply as $tweet): ?>
                            <li>
                                <a href="home.php?id=<?php echo $tweet['username']; ?>"><img class="thumb" src="images/<?php echo $tweet['image']; ?>" width="48" height="48" /></a>
                                <span class="isitweet">
                                    <span class="usernm"><a href="home.php?id=<?php echo $tweet['username']; ?>"><?php echo $tweet['username']; ?></a></span>
                                    <?php echo $tweet['isi']; ?>
                                    <div class="addinfo">
                                        <span class="tgl"><?php echo $tweet['tgl']; ?></span>
                                        <span class="operasi">
                                            <?php if($tweet['username']!=$username): ?>
                                            <a href="home.php?reply=@<?php echo $tweet['username']; ?>">reply</a>
                                            <a href="home.php?retweet=<?php echo $tweet['id']; ?>">retweet</a>
                                            <?php endif;?>
                                        </span>
                                    </div>
                                </span>
                            </li>
                            <?php endforeach;?>
                            <?php endif;?>
                            <li><p></p></li>
                        </ul>
                    
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
