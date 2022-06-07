<?php
include ("fonksiyon.php");
function sayfa_icerik(){
    global $db;
    $do = g("do");

    switch($do){
        case "sayfa":
            include(tema."/sayfalar.php");
            break;
        case "iletisim":
            $query = $db->prepare("SELECT * FROM iletisim");
            $query->execute(array());
            $row = $query->fetch(PDO::FETCH_ASSOC);
            
            $email = $row["iletisim_email"];
            $site = $row["iletisim_site"];
            $telefon = $row["iletisim_telefon"];
            $ilce = $row["iletisim_ilce"];
            include(tema."/iletisim.php");
            break;
        case "ekip":
            include(tema."/ekip.php");
            break;
        default:
        include(tema."/default.php");
            break;
    }
}
function sayfa_menu(){
    global $db;
    $query = $db->prepare("SELECT
                        *
                        FROM sayfalar
                        WHERE sayfa_durum=?");
    $query->execute(array(1));
    $liste = $query->fetchAll(PDO::FETCH_ASSOC);
    $kontrol = $query->rowCount();
    
    if($kontrol){
        define("sayfalar",$liste);
    }else{
        return false;
    }
}
use  PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function iletisim(){
        global $db;
            if($_POST){
                global $db;
                $query = $db->prepare("SELECT
                                    *
                                    FROM iletisim
                                    WHERE iletisim_id=?");
                $query->execute(array(1));
                $row = $query->fetch(PDO::FETCH_ASSOC);

                $isim = p("isim",true);
                $email = p("email",true);
                $konu = p("konu",true);
                $mesaj = p("mesaj",true);
                if(!$isim || !$email || !$konu || !$mesaj){
                    echo '<div class="alert alert-warning col-6">Gerekli alanları doldurmanız gerekiyor.</div>';
                }else if(!filter_var("$email",FILTER_VALIDATE_EMAIL)){
                    echo '<div class="alert alert-danger col-6">Geçerli Bir Email Formatı Değil</div>';
                }else{
                    require $_SERVER["DOCUMENT_ROOT"].'/mail/Exception.php';
                    require $_SERVER["DOCUMENT_ROOT"].'/mail/PHPMailer.php';
                    require $_SERVER["DOCUMENT_ROOT"].'/mail/SMTP.php';
                    $mail = new PHPMailer();
                    try {
                        $mail->isSMTP();                                            
                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;      
                        $mail->SMTPAuth = true;
                        $mail->SetLanguage("tr", "phpmailer/language");
                        $mail->CharSet  ="utf-8";               
                        $mail->Host = 'smtp-mail.outlook.com';
                        $mail->Username   = 'serkanseker3@hotmail.com';                     //SMTP username
                        $mail->Password   = 'xxxxxxxxx';                               //SMTP password
                        $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
                        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    
                        //Alıcılar
                        $mail->setFrom('serkanseker3@hotmail.com',$isim);
                        $mail->addAddress($row["iletisim_email"]);    
                        $mail->addReplyTo($email,$isim) ;
                    
                        //İçerik
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = $konu;
                        $mail->Body    = 'gonderen: '.$isim.'<br>eposta: '.$email.'<br>mesaj: '.$mesaj;
                        $mail->send();
                        echo '<div class="alert alert-success">Mesaj gönderildi</div>';
                        $insert = $db->prepare("INSERT INTO mesajlar SET
                                                mesaj_gonderen=?,
                                                mesaj_baslik=?,
                                                mesaj_eposta=?,
                                                mesaj_aciklama=?
                                                ");
                        $ok = $insert->execute(array($isim,$konu,$email,$mesaj));
                        if($ok){

                        }else{
                            echo '<div class="alert alert-warning">mesaj gönderildi fakat veri tabanına eklenirken bir sorunla karsılaıldı</div>';
                        }
                    }catch (Exception $e) {
                        echo "Mesaj Gönderilemedi Hata: {$mail->ErrorInfo}";
                    }
                    
                }
            }
}
function slider(){
    global $db;
    $query = $db->prepare("SELECT * FROM slider
                                        ORDER BY slider_id DESC");
                    $query->execute(array());
                    $liste = $query->fetchAll(PDO::FETCH_ASSOC);
                    $kontrol = $query->rowCount();
                    if($kontrol){
                        define("slider",$liste);
                        
                    }else{
                        return false;
                    }
}
function referanslar(){
    global $db;
    $query = $db->query("SELECT * FROM referanslar
                        ORDER BY referans_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    foreach($query as $row){
    ?>
        <button class="btn btn-default">
        <div width="200" height="120" class="slide"><img title="<?= $row['referans_aciklama']; ?>" src="<?= $row['referans_resim'];?>"></div>
        </button>    
    <?php
    }

}
function tablo($konu){
    global $db;
    $query = $db->prepare("SELECT * FROM {$konu}");
    $query->execute(array());
    $kontrol = $query->rowCount();
    if($kontrol){
        $liste = $query->fetchAll(PDO::FETCH_ASSOC);
        define($konu,$liste);
    }else{
        return false;
    }
}
function sayi($konu){
    global $db;
    $query = $db->prepare("SELECT * FROM {$konu}");
    $query->execute(array());
    $query->fetchAll(PDO::FETCH_ASSOC);
    $say = $query->rowCount();
    return $say;
}
 function firma(){
     global $db;
     $query = $db->query("SELECT * FROM  firma
                            ORDER BY firma_id ASC");
    $query = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($query as $row){
        ?>
            <h2><?= $row["firma_bilgi"]; ?></h2>
            <?= $row["firma_aciklama"]; ?>
        <?php
    }
 }
 function menu_alt(){
    global $db;
    $query = $db->prepare("SELECT
                        *
                        FROM sayfalar
                        WHERE sayfa_durum=?");
    $query->execute(array(1));
    $liste = $query->fetchAll(PDO::FETCH_ASSOC);
    $kontrol = $query->rowCount();

    if($kontrol){
        foreach($liste as $row){
        echo '<li><a href='.$row["sayfa_link"].'>'.$row["sayfa_adi"].'</a></li>';
        }
    }else{
        return false;
    }
}
 function dizinboyutu($dizin){
    $bayt = 0;
    $dzn = opendir($dizin);
    if(!$dzn) {return -1; };
    while($dosya = readdir($dzn)){
        if($dosya[0] == ".") { continue; }
        if(is_dir($dizin.$dosya)){
            $bayt+=dizinboyutu($dizin.$dosya.DIRECTORY_SEPARATOR);
        }else{
            $bayt+= filesize($dizin.$dosya);
        }
    }
    closedir($dzn);
    return $bayt;
 }
?>