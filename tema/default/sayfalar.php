<?php
$link = g("link"); ?>





<?php
if($link){
    $query = $db->prepare("SELECT
                        *
                        FROM sayfalar
                        WHERE sayfa_link=?
                        AND sayfa_durum=?");
    $query->execute(array($link,1));
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $kontrol = $query->rowCount();

    if($kontrol){ ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $row["sayfa_adi"]; ?></li>
        </ol>
    </nav>
        <div class="icerikler"> 
            <div class="baslik"> 
                <h2><?php echo $row["sayfa_adi"]; ?></h2>
                <h4><p><?php echo $row["sayfa_bilgi"]; ?></p></h4>
            </div>		
            <div class="aciklama"> 
                
            <?php
                if($row["sayfa_resim"]){
                    ?>
                    <img style="float: left;" src="<?= $row["sayfa_resim"];?>" width="400" height="300" alt="" />
                    <?php
                }
            ?>
            
            <?= $row["sayfa_aciklama"]; ?> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae quae aperiam soluta atque ullam sint eum, excepturi reprehenderit quod odit, ea, fuga porro. Ipsam adipisci veniam, totam vero nobis ratione dolorem architecto blanditiis nulla voluptatem aliquid tempore dolor tenetur assumenda possimus facilis libero, esse aliquam vitae ad modi numquam. Odio, error nihil dolorem et dolores quae doloremque corporis veniam aliquid corrupti dolore cum sunt sapiente amet laboriosam atque aut debitis neque necessitatibus delectus excepturi. Numquam obcaecati, maxime aspernatur beatae incidunt porro facere amet ad culpa provident rerum eum voluptates. Est iure voluptatibus sapiente velit fugit repellendus laudantium nulla architecto ipsa unde at voluptate corrupti error aliquid, nemo ea deleniti cum laboriosam consequuntur repudiandae maiores inventore quod. Ipsam officiis sunt laudantium modi voluptatem eum eligendi obcaecati animi ad quasi soluta laborum consequatur aspernatur temporibus suscipit architecto rerum nihil provident blanditiis, quia mollitia. Culpa sequi quis eaque rerum doloribus quibusdam accusamus magnam est quae, tenetur reprehenderit odio sit at, excepturi pariatur. Odio expedita quasi, autem sequi est totam consequuntur in. Vero sequi necessitatibus et corporis quibusdam explicabo totam officiis tenetur eaque. Impedit numquam facere delectus. Quis illo ducimus quibusdam molestiae, quaerat recusandae perferendis nostrum, illum culpa, exercitationem nobis quam ipsum quod at?
            </div>
        </div>
  <?php  }else{
        echo '404 sayfa bulunamadı';
    }
}else{
    $hata = "404 sayfa değeri yok...";
    include(tema."/hata.php");
}
?>
