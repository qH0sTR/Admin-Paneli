<?php !defined("admin") ? die("hacking") : null; ?>

<div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ADMIN PANELİ</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="/admin/">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Anasayfa</span></a>
            </li>

    <!-- Nav Item - Pages Collapse Menu1 -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Genel</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item" href="?do=sayfalar">Sayfalar</a>
                <a class="collapse-item" href="?do=ekip">Ekip</a>
                <a class="collapse-item" href="?do=slider">Slider</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Utilities Collapse Menu2 -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Yapılandırma</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Temel Ayarlar</h6>
                <a class="collapse-item" href="/admin/?do=ayarlar">Ayarlar</a>
                <a class="collapse-item" href="#">Colors</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu3 -->
    <li class="nav-item">
        <a class="nav-link" href="?do=referanslar">
            <i class="fas fa-regular-fw fa-registered"></i>
            <span>Referanslar</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?do=firma">
            <i class="fas fa-solid fa-city"></i>
            <span>Firma</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?do=mesajlar">
            <i class="fas fa-fw fa-book"></i>
            <span>Mesajlar</span></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="/admin/?do=iletisim">
        <i class="fas fa-phone"></i>
        <span>iletisim</span></a>
    </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                   
                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Ara..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Ara..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- MESAJLAR-->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <?php
                                $query = $db->prepare("SELECT * FROM  mesajlar
                                WHERE mesaj_okundu=?");
                                $query->execute(array(2));
                                $liste = $query->fetchAll(PDO::FETCH_ASSOC);
                                $kontrol = $query->rowCount();
                                ?>
                                <span class="badge badge-danger badge-counter"><?= $kontrol; ?>
                                </span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Mesajlar
                                </h6>
                                <?php
                                    if($kontrol){
                                    $query = $db->prepare("SELECT * FROM  mesajlar
                                    ORDER BY mesaj_okundu DESC,
                                    mesaj_tarih DESC
                                    LIMIT 5");
                                    $query->execute(array());
                                    $liste = $query->fetchAll(PDO::FETCH_ASSOC);
                                    $kontrol = $query->rowCount();
                                        foreach($liste as $row){
                                            ?>
                                        <a class="dropdown-item d-flex align-items-center" href="?do=mesaj_oku&id=<?= $row['mesaj_id'] ?>">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                                    alt="...">
                                                <div class="status-indicator"></div>
                                            </div>
                                            <div>
                                                <div class="text-truncate <?=
                                                $row["mesaj_okundu"]== 1? "text-muted" :"s";
                                                ?>"><?= mb_substr($row["mesaj_aciklama"],0,30,"UTF-8");?></div>
                                                <div class="small text-gray-500"><?= $row["mesaj_gonderen"].' . '.timeConvert($row["mesaj_tarih"]);?></div>
                                            </div>
                                        </a>    
                                            <?php
                                        }
                                    }else{
                                        echo '<a class="dropdown-item d-flex align-items-center" href="#">
                                        <div>
                                            <div class="alert alert-warning">Üzgünüm, hiç mesajınız yok...</div>
                                            <div class="small text-gray-500"><?= $row["mesaj_gonderen"].' . '.timeConvert($row["mesaj_tarih"]);?></div>
                                        </div>
                                    </a>   ' ;
                                    }
                                ?>
                                <a class="dropdown-item text-center small text-gray-500" href="?do=mesajlar">Tüm Mesajları Görüntüle</a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Serkan ŞEKER</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="?do=profil_duzenle&id=<?= $_SESSION['id']; ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ayarlar
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Çıkış
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

   


                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?php 
                $do = @g("do"); 
                if(file_exists("inc/".$do.".php")){ 
                    include("inc/".$do.".php");
                }else{
                    include("inc/anasayfa.php"); 
                    }
                ?>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/admin/?do=cikis">Logout</a>
                </div>
            </div>
        </div>
    </div> 

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

  