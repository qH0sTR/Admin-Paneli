<?php !defined("admin") ? die("hacking") : null; ?>


<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Referans Sil</h1>
        </div>
    </div>
</div>  

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-dark">
        Referans Silme İşlemi
        </div>
        <div class="panel-body">
        <?php
        $id = g("id",true);
        if($id){
            $query = $db->prepare("SELECT * FROM referanslar
                                WHERE referans_id=?");
            $query->execute(array($id));
            $row = $query->fetch(PDO::FETCH_ASSOC);
            if(!is_dir($_SERVER["DOCUMENT_ROOT"].$row["referans_resim"])){
                unlink($_SERVER["DOCUMENT_ROOT"].$row["referans_resim"]);
            }
            $sil = $db->prepare("DELETE FROM referanslar
                                WHERE referans_id=?");
            $ok = $sil->execute(array($id));
            if($ok){
                echo '<div class="alert alert-success">referans Başarıyla Silindi, yönlendiriliyorsunuz..</div>';
                header("refresh:2; url=?do=referanslar");
            }else{
                echo '<div class="alert alert-danger">referans veritabanından silinirken bir hatayla karsılasıldı</div>';
            }
        }else{
            echo '<div class="alert alert-warning">Böyle bir id bulunamadı</div>';
        }
        ?>
        </div>
        <div class="panel-footer bg-dark">
           Kolay Video Dersleri Footer
        </div>
    </div>
</div>