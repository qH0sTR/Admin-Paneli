<script>
    function recaptcha(){
      document.getElementById("captcha").src = "/tema/default/securimage/securimage_show.php?"+Math.random();
    }
        $("#submit").click(function(){
            var myData = $("form#login").serialize();
            $.ajax({
                type:"post",
                dataType:'json',
                url:"/tema/default/giris-kontrol.php?switch=login",
                data:myData,  
                success:function(data){
                    alert(1);
                    if(data.warning){
                        vt.warn(data.warning,{position:"top-center",duration:5000});
                }else if(data.error){
                    vt.error(data.error,{position:"top-center",duration:5000});
                }else if(data.success){
                    vt.success(data.success,{position:"top-center",duration:1500});
                    window.location.href = "http://localhost/hayaletdesign";
                }
                }
            });
        });
</script>
<?php

    if($_POST){
        $isim = p("isim");
        $sifre = p("sifre");
        if(!$isim || !$sifre){
            echo '<div class="alert alert-warning">uye adı ya da sifre boş bırakılamaz</div>';
        }else{
            $sifre = md5($sifre);
            $query = $db->prepare("SELECT
                                *
                                FROM uyeler
                                WHERE uye_adi=?
                                AND uye_sifre=?");
            $query->execute(array($isim,$sifre));
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $kontrol = $query->rowCount();

            if($kontrol){
                $_SESSION["login"] = true;
                $_SESSION["uye"] = $row["uye_adi"];
                $_SESSION["id"] = $row["uye_id"];
                $_SESSION["rutbe"] = $row["uye_rutbe"];
                header("location:/admin/");
            }else{
                echo '<div class="alert alert-danger">uye adı ya da sifreniz yanlıs</div>';
            }
        }
    }
?>