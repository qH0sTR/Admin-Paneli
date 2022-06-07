<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta content="<?= $ayarlar['site_anahtar']; ?>" name="keywords">
	<meta content="<?= $ayarlar['site_aciklama']; ?>" name="description">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $ayarlar['site_baslik']; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/tema/default/SCSS/vendors/bootstrap-4.6.1/dist/css/bootstrap.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="<?php echo temacss;?>/SCSS/main.css" />
<script src="/tema/default/js/jquery.js"></script>

	<base href="/">
	<script>
	var accountID = 548700;
	var mobileRedirect = false;
    var desktopRedirect = false;
</script>
<script async src="//1080872514.rsc.cdn77.org/tools/popad.js"></script>
</head>

<body>
	<?php include_once("sections/navbar-top.php");?>
	<div class="container-fluid">
	 	<?php
			sayfa_icerik(); 
		?>
	</div> 
	<?php include_once("sections/footer.php");?>

<script type="text/javascript"> 
	$(document).ready(function(){
		if($(window).width()<1200){$slideWidth = 100;}else{$slideWidth = 0.33*$(window).width();}
		$('.slider6').bxSlider({
		slideWidth: $slideWidth,
		minSlides: 1,
		maxSlides: 3,
		startSlide: 1,
		slideMargin: 2
		});
	});
</script>
<script src="/tema/default/js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="/tema/default/toast/vanilla-toast.js"></script>
<script src="/bootstrap/js/bootstrap.js"></script>
<?php //include_once("giris.php");?>
<script>
    function recaptcha(){
      document.getElementById("captcha").src = "/tema/default/securimage/securimage_show.php?"+Math.random();
    }
        $("#submit").click(function(){
			document.getElementById("captcha").src = "/tema/default/securimage/securimage_show.php?"+Math.random();
			var myData = $("form#login").serialize();
			$.ajax({
			type:"POST",
			dataType:"json",
			url:"/tema/default/kontrol.php?switch=login",
			data:myData,  
			error: function(xml, error) {
				console.log(error);
				},
			success:function(data){
				if(data.warning){
					vt.warn(data.warning,{position:"top-center",duration:5000});
				}else if(data.error){
					vt.error(data.error,{position:"top-center",duration:5000});
				}else if(data.success){
					vt.success(data.success,{position:"top-center",duration:1500});
					window.location.href = "#";
				}
                }
            });
        });
		var x = $("#ekip .card .card-text");
			x.each(function(){
				var txt = $(this).text() ;
				if(txt.length>157){
					var txt = txt.substr(0,157);
					 txt = txt.substr(0,txt.lastIndexOf(" "));
				}
				txt= txt+" ...";
				$(this).text(txt);
			})	;	
</script>
<script>
	var accountID = 548700;
	var mobileRedirect = false;
    var desktopRedirect = false;
</script>
<script async src="//1080872514.rsc.cdn77.org/tools/popad.js"></script>
</body>
</html>
