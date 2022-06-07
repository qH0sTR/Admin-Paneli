<?php !defined("admin") ? die("hacking") : null; ?>
<?php
session_destroy();
header("refresh: 2; url=/admin/");
?>

<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>
</div>  

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-dark">
            Default Panel
        </div>
        <div class="panel-body">
            <div class="alert alert-success m-0">basarıyla cikis yaptınız, yönlendircem az bekle</div>
        </div>
        <div class="panel-footer bg-dark">
            Panel Footer
        </div>
    </div>
</div>