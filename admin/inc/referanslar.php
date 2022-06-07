<?php !defined("admin") ? die("hacking") : null; ?>


<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Referanslar</h1>
        </div>
    </div>
</div>  

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-dark" style="display: flex;">
            <span style="justify-self: flex-end !important;">Referanslar Bölümü</span> <a href="?do=referans_ekle" class="btn btn-primary btn-sm" style="margin-left: auto;">Referans Ekle</a>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>referans Resmi</th>
                                            <th>referans adı</th>
                                            <th>referans Tarih</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $db->query("SELECT * FROM referanslar
                                                            ORDER BY referans_id DESC")->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($query as $row){
                                        ?>
                                            <tr style="text-align: center;">
                                                <td><img src="<?= $row["referans_resim"] ?>" width="250" height="150" alt=""></td>
                                                <td style="vertical-align: middle;"><?= $row["referans_adi"] ?></td>
                                                <td style="vertical-align: middle;"><?= $row["referans_tarih"] ?></td>
                                                <td style="vertical-align: middle;">
                                                <a href="?do=referans_duzenle&id=<?= $row['referans_id']; ?>" class="btn btn-primary btn-sm">duzenle</a>
                                                <a style="padding: 4px 25px;" href="?do=referans_sil&id=<?= $row['referans_id']; ?>" class="btn btn-danger btn-sm">sil</a>
                                                </td>
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