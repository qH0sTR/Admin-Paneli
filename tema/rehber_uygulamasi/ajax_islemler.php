<?php
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    die('Erişimin yok hacı');
}

use projem\db\Database;

require_once("database.php");
$db = new Database();
$operation = $_POST["operation"];
switch ($operation) {
    case 'sil':
        $ID = $_POST['id'];
        $del = $db->Delete("DELETE FROM rehber WHERE rehber_id=?", array($ID));
        if ($del) {
            $message = ['title' => '', 'content' => 'Kayıt Silindi', 'situation' => 'success'];
        } else {
            $message = ['title' => '', 'content' => 'Kayıt silme başarısız oldu', 'situation' => 'error'];
        }
        echo json_encode($message);
        break;
    case 'ekle':
        $SQL = $_POST['sql'];
        $rehber_telefon = $_POST["rehber_telefon"];
        $get_rows = $db->getRows("SELECT 
                                * 
                                FROM 
                                rehber");
        $telefon_onay = true;
        foreach ($get_rows as $key => $value) {
            if ($value->rehber_telefon == $rehber_telefon) {
                $telefon_onay = false;
                $message = ['error' => 'Telefon numarası mevcut, lütfen baska bir numara giriniz!'];
            }
        }
        if ($telefon_onay) {
            $ekle = $db->Insert($SQL);
            if ($ekle) {
                $message = ['success' => 'Kayıt/Kayıtlar Eklendi'];
            } else {
                $message = ['error' =>  'Kayıt ekleme başarısız oldu :('];
            }
        }
        echo json_encode($message);

        break;
    case 'guncelle':
        $rehber_id = $_POST['rehber_id'];
        $rehber_ad = $_POST['rehber_ad'];
        $rehber_soyad = $_POST['rehber_soyad'];
        $rehber_telefon = $_POST['rehber_telefon'];
        $get_row = $db->getRow("SELECT 
                                * 
                                FROM 
                                rehber
                                WHERE rehber_id=?", array($rehber_id));
        if ($get_row) {
            if ($rehber_ad == $get_row->rehber_ad && $rehber_soyad == $get_row->rehber_soyad && $rehber_telefon == $get_row->rehber_telefon) {
                $message = ['666' => '666'];
            } else {
                $get_rows = $db->getRows("SELECT 
                                        * 
                                        FROM 
                                        rehber");
                $id_onay = false;
                $telefon_onay = true;
                foreach ($get_rows as $key => $value) {
                    if ($value->rehber_id == $rehber_id) {
                        $id_onay = true;
                    } else {
                        if ($value->rehber_telefon == $rehber_telefon) {
                            $telefon_onay = false;
                            $message = ['error' => 'Telefon numarası mevcut, lütfen baska bir numara giriniz!'];
                        }
                    }
                }
                if ($id_onay && $telefon_onay) {
                    $update_row = $db->Update("UPDATE rehber SET
                                    rehber_ad=?,
                                    rehber_soyad=?,
                                    rehber_telefon=?
                                    WHERE rehber_id=?
                                    ", array($rehber_ad, $rehber_soyad, $rehber_telefon, $rehber_id));
                    if ($update_row) {
                        $message = ['success' => 'Rehber güncellendi'];
                    } else {
                        $message = ['error' => 'Rehber güncellenirken bir solun olustu'];
                    }
                }
            }
        } else {
            $message = ['error' => 'İlgili rehber satırına ulasılamadı :('];
        }
        echo json_encode($message);

        break;
    default:
        $rehber = $db->getRows("
                                SELECT 
                                *
                                FROM rehber");
        echo json_encode($rehber);
}
