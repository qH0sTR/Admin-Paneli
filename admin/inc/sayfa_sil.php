<?php !defined("admin") ? die("hacking") : null; ?>


<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sayfa Sil</h1>
        </div>
    </div>
</div>  

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-dark">
            Sayfa Silme İşlemi
        </div>
        <div class="panel-body">
        <?php
        $id = g("id",true);
        if($id){
            $query = $db->prepare("SELECT * FROM sayfalar
                                WHERE sayfa_id=?");
            $query->execute(array($id));
            $row = $query->fetch(PDO::FETCH_ASSOC);
            if(!is_dir($_SERVER["DOCUMENT_ROOT"].$row["sayfa_resim"])){
                unlink($_SERVER["DOCUMENT_ROOT"].$row["sayfa_resim"]);
            }
            $sil = $db->prepare("DELETE FROM sayfalar
                                WHERE sayfa_id=?");
            $ok = $sil->execute(array($id));
            if($ok){
                echo '<div class="alert alert-success">Sayfa Başarıyla Silindi, yönlendiriliyorsunuz..</div>';
                header("refresh:2; url=?do=sayfalar");
            }else{
                echo '<div class="alert alert-danger">Sayfa veritabanından silinirken bir hatayla karsılasıldı</div>';
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