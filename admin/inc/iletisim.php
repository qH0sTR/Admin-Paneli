<?php !defined("admin") ? die("hacking") : null; ?>
<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">İletisim</h1>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="panel panel-default ">
        <div class="panel-heading bg-gradient-primary text-warning pl-4">
            <span class="ml-2">İletisim Düzenle</span>
        </div>
        <div class="panel-body bg-gradient-info p-4 text-light">
           <?php
            if($_POST){
                $email = p("email",true);
                $telefon = p("telefon",true);
                $site = p("site",true);
                $ilce = p("ilce",true);
                $adres = p("adres",true);
                $facebook = p("facebook",true);
                $twitter = p("twitter",true);
                $instagram = p("instagram",true);
                $linkedin = p("linkedin",true);
                $pinterest = p("pinterest",true);
                
                if(!$email || !$telefon || !$site || !$ilce || !$adres || !$facebook || !$twitter || !$instagram){  
                    echo '<div class="alert alert-warning">gereki alanları doldurmanız gerekiyor</div>';
                }else{
                    $update = $db->prepare("UPDATE
                                            iletisim
                                            SET
                                            iletisim_email=?,
                                            iletisim_telefon=?,
                                            iletisim_site=?,
                                            iletisim_ilce=?,
                                            iletisim_adres=?,
                                            iletisim_facebook=?,
                                            iletisim_twitter=?,
                                            iletisim_instagram=?,
                                            iletisim_linkedin=?,
                                            iletisim_pinterest=?
                                            WHERE 
                                            iletisim_id=?
                                            ");
                    $ok = $update->execute(array($email,$telefon,$site,$ilce,$adres,$facebook,$twitter,$instagram,$linkedin,$pinterest,1));
                    if($ok){
                        echo '<div class="alert alert-success">iletisim basarıyla güncellendi , yönderiliyorsunuz; sıkı tutunun!</div>';
                        header("refresh:2;url=/admin/?do=iletisim");
                    }else{
                        echo '<div class="alert alert-danger">iletisim güncellenirken bir hata olustu..</div>';
                    }
                }
            }else{
                $query = $db->prepare("SELECT
                                    *
                                    FROM iletisim
                                    WHERE iletisim_id=?");
                $query->execute(array(1));
                $row = $query->fetch(PDO::FETCH_ASSOC);
                ?>
            <form action="" method="post">
            <div class="col-6">
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Email</label>
                    <input name="email" value="<?= $row['iletisim_email']; ?>" type="email" class="form-control">
                </div>
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Telefon</label>
                    <input name="telefon" value="<?= $row['iletisim_telefon']; ?>" type="number" class="form-control">
                </div>
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Site</label>
                    <input name="site" value="<?= $row['iletisim_site']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">İlce</label>
                    <input name="ilce" value="<?= $row['iletisim_ilce']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group m-0">
                    <label class="m-0 " for="">Adres</label>
                    <textarea name="adres" class="form-control my-3" rows="4" style="resize: none;"> <?= $row['iletisim_adres']; ?></textarea>
                </div>
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Facebook</label>
                    <input name="facebook" value="<?= $row['iletisim_facebook']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Twitter</label>
                    <input name="twitter" value="<?= $row['iletisim_twitter']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Instagram</label>
                    <input name="instagram" value="<?= $row['iletisim_instagram']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">LinkedIn</label>
                    <input name="linkedin" value="<?= $row['iletisim_linkedin']; ?>" type="text" class="form-control">
                </div>
                <div class="form-group py-2 ">
                    <label class="m-0 " for="">Pinterest</label>
                    <input name="pinterest" value="<?= $row['iletisim_pinterest']; ?>" type="text" class="form-control">
                </div>
                
                <div style="text-align: center;">
                    <button style="position: relative; right: 0;" type="submit" class="btn btn-primary my-2 ">İletişim Bilgilerini Güncelle</button>
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