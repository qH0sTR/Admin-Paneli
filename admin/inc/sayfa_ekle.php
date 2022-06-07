<?php !defined("admin") ? die("hacking") : null; ?>
<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sayfa Ekle</h1>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="panel panel-default ">
        <div class="panel-heading bg-gradient-primary text-warning pl-4">
            <span class="ml-2">Sayfa Ekleme Bölümü</span>
        </div>
        <div class="panel-body bg-gradient-info p-4 text-light">
           <?php
        
if($_POST){                     // post edilmişse
$adi = p("adi",true);
$link = seflink($adi);
$bilgi = p("bilgi",true);
$aciklama = p("aciklama");
$durum = p("durum",true);
$query = $db->prepare("SELECT
*
FROM sayfalar
WHERE sayfa_adi=?");
$query->execute(array($adi));
$kontrol = $query->rowCount();
    if($kontrol){
        echo '<div class="alert alert-warning"><strong><span style="color:red;">'.$adi.'</span></strong> isminde baska bir sayfa mevcut; lütfen özgün bir sayfa ismi giriniz!</div>';
        }else{    // aynı ada sahip baska bir sayfa yoksa  ;
            if(!$adi || !$bilgi || !$aciklama || !$durum){
                echo '<div class="alert alert-warning">gerekli alanları doldurmanız gerekiyor.</div>';
                }else{
                    if($_FILES["resim"]){                 // resim yüklenmişse
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
                                            $ok = move_uploaded_file($_FILES["resim"]["tmp_name"],$yuklemeYeri);
                                                if($ok){
                                                $resim = "/tema/default/upload/".$dosyaAdi;
                                                }
                                            }   // if is_uploaded_file
                                        }    // else - dosya tipi jpg ya da png değilse 
                                    }   // else - file_exist()
                                }   // else image max size>700 kb
                            } // if $_FILES["resim"]
                // resim yüklenmemişse boşa eşitleriz.
            if(!$resim){
                $resim = "";
            }
            $update  = $db->prepare("INSERT INTO  sayfalar SET
            sayfa_adi=?,
            sayfa_link=?,
            sayfa_bilgi=?,
            sayfa_aciklama=?,
            sayfa_resim=?,
            sayfa_durum=?
           ");
            $ok = $update->execute(array($adi,$link,$bilgi,$aciklama,$resim,$durum));
            if($ok){
            echo '<div class="alert alert-success">Sayfa basarıyla eklendi, yönlendiriliyorsunuz..</div>';
            }else{
            echo '<div class="alert alert-danger">Sayfa eklenirken bir hata olustu</div>';
            }
          } 
    }   // If gerekli alanlar doldurulmuşsa
            }else{  // if $_POST
            ?>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="col-8">
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Sayfa Adı</label>
                    <input name="adi" type="text" class="form-control">
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">Sayfa Bilgi</label>
                    <input name="bilgi"type="text" class="form-control">
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">Sayfa Acıklaması</label>
                    <textarea name="aciklama" class="form-control my-3 ckeditor" rows="8" style="resize: none;"></textarea>
                </div>
                <div class="form-group m-0">
                    <label class="my-2 " for="">Sayfa Durum</label>
                    <select class="form-control my-2" name="durum">
                        <option value="1">Sayfa Açık</option>
                        <option value="2">Sayfa Kapalı</option>
                    </select>
                </div> 
                <div class="form-group m-0">
                    <label class="m-0 " for="">Sayfa Resim</label>
                    <input name="resim" type="file" class="form-control">
                </div>
                <div style="text-align: center;">
                <button style="position: relative; right: 0;" type="submit" class="btn btn-primary my-2 ">Sayfa Ekle</button>
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