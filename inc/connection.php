<?php
mysql_connect("localhost","root","saktidc");
mysql_select_db("twitterlike");
mysql_set_charset("utf8");
function query($sql){
    $hasil=mysql_query($sql);
    if (!$hasil) {
        $pesan  = 'Invalid query: ' . mysql_error() . "\n";
        $pesan .= 'Whole query: ' . $sql;
        die($pesan);
    }
    $temp=array();
    while($row = mysql_fetch_assoc($hasil)){
        $temp[]=$row;
    }
    return $temp;
}
