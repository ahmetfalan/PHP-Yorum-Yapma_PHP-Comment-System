<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <title>Düzenle</title>
    <style>
        .kutu 
        {
            margin-top: 5px;
            margin-bottom:15px;
            text-align:justify;
            word-wrap:break-word;
            width:350px; 
        }
    </style>
</head>
<body>
<?php
include("vt.php");
session_start();
if(!isset($_SESSION["admin"]))
{
    header("Location:giris.php");
}

$yorumid = (int)$_GET["yorumid"];
$sorgu = $baglanti->query("select * from yorum where yorumid=$yorumid");
$sonuc = $sorgu->fetch();
?>

<form id="form1" method="post">

    <div class="row align-content-center justify-content-center ">
        <div class="col-md-3 kutu">
        <a href="admin.php" class="btn btn-primary">Geri</a>
            <h3 class="text-center">Yorum Onayla</h3>
            <table class="table">
                <tr>
                    <td>
                        <div class="kutu"><?php echo "Yorum: " , $sonuc['yazi'] ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo "Kullanıcı Adı: ", $sonuc['kullaniciadi'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo "Eklenme Tarihi: ", $sonuc['eklemetarihi'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    Onay Durumu:
                        <select name="onay" id="onay" class="form-control">
                            <option value="Onaylandı" <?php if ( $sonuc['onay'] == 0) { echo ''; } else { echo 'selected'; } ?>> Onaylandı </option>    
                            <option value="Onaylanmadı" <?php if ( $sonuc['onay'] == 0) { echo 'selected'; } else { echo ''; } ?>> Onaylanmadı </option>
                        </select>
                        
                        <?php
                            if($_POST) 
                            {
                                $onay = $_POST["onay"];
                                if($onay == "Onaylandı")
                                {
                                    $onaylamak = 1;
                                }
                                else
                                {
                                    $onaylamak = 0;
                                }
                                $yorumid = (int)$_GET["yorumid"];
                                if ($sorgu = $baglanti->query("update yorum set onay='$onaylamak' where yorumid='$yorumid'"))
                                {
                                    echo "<script>
                                    alert('Kayıt güncellendi.');
                                    window.location.href='admin.php';
                                    </script>";
                                }
                                else
                                {
                                    echo "Güncellerken bir hata oluştu.";
                                }
                            }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <input type="submit" class="btn btn-primary btn-block" ID="btnGuncelle" value="Güncelle"/>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
</body>
</html>