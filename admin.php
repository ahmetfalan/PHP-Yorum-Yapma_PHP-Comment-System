<?php 
include("vt.php");
session_start();
if(!isset($_SESSION["admin"])){
    header("Location:giris.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Yorum Düzenle</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
    <body>

        <div class="container">
        
        <div class="col-md-6">
        
        <form id="form1" method="post">
        <div class="col-md-7">
        <table class="table">
        </br>
        <tr>
            <a href="cikis.php" class="btn btn-primary btn-block">Çıkış Yap</a>
            </br></br>
        </tr>
            <tr>
                <th>Yorum</th>
                <th>Onay</th>
                <th>Kullanıcı Adı</th>
                <th></th>
                <th></th>
            </tr>
        <?php 

        $sorgu = $baglanti->query("select * from yorum"); 

        while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) { 

        $yorumid = $sonuc['yorumid'];
        $yazi = $sonuc['yazi'];
        $onay = $sonuc['onay'];
        $kullaniciadi = $sonuc['kullaniciadi'];
        ?>
            
            <tr>
                <td><?php if(strlen($yazi) > 10) {echo substr($yazi, -10), "...";} else { echo $yazi; }?></td>
                <td><?php if($onay == 1) {echo "Onaylandı";} else {echo "Onaylanmadı";}?></td>
                <td><?php echo $kullaniciadi; ?></td>
                <td><input type="hidden" class="btn btn-primary btn-block" ID="hidden" value="<?php echo $yorumid;?>"/></td>
                <td><a href="duzenle.php?yorumid=<?php echo $yorumid; ?>" class="btn btn-primary">Düzenle</a></td>
                <td><a href="sil.php?yorumid=<?php echo $yorumid; ?>" class="btn btn-danger">Sil</a></td>
            </tr>
        <?php 
        } 
        ?>
        </table>
        </div>
        </div>
    </body>
</html>