<?php
session_start();

function cekAuth($hak){
    if($hak=="user"){
        if(empty($_SESSION['username'])){
            $_SESSION['error']="anda harus masuk terlebih dahulu";
            header("Location: masuk.php");
        }
    }else if($hak=="pindah"){
        if(!empty($_SESSION['username'])){
            header("Location: home.php");
        }
    }
}
function logout(){
    session_destroy();
    header('Location: index.php');
}

