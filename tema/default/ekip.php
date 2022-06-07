<?php
$link = g("link");


if($link){
    $query = $db->prepare("SELECT
                        *
                        FROM ekip
                        WHERE ekip_link=?
                        AND ekip_durum=?");
    $query->execute(array($link,1));
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $kontrol = $query->rowCount();

    if($kontrol){ ?>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
        <li class="breadcrumb-item"><a href="/ekip">Ekip</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $row["ekip_adi"]; ?></li>
    </ol>
    </nav>
        <div class="icerikler"> 
            <div class="baslik"> 
                <h2><?php echo $row["ekip_adi"]; ?></h2>
                <span><?php echo $row["ekip_bilgi"]; ?></span>
            </div>		
            <div class="aciklama"> 
            <?php
                if($row["ekip_resim"]){
                    ?>
                    <?php
                }
            ?>
            <p> 
            <?= $row["ekip_full_aciklama"]; ?>
            </p>
            </div>
        </div>
  <?php  }else{
        echo '<div class="alert alert-danger">404 sayfa bulunamadı</div>';
    }
}else{
    ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ekip</li>
    </ol>
</nav>


<?php
}
?>
