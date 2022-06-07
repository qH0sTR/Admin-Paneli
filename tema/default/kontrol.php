<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/sistem/fonksiyon.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/sistem/ayar.php";
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'){
    die('Erişimin yok hacı');
}
$data = array();
$switch = g("switch",true);
switch($switch){
    case "login":
        $email = p("email",true);
        $pass = p("pass",true);
        $remember = p("remember",true);
        $code = $_POST["code"];
        include_once __DIR__.'/securimage/securimage.php';
        $securimage = new Securimage();
        if ($securimage->check($code) == false){
            $data["error"] = "Güvenlik kodu hatalı!";
        }else{
                $query = $db->prepare("SELECT
                            *
                            FROM
                            site_uyeler
                            WHERE 
                            site_uyeler_eposta=? AND
                            site_uyeler_sifre=?
                            ");
                $query->execute(array($email,$pass));
                $kontrol = $query->rowCount();
                if($kontrol){
                    $ok = $query->fetch(PDO::FETCH_ASSOC);
                    $data["success"]= "basarıyla giriş yaptınız!";
                }else{
                    $data["error"]= "email ya da şifreniz hatalı..";
                }
        }
        echo json_encode($data);
break;

case "logout":
    session_destroy();
    header("refresh: 2; url=/");
break;
}
?>