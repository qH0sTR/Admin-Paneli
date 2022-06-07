<?php !defined("admin") ? die("hacking") : null; ?>
<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Referans Düzenleme</h1>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="panel panel-default ">
        <div class="panel-heading bg-gradient-primary text-warning pl-4">
            <span class="ml-2">Referans Düzenleme Bölümü</span>
        </div>
        <div class="panel-body bg-gradient-info p-4 text-light">
           <?php
           $id = g("id",true);
           $query = $db->prepare("SELECT
                                    *
                                    FROM referanslar
                                    WHERE referans_id=?");
                $query->execute(array($id));
                $row = $query->fetch(PDO::FETCH_ASSOC);
if($_POST){                     // post edilmişse
$adi = p("adi",true);
$aciklama = p("aciklama",true);
$resim = $_FILES["resim"]["name"];
    if($_FILES["resim"]){                  // resim yüklenmişse
    $resim = p("resim",true);
    $maxSize = 700000;
        if($_FILES["resim"]["size"]>$maxSize){  // resim boyut kontrolü 
        echo '<div class="alert alert-warning">700 kb\'dan büyük dosyalar yüklenemez!</div>';
            }else{
            $dosyaUzantisi = pathinfo($_FILES["resim"]["name"],PATHINFO_EXTENSION);
            $dosyaAdi = time()."_".rand(0,999).".".$dosyaUzantisi;
            $yuklemeYeri = $_SERVER["DOCUMENT_ROOT"]."/tema/default/upload/".$dosyaAdi;
                if(file_exists($yuklemeYeri) && $yuklemeYeri!=$_SERVER["DOCUMENT_ROOT"]."/www/tema/default/upload/"){
                echo '<div class="alert alert-warning">dosya daha önce yüklenmis</div>';
                }else{
                $type = $_FILES["resim"]["type"];
                    if(!($type == "image/jpeg" || $type== "image/png" || $type== "")){
                    echo $_FILES["resim"]["type"];
                    echo '<div class="alert alert-warning">jpg ve png hariç formatlar desteklenmez</div>';
                        }else{
                            if(is_uploaded_file($_FILES["resim"]["tmp_name"])){
                            unlink($_SERVER["DOCUMENT_ROOT"].$row["sayfa_resim"]);
                            $ok = move_uploaded_file($_FILES["resim"]["tmp_name"],$yuklemeYeri);
                                if($ok){
                                $resim = "/tema/default/upload/".$dosyaAdi;
                                }
                        }   // else - dosya tipi jpg ya da png değilse 
                    }    // else - file_exist()
                }   // else image max size>700 kb
            }   // if $_FILES["resim"]
        } // if $_POST
          if(!$adi || !$aciklama){
            echo '<div class="alert alert-warning">gerekli alanları doldurmanız gerekiyor.</div>';
            }else{
            if(!$resim){
                $resim = $row["referans_resim"];
            }
            
          $update  = $db->prepare("UPDATE  referanslar  SET
                                 referans_adi=?,
                                 referans_aciklama=?,
                                 referans_resim=?
                                 WHERE referans_id=?
                                ");
            $ok = $update->execute(array($adi,$aciklama,$resim,$id));
            if($ok){
                echo '<div class="alert alert-success">Sayfa basarıyla güncellendi, yönlendiriliyorsunuz</div>';
                header("refresh:2;url=?do=referanslar");
            }else{
                echo '<div class="alert alert-danger">Sayfa güncellenirken bir hata olustu</div>';
            }
        }
            }else{
            ?>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="col-8">
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Referans Adı</label>
                    <input name="adi" value="<?= $row['referans_adi']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">Referans Acıklaması</label>
                    <textarea name="aciklama" class="form-control my-3" rows="8" style="resize: none;"> <?= $row['referans_aciklama']; ?> </textarea>
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">Referans Resim</label>
                    <div style="background-color: white; margin-bottom: 10px; padding: 10px;"><img src="<?= $row["referans_resim"] ?>" width="200" height="100"></div>
                    <input name="resim" type="file" class="form-control">
                </div>
                <div style="text-align: center;">
                <button style="position: relative; right: 0;" type="submit" class="btn btn-primary my-2 ">Ayarları Güncelle</button>
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