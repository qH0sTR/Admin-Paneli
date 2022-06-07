<?php define("admin",true);?>

<?php include "../sistem/ayar.php" ?>
<?php include "../sistem/sistem.php" ?>
<!DOCTYPE html>
<html lang="en">    
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>
<body id="page-top">
<?php
// $_SESSION["login"]=true;
    if($_SESSION["login"]) {
        include("inc/default.php");
    }else {
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-body p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Admin Giris Paneli</h1>
                    </div>
                    <?php
                        if($_POST){
                            $isim = p("isim");
                            $sifre = p("sifre");
                            if(!$isim || !$sifre){
                                echo '<div class="alert alert-warning">uye adı ya da sifre boş bırakılamaz</div>';
                            }else{
                                $sifre = md5($sifre);
                                $query = $db->prepare("SELECT
                                                    *
                                                    FROM uyeler
                                                    WHERE uye_adi=?
                                                    AND uye_sifre=?");
                                $query->execute(array($isim,$sifre));
                                $row = $query->fetch(PDO::FETCH_ASSOC);
                                $kontrol = $query->rowCount();

                                if($kontrol){
                                    $_SESSION["login"] = true;
                                    $_SESSION["uye"] = $row["uye_adi"];
                                    $_SESSION["id"] = $row["uye_id"];
                                    $_SESSION["rutbe"] = $row["uye_rutbe"];
                                    header("location:/admin/");
                                }else{
                                    echo '<div class="alert alert-danger">uye adı ya da sifreniz yanlıs</div>';
                                }
                            }
                        }
                    ?>
                    <form action="" method="post" class="user">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="isim" placeholder="isim" name="isim">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="sifre" placeholder="sifre" name="sifre">
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Giris Yap
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">Col-Md-6</div>
    </div>
</div>      <?php } ?>































 

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script>
      $(document).ready(function(){
        $(".card").on({
            mouseenter: function(){ $(this).css("background-color","red")},
            mouseleave: function(){ $(this).css("background-color","white")}
        });
      });
</script>
</body>
<script src="//cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
</html>