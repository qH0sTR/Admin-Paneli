<?php !defined("admin") ? die("hacking") : null; ?>


<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Firma</h1>
        </div>
    </div>
</div>  

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-dark" style="display: flex;">
            <span style="justify-self: flex-end !important;">Firma Bölümü</span> <a href="?do=sayfa_ekle" class="btn btn-primary btn-sm" style="margin-left: auto;">Sayfa Ekle</a>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align: center;">
                        <th>Firma Bilgi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = $db->query("SELECT * FROM firma
                                        ORDER BY firma_id DESC")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($query as $row){
                    ?>
                    <tr style="text-align: center;">
                        <td class="col-10"><?= $row["firma_bilgi"] ?></td>
                        <td style="text-align: center;">
                        <a class="btn btn-primary" href="?do=firma_duzenle&id=<?= $row['firma_id']?>">Düzenle</a>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="panel-footer bg-dark">
            Kolay Video Dersleri --Footer
        </div>
    </div>
</div>