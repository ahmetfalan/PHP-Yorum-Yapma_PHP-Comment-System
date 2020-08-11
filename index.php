<?php
include("vt.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Yorum Yap</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="">
        body{margin-top:20px;}
        .content-item {
            padding:30px 0;
            background-color:#FFFFFF;
        }
        .content-item.grey {
            background-color:#F0F0F0;
            padding:50px 0;
            height:100%;
        }
        .content-item h2 {
            font-weight:700;
            font-size:35px;
            line-height:45px;
            text-transform:uppercase;
            margin:20px 0;
        }

        .content-item h3 {
            font-weight:400;
            font-size:20px;
            color:#555555;
            margin:10px 0 15px;
            padding:0;
        }

        .content-headline {
            height:1px;
            text-align:center;
            margin:20px 0 70px;
        }

        .content-headline h2 {
            background-color:#FFFFFF;
            display:inline-block;
            margin:-20px auto 0;
            padding:0 20px;
        }

        .grey .content-headline h2 {
            background-color:#F0F0F0;
        }

        .content-headline h3 {
            font-size:14px;
            color:#AAAAAA;
            display:block;
        }


        #comments {
            box-shadow: 0 -1px 6px 1px rgba(0,0,0,0.1);
            background-color:#FFFFFF;
        }

        #comments form {
            margin-bottom:30px;
        }

        #comments .btn {
            margin-top:7px;
        }

        #comments form fieldset {
            clear:both;
        }

        #comments form textarea {
            height:100px;
        }

        #comments .media {
            border-top:1px dashed #DDDDDD;
            padding:20px 0;
            margin:0;
        }

        #comments .media > .pull-left {
            margin-right:20px;
        }

        #comments .media img {
            max-width:100px;
        }

        #comments .media h4 {
            margin:0 0 10px;
        }

        #comments .media h4 span {
            font-size:14px;
            float:right;
            color:#999999;
        }

        #comments .media p {
            margin-bottom:15px;
            text-align:justify;
            word-wrap:break-word;
            width:800px; 
        }

        #comments .media-detail {
            margin:0;
        }

        #comments .media-detail li {
            color:#AAAAAA;
            font-size:12px;
            padding-right: 10px;
            font-weight:600;
        }

        #comments .media-detail a:hover {
            text-decoration:underline;
        }

        #comments .media-detail li:last-child {
            padding-right:0;
        }

        #comments .media-detail li i {
            color:#666666;
            font-size:15px;
            margin-right:10px;
        }
    </style>
</head>
<body>
<?php
session_start();
if (!empty($_SESSION["kullaniciadi"])) {
    $kullaniciadi = $_SESSION["kullaniciadi"];
} else {
    header("location:giris.php");
}
?>
<form id="form1" method="post">
    <section class="content-item" id="comments">
        <div class="container">         
            <div class="row">
                <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-3 col-lg-2 hidden-xs">
                                    <a href="cikis.php" class="btn btn-primary btn-block">Çıkış</a>
                                </div>
                                <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                    <textarea class="form-control" id="yazi" name="yazi" placeholder="Yorumunuz nedir?" required=""></textarea>
                                </div>
                            </div>
                        <input type="submit" class="btn btn-normal pull-right" ID="btnGiris" value="Yorum Yap"/></br></br>
                        <?php
                            if($_POST){
                                $yazi = $_POST['yazi'];
                                $eklemetarihi = date("Y.m.d H:i:s");
                                $onay = false;

                                $sql = "insert into yorum (yazi, eklemetarihi, onay, kullaniciadi) values ('$yazi', '$eklemetarihi', '$onay', '$kullaniciadi')";
                                if($baglanti->query($sql) == TRUE && !empty($yazi))
                                {
                                    echo "<script>
                                    alert('Yorumunuz admin onayına gönderildi.');
                                    window.location.href='index.php';
                                    </script>";
                                } 
                                else 
                                {
                                    echo "Boş geçmeyin";
                                    echo $baglanti->error;
                                }
                            }
                        ?>
                        <h3><?php
                        $sorgu = $baglanti->prepare("select count(*) from yorum where onay='1'");
                        $sorgu->execute();
                        $say = $sorgu->fetchColumn();
                        echo  $say . ' Yorum';
                        ?></h3>
                        <?php  
                            $sorgu = $baglanti->query("select * from yorum where onay='1'"); // Makale tablosundaki tüm verileri çekiyoruz.
                            while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC))
                            { 
                        ?>
                            <div class="media">
                                <a class="pull-left" href="#">
                                <img src="https://img.icons8.com/pastel-glyph/128/000000/user-male--v1.png"/></a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $sonuc["kullaniciadi"] ?></h4>
                                    <p><?php echo $sonuc["yazi"] ?></p>
                                    <ul class="list-unstyled list-inline media-detail pull-left">
                                        <li><i class="fa fa-calendar"></i><?php echo $sonuc["eklemetarihi"] ?></li>
                                    </ul>
                                </div>
                            </div>
                        <?php 
                            } 
                        ?>
                </div>
            </div>
        </div>
    </section>
</form>
</body>
</html>