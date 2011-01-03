<?php
mysql_connect("localhost","root","saktidc");
mysql_select_db("lat");
$hasil=mysql_query("SELECT * FROM daftarmakanan");
$daftar=array();
while($baris=mysql_fetch_assoc($hasil)){
    $daftar[]=$baris;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Latihan Jquery</title>
        <script type="text/javascript" src="jquery-1.4.2.min.js">
        </script>
        <script type="text/javascript">
            //ketik disini
            $(function(){
                $('#inset h1,#content h1').css({
                    color:"green",
                    fontSize:"20pt",
                    textDecoration:"underline"
                });
                $('#content h2').css('text-align','center');
                function updateWarna(){
                    $('#content ol li:even').css({
                        color:'#222',
                        background:'#888'
                    });                
                }
                $('#tombol').click(function(){
                    var input=prompt("Daftar baru?","isikan nama");
                    $('<li>'+input+'</li>').appendTo($('#content ol'));
                    updateWarna();
                    
                    //tambah ke database menggunakan ajax
                    $.ajax({
                        url:"tambah.php",
                        type:"POST",
                        data:"nama="+input,
                        dataType:"html",
                        success:function(data){
                            alert("Tambah data "+data);
                        }
                    });
                });
                updateWarna();
                
            });
            
        </script>
    </head>
    <body>
        <div id="content">
            <input type="button" id="tombol" value="Tekan saya" />
            <h1>Judul Artikel</h1>
            <p>Isikan artikel anda disini sdfs sdfa sdf asdf asdfsadf sadsdf sadfs adfsa df asd fas<p>
            <h2>Daftar Makanan</h2>
            <ol>
                <?php foreach($daftar as $item): ?>
                <li><?php echo $item['nama']; ?></li>
                <?php endforeach;?>
            </ol>
            <p>dfs df sadf sad fsa df sadf sdaf sadf sadf asdf sad fsdf asd fsd </p>
        </div>
        <div id="content2">
            <h1>Judul Artikel ke 2</h1>
            <p>ljfa sldfjalsdkjf a;sldfl;asdjf sjdnfkjsdbfasdfasd faksjdhfaskdjfhaskd fksadj fkasdjhfklsadf halsdkfh sadf asdf asdf sadds asdfasadkf sdaff lsadf hsadfsadf asd </p>
            <div id="inset">
                <h1>Judul inset</h1>
                <p>kjsahdf sdf jalsdfk sadflasf alssldfs </p>
            </div>
        </div>        
    </body>
</html>
