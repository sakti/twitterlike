<?php
require_once("inc/auth.php");
require_once("inc/connection.php");
require_once("inc/lib.php");
cekAuth("user");
$username=$_SESSION['username'];
$listhasil=array();
function searchUser($nama){
    $sql="select u.username,u.fullname,u.image,t.isi,DATE_FORMAT(t.tglwaktu,'%h:%i %p, %e %b %Y') tgl  from user u left join tweet t on u.lasttweet = t.id where u.username like '%$nama%' or u.fullname like '%$nama%'";
    $hasil=query($sql);
    return $hasil;
}
$berhasil=false;
$_SESSION['error']="";
if(!empty($_GET['q'])){
    $berhasil=true;
    $q=trim($_GET['q']);
    if(strlen($q)<3){
        $_SESSION['error']="masukkan nama terlebih dahulu, harus lebih dari 2 karakter";
        $berhasil=false;
    }
    if($berhasil){
        $listhasil=searchUser($q);
    }
}
$arrFollowing=getArrayFollowing($username);
$arrFollowing=$arrFollowing['nama'];
$arrFollowing[]=$username;
//var_dump(in_array("h1zbullah",$arrFollowing));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Twitter Like</title>
        <link rel="stylesheet" href="gaya.css" type="text/css" />
        <link rel="stylesheet" href="subgaya.css" type="text/css" />
        <style type="text/css">
            #hasilpencarian{
                margin-top:20px;
                border-top:1px solid #999;
            }
            .infocari{
                padding:10px 0;
                display:block;
            }
            #keysearch{
                font-weight:bold;
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
                <div id="frontpage" class="round">
                    <h1>Pencarian</h1>
                    <?php if(!empty($_SESSION['error'])): ?>
                    <p class="error"><?php echo $_SESSION['error']; ?></p>
                    <?php 
                        $_SESSION['error']="";
                        endif;
                     ?>
                    <p>Masukkan nama yang anda cari</p>
                    <form id="cari" action="cari.php" method="GET">
                        <input type="text" name="q" id="q" size="35" placeholder="isi dengan nama yang ingin anda cari" autofocus />
                        <input type="submit" id="tmbcari" value="Cari" class="tombol" />
                    </form>
                    <div id="hasilpencarian">
                        <?php if($berhasil):?>
                            <span class="infocari">Nama yang dicari : <span id="keysearch"><?php echo $q; ?></span> , <?php echo count($listhasil); ?> orang yang cocok</span>
                        <?php endif; ?>
                        <ul id="daftartweet">
                        
                            <?php foreach($listhasil as $person): ?>
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
                                            <?php if(!in_array($person['username'],$arrFollowing)):?>
                                            <a href="following.php?follow=<?php echo $person['username']; ?>">ikuti</a>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </span>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="footer" class="round">&copy;2010 for education purpose only <a href="http://saktidwicahyono.blogspot.com">Contact</a></div>
        </div>
    </body>
    <script type="text/javascript">
    </script>
</html>
