<?php
session_start();
ob_start();


try {
    $host  = "localhost";   
    //$host  = "sql302.epizy.com";
    $dbname = "firma";
    //$dbname = "epiz_31129351_database";
    $username = "root";
    //$username = "epiz_31129351";
    $pass = "";
    //$pass = "B9DOF4d3Ymx";
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username,$pass);
}catch(PDOException $mesaj){
    echo $mesaj->getMessage();
}

$iletisim = $db->query("SELECT 
                *
                FROM iletisim")->fetch(PDO::FETCH_ASSOC);
$ayarlar = $db->query("SELECT 
                *
                FROM ayarlar")->fetch(PDO::FETCH_ASSOC);
$root = $_SERVER["DOCUMENT_ROOT"];
define("tema","tema/".$ayarlar["site_tema"]);
define("tema_dir",$ayarlar["site_tema"]);
define("temacss","/tema/".$ayarlar["site_tema"]);
?>