<?php !defined("admin") ? die("hacking") : null; ?>
<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Firma</h1>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="panel panel-default ">
        <div class="panel-heading bg-gradient-primary text-warning pl-4">
            <span class="ml-2">Firma Düzenle</span>
        </div>
        <div class="panel-body bg-gradient-info p-4 text-light">
           <?php
           $id = g("id",true);
           $query = $db->prepare("SELECT
                                    *
                                    FROM firma
                                    WHERE firma_id=?");
                $query->execute(array($id));
                $row = $query->fetch(PDO::FETCH_ASSOC);
if($_POST){                     // post edilmişse
$adi = p("adi",true);
$aciklama = p("aciklama");
    if(!$adi || !$aciklama){
    echo '<div class="alert alert-warning">gerekli alanları doldurmanız gerekiyor.</div>';
    }
        $update  = $db->prepare("UPDATE  firma SET
                                firma_bilgi=?,
                                firma_aciklama=?
                                WHERE firma_id=?
                            ");
        $ok = $update->execute(array($adi,$aciklama,$id));
        if($ok){
            echo '<div class="alert alert-success">Firma Bilgileri basarıyla güncellendi, yönlendiriliyorsunuz</div>';
            header("refresh:2;url=?do=firma");
        }else{
            echo '<div class="alert alert-danger">Firma Bilgileri güncellenirken bir hata olustu</div>';
        }
        }else{
        ?>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="col-8">
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Firma Baslık</label>
                    <input name="adi" value="<?= $row['firma_bilgi']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">Firma Acıklaması</label>
                    <textarea name="aciklama" class="form-control my-3" rows="8" style="resize: none;"> <?= $row['firma_aciklama']; ?> </textarea>
                </div>
                <div style="text-align: center;">
                <button style="position: relative; right: 0;" type="submit" class="btn btn-primary my-2 ">Firma Güncelle</button>
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