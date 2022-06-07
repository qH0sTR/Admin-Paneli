<?php !defined("admin") ? die("hacking") : null; ?>


<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Urunler</h1>
        </div>
    </div>
</div>  

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-dark" style="display: flex;">
            <span style="justify-self: flex-end !important;">Urunler Bölümü</span> <a href="?do=ekip_ekle" class="btn btn-primary btn-sm" style="margin-left: auto;">Urun Ekle</a>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>Urun Adı</th>
                                            <th>Urun Bilgi</th>
                                            <th>Urun Tarih</th>
                                            <th>Urun Durum</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $db->query("SELECT * FROM ekip
                                                            ORDER BY ekip_id DESC")->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($query as $row){
                                        ?>
                                            <tr style="text-align: center;">
                                                <td><?= $row["ekip_adi"] ?></td>
                                                <td><?= $row["ekip_bilgi"] ?></td>
                                                <td><?= $row["ekip_tarih"] ?></td>
                                                <td style="color: <?= $row['ekip_durum']==1? '#6d5' : 'red'; ?>"><?= $row["ekip_durum"]==1? "onaylı" : "onaylı değil"; ?></td>
                                                <td><a href="?do=ekip_duzenle&id=<?= $row['ekip_id']; ?>" class="btn btn-primary btn-sm">duzenle</a></td>
                                                <td><a href="?do=ekip_sil&id=<?= $row['ekip_id']; ?>" class="btn btn-danger btn-sm">sil</a></td>
                                            </tr>
                                        <?php
                                        }

                                        ?>
                                    </tbody>
                                </table>
            </div>
        </div>
        <div class="panel-footer bg-dark">
            Kolay Video Dersleri --Footer
        </div>
    </div>
</div>