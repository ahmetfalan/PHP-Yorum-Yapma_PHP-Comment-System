<?php
include("vt.php");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <title>Giriş</title>
    <style>
        .kutu 
        {
            margin-top: 40px
        }
    </style>
</head>
<body>

<form id="form1" method="post">
    <div class="row align-content-center justify-content-center ">
        <div class="col-md-3 kutu">
            <h3 class="text-center">Giriş Ekranı</h3>
            <table class="table">
                <tr>
                    <td>
                        <input type="text" ID="kullaniciadi" name="kullaniciadi" class="form-control" placeholder="Kullanıcı adı" value='<?php echo @$txtKadi ?>'/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" ID="sifre" name="sifre" class="form-control" placeholder="Parola"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <?php
                        if($_POST)
                        {
                            $kullaniciadi = $_POST["kullaniciadi"];
                            $sifre = $_POST["sifre"];
                            if(!empty($kullaniciadi) && !empty($sifre))
                            {
                                $sorgu=$baglanti->prepare("select * from kullanici where kullaniciadi=? and sifre=? and stat='kullanici'");
                                $sorgu2=$baglanti->prepare("select * from kullanici where kullaniciadi=? and sifre=? and stat='admin'");
                                
                                $sorgu->execute(array($kullaniciadi, $sifre));
                                $sorgu2->execute(array($kullaniciadi, $sifre));
                                
                                $islem=$sorgu->fetch();
                                $islem2=$sorgu2->fetch();

                                if($islem)
                                {
                                    session_start();
                                    $_SESSION['kullaniciadi'] = $islem['kullaniciadi'];
                                    header("Location:index.php");
                                }
                                else if($islem2)
                                {
                                    session_start();
                                    $_SESSION["admin"] = "true";
                                    header("Location:admin.php");
                                }
                                else
                                {
                                    echo "Kullanıcı adınız veya şifreniz yanlış.";
                                }
                            }
                            else
                            {
                                echo "Boş alan bırakmayınız.";
                            }
                        } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <input type="submit" class="btn btn-primary btn-block" ID="btnGiris" value="Giriş"/>
                        <a href="kayitol.php" class="btn btn-primary btn-block">Kayıt Sayfası</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
</body>
</html>