<?php !defined("admin") ? die("hacking") : null; ?>
<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Profil</h1>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="panel panel-default ">
        <div class="panel-heading bg-gradient-primary text-warning pl-4">
            <span class="ml-2">Profil Düzenle</span>
        </div>
        <div class="panel-body bg-gradient-info p-4 text-light">
           <?php
           $id = g("id");
           if($_SESSION["id"]==$id){
            $query = $db->prepare("SELECT
                                    *
                                    FROM uyeler
                                    WHERE uye_id=?");
                $query->execute(array($id));
                $row = $query->fetch(PDO::FETCH_ASSOC);
           }else{
               echo '<div class="alert alert-danger">Yanlıs bir yere girdin. Güle güle</div>';
               die(header("refresh:2;url=?do=cikis"));
           }
            if($_POST){
                $isim = p("isim",true);
                $sifre = p("sifre",true);
                $email = p("email",true);

                if(!$isim || !$email){
                echo $isim."<br>".$email;
               echo '<div class="alert alert-danger">isim ve email boş bırakılamaz!</div>';
                }else{
                    if(!$sifre){
                        $sifre = $row["uye_sifre"];
                    }else{
                        $sifre = md5($sifre);
                    }
                $update = $db->prepare("UPDATE uyeler SET
                                        uye_adi=?,
                                        uye_sifre=?,
                                        uye_eposta=?
                                        WHERE uye_id=?");
                $update->execute(array($isim,$sifre,$email,$id));
                if($update){
                    echo '<div class="alert alert-success">Profil basarıyla güncellendi, yönlendiriliyorsunuz</div>';
                    header("refresh:2;url=?do=profil_duzenle&id=".$_SESSION["id"]);
                }else{
                    echo '<div class="alert alert-danger">Profil güncellenirken bir hata olustu!</div>';
                }
            }

            }else{
                ?>
            <form action="" method="post">
            <div class="col-6">
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Uye Adı</label>
                    <input name="isim" value="<?= $row['uye_adi']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Uye Şifresi</label>
                    <input name="sifre" type="password" class="form-control">
                </div>
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Uye Eposta</label>
                    <input name="email" value="<?= $row['uye_eposta']; ?>" type="email" class="form-control">
                </div>
              
                <div style="text-align: center;">
                <button style="position: relative; right: 0;" type="submit" class="btn btn-primary my-2 ">Profili Güncelle</button>
                </div>
            </div>
            </form>
            <?php
            }
           ?>
        </div>
        <div class="panel-footer bg-gradient-primary m-0">
            Kolay Video Dersleri Footer
        </div>
    </div>
</div>