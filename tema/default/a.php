<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/tema/default/SCSS/vendors/bootstrap-4.6.1/dist/css/bootstrap.css">
</head>
<body>
    <div class="container">serkan</div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/"><img src="" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Anasayfa<span class="sr-only">(current)</span></a>
                </li>
                <a class="nav-link" href="#" id="navbarDropdown" role="button"  aria-expanded="false">
                    biseyler
                </a>
                <li class="nav-item">
                    <a class="nav-link" href="/iletisim">İletişim</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="logControl" href="#" data-toggle="modal" data-target="#OpenModalID3">Giriş Yap</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Aramakla Bulunmaz..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ara</button>
            </form>
        </div>
    </nav>

    <div class="modal fade" tabindex="-1"  role="dialog" id="OpenModalID3" aria-labelledby="ModalTitle3" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="ModalTitle3">Giriniz</h5>
                    <button class="close" data-dismiss="modal" aria-label="Kapat">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div> 
                    <div id="giris" class="modal-body">
                        <form method="post" id="login" action="">
                            <div class="form-group">
                                <label for="email3" class="col-form-label">E-postanız:</label>
                                <input type="email" value="" name="email" class="form-control" id="email3">
                            </div>
                            <div class="form-group">
                                <label for="pass3" class="col-form-label">Şifreniz:</label>
                                <input type="password" value="" name="pass" class="form-control" id="pass3">
                            </div>
                            <div class="form-group form-check">
                                <label for="pass" class="form-check-label">
                                    <input type="checkbox" name="remember" class="form-check-input">Beni Unutma
                                </label>
                            </div>
                            <div class="form-group m-0">
                                <label for="code">Kodu Giriniz</label>
                                <input type="text" class="form-control" id="code" name="code">
                            </div>
                            <div class="modal-footer pt-0"><i><a>Hala Üye Değil misin</a></i>
                            <button type="button" class="btn btn-danger mt-3" data-dismiss="modal">Kapat</button>
                            <button type="button" id="submit" class="btn btn-success px-3 mt-3">Giriş</button>
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="/tema/default/js/jquery.js"></script>
<script src="/tema/default/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> 
</body>
</html>