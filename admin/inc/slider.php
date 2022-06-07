<?php !defined("admin") ? die("hacking") : null; ?>


<div id="page wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Slider</h1>
        </div>
    </div>
</div>  

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading bg-dark" style="display: flex;">
            <span style="justify-self: flex-end !important;">Slider Bölümü</span> <a href="?do=slider_ekle" class="btn btn-primary btn-sm" style="margin-left: auto;">Slider Ekle</a>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>slider Resmi</th>
                                            <th>slider adı</th>
                                            <th>slider Tarih</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $db->query("SELECT * FROM slider
                                                            ORDER BY slider_id DESC")->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($query as $row){
                                        ?>
                                            <tr style="text-align: center;">
                                                <td><img src="<?= $row["slider_resim"] ?>" width="250" height="150" alt=""></td>
                                                <td><?= $row["slider_adi"] ?></td>
                                                <td><?= $row["slider_tarih"] ?></td>
                                                <td><a href="?do=slider_duzenle&id=<?= $row['slider_id']; ?>" class="btn btn-primary btn-sm">duzenle</a></td>
                                                <td><a href="?do=slider_sil&id=<?= $row['slider_id']; ?>" class="btn btn-danger btn-sm">sil</a></td>
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