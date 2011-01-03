<?php
#if(false!==strpos("sakti dc"," dd")){
#    echo '<h1>ditemukan</h1>';
#}else{
#    echo '<h1>Tidak ditemukan</h1>';
#}

#$nama="sakti.doc.png";
#$ext=substr($nama,strrpos($nama,"."));
#echo "<h1>$ext</h1>";
$str="'hehe' <bold>testing &copy; なるとくん</bold>";

$str=strstr("image/jpeg","image");
echo "<h1>";
echo "$str";
//echo htmlentities($str, ENT_QUOTES,"UTF-8");
if($str){
    echo " ditemukan";
}else{
    echo " tidak ditemukan";
}
?>
