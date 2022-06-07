<?php !defined("admin") ? die("hacking") : null; ?>
<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Mesajlar</h1>
        </div>
    </div>
</div>  

<div class="col-8">
    <div class="panel panel-defaulr">
        <div class="panel-heading bg-dark">
            Mesaj Oku
        </div>
        <div class="panel-body">
            <?php
                $id = g("id",true);
                if($id){
                    $query = $db->prepare("SELECT * FROM mesajlar
                                        WHERE mesaj_id=?");
                    $query->execute(array($id));
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    $kontrol = $query->rowCount();
                if(!$kontrol){
                        echo '<div class="alert alert-danger">Böyle bir mesaj bulunamadı</div>';
                    }else{
                                if($row["mesaj_okundu"] == 2){
                                    $sorgu =$db->prepare("UPDATE mesajlar SET mesaj_okundu=?
                                                    WHERE mesaj_id=?");
                                $sorgu->execute(array(1,$id));
                                }   // mesaj okunmuşsa okundu yapıyoruz
                        echo    '<div class="col-8">
                                <span style="background-color:#ccc; display:flex; padding:5px; margin-bottom:10px;">gonderen: <i>'.$row["mesaj_gonderen"].'</i>
                                <i style=" margin-left:auto;">tarih: '.$row["mesaj_tarih"].'</i></span>
                                    <p>'.$row["mesaj_aciklama"].'</p>
                                 </div>';
                    }
                }else{
                    echo '<div class="alert alert-danger">Böyle bir id bulunamadı</div>';
                }
            ?>
        </div>
        <div class="panel-footer bg-dark">
            Kolay Video Dersleri Footer
        </div>
    </div>
</div>