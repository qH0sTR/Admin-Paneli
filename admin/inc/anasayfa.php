<?php !defined("admin") ? die("hacking") : null; ?>
<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i><span class="ml-2 p-1">Hata Raporla</span></a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- SAYFALAR -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="?do=sayfalar">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Sayfalar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= sayi("sayfalar"); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- URUNLER -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="?do=ekip">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ekip
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= sayi("urunler"); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-pen-square fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- SLIDER -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="?do=slider">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Slider</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= sayi("slider"); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-image fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- MESAJAR -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="?do=mesajlar">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Mesajlar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= sayi("mesajlar");?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- REFERANSLAR -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="?do=referanslar">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            REFERANSLAR</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= sayi("referanslar");?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- SİTE AYARLARI -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="?do=ayarlar">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            SİTE AYARLARI</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= sayi("mesajlar");?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- İLETİŞİM AYARLARI -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="?do=iletisim">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            İLETİŞİM AYARLARI</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= sayi("iletisim");?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="panel panel-default">
                            <div class="panel-heading bg-dark">
                                Site Bilgileri  
                            </div>
                            <div style="min-height: 50px;" class="panel-body">
                                <span style="font-weight: bold;">php versiyon: <?= phpversion(); ?></span><br>
                                <span><?php $dir = $_SERVER["DOCUMENT_ROOT"]."/";  ?></span><br>
                                <span style="font-weight: bold;">toplam dosya boyutu: </span><?php //echo dizinboyutu($dir); ?>
                            </div> 
                            <div class="panel-footer bg-dark">
                                Kolay Video Dersleri
                            </div>
                        </div>

                    </div>
                </div>
