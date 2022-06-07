<?php !defined("admin") ? die("hacking") : null; ?>
<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sayfa Düzenle</h1>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="panel panel-default ">
        <div class="panel-heading bg-gradient-primary text-warning pl-4">
            <span class="ml-2">Sayfa Düzenleme Bölümü</span>
        </div>
        <div class="panel-body bg-gradient-info p-4 text-light">
           <?php
           $id = g("id",true);
           $query = $db->prepare("SELECT
                                    *
                                    FROM sayfalar
                                    WHERE sayfa_id=?");
                $query->execute(array($id));
                $row = $query->fetch(PDO::FETCH_ASSOC);
if($_POST){                     // post edilmişse
$adi = p("adi",true);
$link = seflink($adi);
$bilgi = p("bilgi",true);
$aciklama = p("aciklama");
$durum = p("durum",true);
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
          if(!$adi || !$bilgi || !$aciklama || !$durum){
            echo '<div class="alert alert-warning">gerekli alanları doldurmanız gerekiyor.</div>';
            }

          if(!$resim){
            $resim = $row["sayfa_resim"];
          }
          $update  = $db->prepare("UPDATE  sayfalar SET
                                 sayfa_adi=?,
                                 sayfa_link=?,
                                 sayfa_bilgi=?,
                                 sayfa_aciklama=?,
                                 sayfa_resim=?,
                                 sayfa_durum=?
                                 WHERE sayfa_id=?
                                ");
            $ok = $update->execute(array($adi,$link,$bilgi,$aciklama,$resim,$durum,$id));
            if($ok){
                echo '<div class="alert alert-success">Sayfa basarıyla güncellendi, yönlendiriliyorsunuz</div>';
                header("refresh:2;url=?do=sayfalar");
            }else{
                echo '<div class="alert alert-danger">Sayfa güncellenirken bir hata olustu</div>';
            }
            }else{
            ?>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="col-8">
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Sayfa Baslık</label>
                    <input name="adi" value="<?= $row['sayfa_adi']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">Sayfa Bilgi</label>
                    <input name="bilgi" value="<?= $row['sayfa_bilgi']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">Sayfa Acıklaması</label>
                    <textarea name="aciklama" class="form-control my-3 ckeditor" rows="8" style="resize: none;"> <?= $row['sayfa_aciklama']; ?> </textarea>
                </div>
                <div class="form-group m-0">
                    <label class="my-2 " for="">Sayfa Durum</label>
                    <select class="form-control my-2" name="durum">
                        <option <?= $row["sayfa_durum"]=="1"? "selected" : null; ?> value="1">Sayfa Açık</option>
                        <option <?= $row["sayfa_durum"]=="2"? "selected" : null; ?> value="2">Sayfa Kapalı</option>
                    </select>
                </div> 
                <div class="form-group m-0">
                    <label class="m-0 " for="">Sayfa Resim</label>
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