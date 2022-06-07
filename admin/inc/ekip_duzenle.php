<?php !defined("admin") ? die("hacking") : null; ?>
<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ekip</h1>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="panel panel-default ">
        <div class="panel-heading bg-gradient-primary text-warning pl-4">
            <span class="ml-2">ekip Duzenle</span>
        </div>
        <div class="panel-body bg-gradient-info p-4 text-light">
           <?php
           $id = g("id",true);
           $query = $db->prepare("SELECT
                                    *
                                    FROM ekip
                                    WHERE ekip_id=?");
                $query->execute(array($id));
                $row = $query->fetch(PDO::FETCH_ASSOC);
if($_POST){                     // post edilmişse
$adi = p("adi",true);
$link = seflink($adi);
$bilgi = p("bilgi",true); 
$aciklama = p("aciklama",true);
$full = p("full");
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
                            if(!is_dir($_SERVER["DOCUMENT_ROOT"].$row["ekip_resim"])){
                                unlink($_SERVER["DOCUMENT_ROOT"].$row["ekip_resim"]);
                            }
                            $ok = move_uploaded_file($_FILES["resim"]["tmp_name"],$yuklemeYeri);
                                if($ok){
                                $resim = "/tema/default/upload/".$dosyaAdi;
                                }
                        }   // else - dosya tipi jpg ya da png değilse 
                    }    // else - file_exist()
                }   // else image max size>700 kb
            }   // if $_FILES["resim"]
        } // if $_POST
          if(!$adi || !$bilgi || !$aciklama || !$full ||  !$durum){
            echo '<div class="alert alert-warning">gerekli alanları doldurmanız gerekiyor.</div>';
            }else{

          if(!$resim){
            $resim = $row["ekip_resim"];
          }
          $update  = $db->prepare("UPDATE  ekip SET
                                 ekip_adi=?,
                                 ekip_link=?,
                                 ekip_bilgi=?,
                                 ekip_anasayfa_aciklama=?,
                                 ekip_full_aciklama=?,
                                 ekip_resim=?,
                                 ekip_durum=?
                                 WHERE ekip_id=?
                                ");
            $ok = $update->execute(array($adi,$link,$bilgi,$aciklama,$full,$resim,$durum,$id));
            if($ok){
                echo '<div class="alert alert-success">ekip basarıyla güncellendi. Yönlendiriliyorsunuz</div>';
                header("refresh:2;url=?do=ekip");
            }else{
                echo '<div class="alert alert-danger">ekip güncellenirken bir hata olustu</div>';
            }
        }
            }else{
            ?>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="col-8">
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">ekip Baslık</label>
                    <input name="adi" value="<?= $row['ekip_adi']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">ekip Bilgi</label>
                    <input name="bilgi" value="<?= $row['ekip_bilgi']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">ekip Anasayfa Acıklaması</label>
                    <textarea name="aciklama" class="form-control my-3 ckeditor" rows="8" style="resize: none;"> <?= $row['ekip_anasayfa_aciklama']; ?> </textarea>
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">ekip Full Acıklaması</label>
                    <textarea name="full" class="form-control my-3 ckeditor" rows="8" style="resize: none;"> <?= $row['ekip_full_aciklama']; ?> </textarea>
                </div>
                <div class="form-group m-0">
                    <label class="my-2 " for="">ekip Durum<span class="text-warning">( Virgül İle Ayırın  bkz: <code>php,css,html</code> )</span></label>
                    <select class="form-control my-2" name="durum">
                        <option <?= $row["ekip_durum"]=="1"? "selected" : null; ?> value="1">ekip Açık</option>
                        <option <?= $row["ekip_durum"]=="2"? "selected" : null; ?> value="2">ekip Kapalı</option>
                    </select>
                </div> 
                <div class="form-group m-0">
                    <label class="m-0 " for="">ekip Resim</label>
                    <input name="resim" type="file" class="form-control">
                </div>
                <div style="text-align: center;">
                <button style="position: relative; right: 0;" type="submit" class="btn btn-primary my-2 ">ekibi Güncelle</button>
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