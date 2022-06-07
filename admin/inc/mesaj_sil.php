<?php !defined("admin") ? die("hacking") : null; ?>


<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Mesaj Sil</h1>
        </div>
    </div>
</div>  

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-dark">
        Mesaj Silme İşlemi
        </div>
        <div class="panel-body">
        <?php
        $id = g("id",true);
        if($id){
            $query->execute(array($id));
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $sil = $db->prepare("DELETE FROM mesajlar
                                WHERE mesaj_id=?");
            $ok = $sil->execute(array($id));
            if($ok){
                echo '<div class="alert alert-success">Mesaj Başarıyla Silindi, yönlendiriliyorsunuz..</div>';
                header("refresh:2; url=?do=sayfalar");
            }else{
                echo '<div class="alert alert-danger">Mesaj veritabanından silinirken bir hatayla karsılasıldı</div>';
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