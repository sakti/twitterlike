<?php
mysql_connect("localhost","root","saktidc");
mysql_select_db("lat");
if(!empty($_POST['nama'])){
    $hasil=mysql_query("INSERT INTO daftarmakanan values('{$_POST['nama']}')");
    if($hasil){
        echo "berhasil";
    }else{
        echo "gagal";
    }
    
}

