<?php !defined("admin") ? die("hacking") : null; ?>
<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="panel panel-default ">
        <div class="panel-heading bg-gradient-primary text-warning pl-4">
            <span class="ml-2">Araylar Bölümü</span>
        </div>
        <div class="panel-body bg-gradient-info p-4 text-light">
           <?php
            if($_POST){
                $baslik = p("baslik");
                $aciklama = p("aciklama");
                $keyw = p("keyw");
                $tema = p("tema");
                $durum = p("durum");
                
                if(!$baslik || !$aciklama || !$keyw || !$durum){
                    echo '<div class="alert alert-warning">gereki alanları dolrurmanız gerekiyor</div>';
                }else{
                    $update = $db->prepare("UPDATE
                                            ayarlar
                                            SET
                                            site_baslik=?,
                                            site_aciklama=?,
                                            site_anahtar=?,
                                            site_tema=?,
                                            site_durum=?
                                            WHERE 
                                            site_id=?
                                            ");
                    $ok = $update->execute(array($baslik,$aciklama,$keyw,$tema,$durum,1));
                    if($ok){
                        echo '<div class="alert alert-success">ayarlar basarıyla kaydedildi , yönderiliyorsunuz; sıkı tutunun!</div>';
                        header("refresh:2;url=/admin/?do=ayarlar");
                    }else{
                        echo '<div class="alert alert-danger">ayarlar güncellenirken bir hata olustu..</div>';
                    }
                }
            }else{
                $query = $db->prepare("SELECT
                                    *
                                    FROM ayarlar
                                    WHERE site_id=?");
                $query->execute(array(1));
                $row = $query->fetch(PDO::FETCH_ASSOC);
                ?>
            <form action="" method="post">
            <div class="col-6">
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Site Baslık</label>
                    <input name="baslik" value="<?= $row['site_baslik']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">Site Acıklaması</label>
                    <textarea name="aciklama" class="form-control my-3" rows="3" style="resize: none;"> <?= $row['site_aciklama']; ?> </textarea>
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">Anahtar Kelimeler <span class="text-warning">( Virgül İle Ayırın  bkz: <code>php,css,html</code> )</span></label>
                    <textarea name="keyw" class="form-control my-3" rows="3" style="resize: none;"> <?= $row['site_anahtar']; ?> </textarea>
                </div>
                <div class="form-group m-0">
                    <label class="mb-2 " for="">Site Tema<span class="text-warning">( Virgül İle Ayırın  bkz: <code>php,css,html</code> )</span></label>
                    <select class="form-control my-2" name="tema">
                        <?php  klasor("../tema"); ?>
                    </select>
                </div>
                <div class="form-group m-0">
                    <label class="my-2 " for="">Site Durum<span class="text-warning">( Virgül İle Ayırın  bkz: <code>php,css,html</code> )</span></label>
                    <select class="form-control my-2" name="durum">
                        <option <?= $row["site_durum"]=="1"? "selected" : null; ?> value="1">Site Acık</option>
                        <option <?= $row["site_durum"]=="2"? "selected" : null; ?> value="2">Site Kapalı</option>
                    </select>
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