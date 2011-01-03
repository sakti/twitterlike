<?php

function getInfoUser($nama){
    $sql="SELECT * FROM user u left join tweet t on u.lasttweet=t.id where u.username='$nama'";
    $hasil=query($sql);
    return $hasil;
}
function getJmlTweet($nama){
    $sql="SELECT count(*) jml FROM tweet where username='$nama'";
    $hasil=query($sql);
    $hasil=$hasil[0];
    return $hasil['jml'];
}
function cekUsername($nama){
    $sql="SELECT username FROM user WHERE username='$nama'";
    $hasil=query($sql);
    return (count($hasil)==1);
}
function getArrayFollowing($nama){
    $temp=array();
    $tempImg=array();
    $temp2=array();
    $sql="SELECT f.userb,u.image FROM follow f,user u where  f.userb=u.username and f.usera='$nama'";
    $hasil=query($sql);
    foreach($hasil as $item){
        $temp[]=$item['userb'];
        $tempImg[$item['userb']]=$item['image'];
    }
    $temp2['nama']=$temp;
    $temp2['image']=$tempImg;
    return $temp2;
}
function getArrayFollower($nama){
    $temp=array();
    $tempImg=array();
    $temp2=array();
    $sql="SELECT f.usera,u.image FROM follow f,user u where  f.usera=u.username and f.userb='$nama'";
    $hasil=query($sql);
    foreach($hasil as $item){
        $temp[]=$item['usera'];
        $tempImg[$item['usera']]=$item['image'];
    }
    $temp2['nama']=$temp;
    $temp2['image']=$tempImg;
    return $temp2;
}
function getTweetById($id){
    $sql="SELECT * FROM tweet where id=$id";
    $hasil=query($sql);
    return $hasil[0];
}
function getTweetsByUser($nama){
    $sql="SELECT tw.id,tw.username,DATE_FORMAT(tw.tglwaktu,'%h:%i %p, %e %b %Y') tgl,tw.isi,u.image FROM tweet tw, user u where u.username=tw.username and tw.username='$nama' ORDER BY tglwaktu DESC LIMIT 10";
    $hasil=query($sql);
    return $hasil;
}
