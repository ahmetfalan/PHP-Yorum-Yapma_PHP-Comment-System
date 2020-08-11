<?php
include("vt.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <title>Kayıt Ol</title>
    <style>
        .kutu {
            margin-top: 40px
        }
    </style>
</head>
<body>

<form id="form1" method="post">
    <div class="row align-content-center justify-content-center ">
        <div class="col-md-3 kutu">
            <h3 class="text-center">Kayıt Ol</h3>
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
                        <input type="password" ID="sifretekrar" name="sifretekrar" class="form-control" placeholder="Parola Tekrar"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if ($_POST) 
                        {
                            $kullaniciadi = $_POST["kullaniciadi"];
                            $sifre = $_POST["sifre"];
                            $sifretekrar = $_POST["sifretekrar"];

                            if ($sifre == $sifretekrar && $sifre != '' && $kullaniciadi != '') 
                            {
                                $srg = $baglanti->prepare("select count(*) from kullanici where kullaniciadi='$kullaniciadi'");
                                $srg->execute();
                                $kayitsayisi = $srg->fetchColumn();

                                if($kayitsayisi > 0)
                                { 
                                    echo "Bu kullanıcı adı zaten alınmış, başka bir tane deneyin.";
                                }
                                else
                                {
                                    if ($sorgu = $baglanti->query("insert into kullanici (kullaniciadi, sifre, stat) VALUES ('$kullaniciadi', '$sifre', 'kullanici')"))
                                    {
                                        header("location:giris.php");
                                    }
                                    else
                                    {
                                        echo 'Bir hata oluştu.';
                                    }
                                }
                            }
                            else
                            {
                                echo "Alanları düzgün doldurunuz.";
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <input type="submit" class="btn btn-primary btn-block" ID="btnGiris" value="Kayıt Ol"/>
                        <a href="giris.php" class="btn btn-primary btn-block">Giriş Sayfası</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
</body>
</html>