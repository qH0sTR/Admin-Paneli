
<?php
include("sistem/ayar.php");
include("sistem/sistem.php");

if($ayarlar["site_durum"] == 1) {
include(tema."/index.php");
}else{
    echo "<h2>site kapalı</h2>";
}
?>
