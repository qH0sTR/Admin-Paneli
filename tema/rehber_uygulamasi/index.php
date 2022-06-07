<?php
if (!empty($_POST))
    echo "selam"; {
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$link = $_GET["link"];
echo $x;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    <link rel="stylesheet" href="/<?= tema; ?>/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
    <link rel="stylesheet" href="/<?= tema; ?>/style.css">
</head>
<?php
if ($link == "ekle") {
    include("ekle.php");
} else { ?>

    <body>
        <div class="container">
            <div class="row">
                <div class="kol col-12">
                    <div class="top_baslik">
                        <a href="/" class="baslik" style="margin-bottom: 25px;">Rehber </a>
                        <span class="ekle"><button class="btn btn-primary">Ekle</button></span>
                        <span id="search"><i class='fas fa-search'></i></span>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead id="rehber_thead">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ad</th>
                                    <th scope="col">Soyad</th>
                                    <th class="telefon_col" scope="col">Telefon Numarası</th>
                                    <th>Duzenle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>
                            <tbody id="rehber" />
                        </table>
                    </div>
                    <nav id="paginate"></nav>
                </div>
            </div>
        </div>
    </body>
    <script src="/<?= tema; ?>/vendor/jquery/jquery_3.6.js"></script>
    <script src="/<?= tema; ?>/vendor/toast/vanilla-toast.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.14/dist/sweetalert2.all.min.js"></script>
    <script src="/<?= tema; ?>/dial.js"></script>
    <script>
        var alan_kodlari_options = "",
            selectbox = ""
        new Promise((resolve, reject) => {
            $.getJSON("/<?= tema; ?>/alan_kodlari.json", function(json) {
                resolve(json)
            })
        }).then((json) => {
            json.forEach(element => {
                alan_kodlari_options += "<option value='" + element.dial_code + "'>" + element.name + "</option>"
            });
            selectbox = "<select class='form-control col-3 alan_kod_selectbox editing'><option value= '' selected>Seçiniz </option>" + alan_kodlari_options + "</select>"
        })

        var focused = true
        $("table").on("change", ".alan_kod_selectbox", function(e) {
            var input = $(this).parent().children().eq(1)
            var input_text = input.children("input").val()
            var telefon = input_text.slice(input_text.indexOf(") ") + 2, input_text.length)
            var yeni_alan_kodu = "(" + e.target.value + ") "
            var yeni_telefon = yeni_alan_kodu + telefon
            input.children("input").val(yeni_telefon)
            // console.log(yeni_telefon)
        })
    </script>
    <script>
        $(function() {
            var ayarlar = {
                toplam_satir_sayisi: 0,
                sayfa_basi_kayit_sayisi: 5,
                toplam_sayfa_sayisi: 0,
                suanki_sayfa: 1
            }
            var filter = {
                ad: "",
                soyad: "",
                telefon: ""
            }

            function initialize() {
                $.get("/<?= tema; ?>/ajax_islemler.php", function(json, textStatus, xhr) {
                    var json = JSON.parse(json)
                    json = json.filter(function(elmn) {
                        if (elmn.rehber_ad.startsWith(filter.ad) && elmn.rehber_soyad.startsWith(filter.soyad) && elmn.rehber_telefon.indexOf(filter.telefon) > -1) {
                            return true
                        }
                    })
                    ayarlar.toplam_satir_sayisi = json.length
                    ayarlar.toplam_sayfa_sayisi = Math.ceil(json.length / 5)
                    var telefon_sutunlari = "";
                    (() => {
                        let i = (ayarlar.suanki_sayfa - 1) * 5
                        let y = Math.min(i + ayarlar.sayfa_basi_kayit_sayisi, ayarlar.toplam_satir_sayisi)
                        for (; i < y; i++) {
                            telefon_sutunlari += "<tr><td id=" + json[i].rehber_id + ">" + (parseInt(i) + 1) + "</td><td style='position:relative'>" + json[i].rehber_ad + "</td><td style='position:relative'>" + json[i].rehber_soyad + "</td><td style='position:relative'>" + json[i].rehber_telefon + "</td><td><i class='fas fa-edit'></i></td><td><i class='fa fa-trash' id= " + json[i].rehber_id + "></i></td></tr>"
                        }
                        $("#rehber").html(telefon_sutunlari)

                        if (ayarlar.toplam_sayfa_sayisi > 1) {
                            var pagination =
                                "<ul class='pagination'>" +
                                "<li data-mata='ilk_sayfa' class='page-item'><a href='#' class='page-link change_page'><<</a></li><li data-mata='prev' class='page-item disable-link'><a class='page-link change_page btn_prev' href='#'>Önceki</a></li>"
                            let i = Math.min(ayarlar.suanki_sayfa, ayarlar.toplam_sayfa_sayisi - 4) > 0 ? Math.min(ayarlar.suanki_sayfa, ayarlar.toplam_sayfa_sayisi - 4) : 1,
                                zet = Math.min(i + 4, ayarlar.toplam_sayfa_sayisi)
                            for (; i <= zet; i++) {
                                pagination +=
                                    "<li data-mata='" + i + "' class='page-item'><a class='page-link change_page' href='#'>" + i + "</a></li>"
                            }
                            pagination +=
                                "<li data-mata='next' class='page-item'><a class='page-link change_page btn_next' href='#'>Sonraki</a></li><li data-mata='son_sayfa' class='page-item'><a href='#' class='page-link change_page'>>></a></li>" +
                                "</ul>"
                            $("#paginate").html(pagination)
                        }
                        $("li[data-mata='" + ayarlar.suanki_sayfa + "'] a").addClass("active_link")
                        if (ayarlar.suanki_sayfa == 1) {
                            $("li[data-mata='next']").removeClass("disable-link")
                            $("li[data-mata='prev']").addClass("disable-link")
                        } else if (ayarlar.suanki_sayfa == ayarlar.toplam_sayfa_sayisi) {
                            $("li[data-mata='prev']").removeClass("disable-link")
                            $("li[data-mata='next']").addClass("disable-link")
                            var l = $("li[data-mata='next']").attr("class")
                        } else {
                            $("li[data-mata='next']").removeClass("disable-link")
                            $("li[data-mata='prev']").removeClass("disable-link")
                        }
                    })()
                })
            }
            initialize()

            var isEditingModeOpen = false
            var edit_satir = ""
            $(".kol").on("click", ".page-link", function() {
                $("table .editing").remove()
                isEditingModeOpen = false
                var tıklanan = $(this).parent().attr("data-mata")
                if (tıklanan != ayarlar.suanki_sayfa) {
                    switch (tıklanan) {
                        case "prev":
                            ayarlar.suanki_sayfa = parseInt(ayarlar.suanki_sayfa) - 1
                            break;
                        case "next":
                            ayarlar.suanki_sayfa = parseInt(ayarlar.suanki_sayfa) + 1
                            break;
                        case "ilk_sayfa":
                            ayarlar.suanki_sayfa = 1
                            break;
                        case "son_sayfa":
                            ayarlar.suanki_sayfa = ayarlar.toplam_sayfa_sayisi
                            break;
                        default:
                            ayarlar.suanki_sayfa = tıklanan
                            break;
                    }
                    initialize()
                }
            })
            $("table").on("click", ".fa-edit", function() {
                isEditingModeOpen = true
                $("table .editing").remove()

                edit_satir = $(this).parents("tr")
                edit_satir.children().each(function(i) {
                    if (i == 0 || i == 4 || i == 5) return
                    var hucre = edit_satir.children().eq(i)
                    var text = hucre.text()
                    var height = hucre.height()
                    var width = hucre.width()
                    if (i != 3) {
                        hucre.append("<div class = 'editing' style='position: absolute; bottom:0'><input type = 'text' class = 'form-control' value= '" + text + "'></div>")
                    } else if (i = 3) {
                        hucre.append("<div class='row telefon_container pos-abs b-0'>" + selectbox + _dial_wrapper(text) + "</div>")

                        var regx = /\(\+[0-9]{2,5}\)/
                        var telefon = $(".phoneNo").val()
                        let result = telefon.match(regx);
                        if (result != null) {
                            var alan_kodu = result[0]
                            var alan_kodu_trim = alan_kodu.slice(1, alan_kodu.length - 1)
                            $(".alan_kod_selectbox").val(alan_kodu_trim).change()
                        }
                    }
                })
            })

            $(document).click(function(e) {
                if (isEditingModeOpen && !$(e.target).closest(edit_satir).length) {
                    var editing_tr = $(".editing").parents("tr")

                    var proper_update = true
                    var id = editing_tr.children().eq(0).attr("id")
                    ad = "",
                        soyad = "",
                        telefon = ""
                    $(".editing").each(function(i) {
                        switch (i) {
                            case 0:
                                ad = $.trim($(this).find("input").val())
                                break;
                            case 1:
                                soyad = $.trim($(this).find("input").val())
                                break;
                            case 3:
                                telefon = $(this).find("input").val()
                                break;
                        }
                    })
                    if (ad == "") {
                        proper_update = false
                        vt.warn("İsim alanı boş bırakılamaz.", {
                            position: "top-center",
                            duration: 5000
                        });

                    } else if (soyad == "") {
                        proper_update = false
                        vt.warn("Soysim alanı boş bırakılamaz.", {
                            position: "top-center",
                            duration: 5000
                        });
                    } else {
                        var regx = /\(\+[0-9]{2,5}\)/
                        let result = telefon.match(regx);
                        if (result == null) {
                            proper_update = false
                            vt.warn("Alan kodu formatı uygun değil!", {
                                position: "top-center",
                                duration: 5000
                            });
                        } else {
                            var alan_kodu = result[0]
                            var alan_kodu_trim = alan_kodu.slice(1, alan_kodu.length - 1)
                            var telefon_kismi = $.trim(telefon.slice(telefon.indexOf(")") + 1, telefon.length))
                            telefon_kismi = telefon_kismi.replace(/ /g, '')
                            if (telefon_kismi.length != 10) {
                                vt.warn("Telefon 10 haneden olusmalıdır.", {
                                    position: "top-center",
                                    duration: 5000
                                });
                            } else {
                                new Promise((resolve, reject) => {
                                    $.getJSON("alan_kodlari.json", function(json) {
                                        resolve(json)
                                    })
                                }).then((json) => {
                                    proper_update = false
                                    alan_kodu_trim = alan_kodu.slice(1, alan_kodu.length - 1)
                                    json.forEach(element => {
                                        if (element.dial_code == alan_kodu_trim) {
                                            alan_kodu_validation = true
                                        }
                                    });
                                    if (!alan_kodu_validation) {
                                        var alan_kodu_validation = false
                                        vt.warn("Bu alan kodu herhangi bir ülkeye ait değildir!", {
                                            position: "top-center",
                                            duration: 5000
                                        });
                                    } else {
                                        var alan_kodu_validation = true
                                        proper_update = true
                                        var telefon_array = telefon_kismi.split("")
                                        var yeni_telefon = alan_kodu + " "
                                        for (var i = 0; i < 10; i++) {
                                            if (i == 3 || i == 6 || i == 8) {
                                                yeni_telefon += " " + telefon_array[i]
                                            } else {
                                                yeni_telefon += telefon_array[i]
                                            }
                                        }
                                        yeni_telefon = $.trim(yeni_telefon)
                                        ad = ad.replace(/ /g, '')
                                        soyad = soyad.replace(/ /g, '')
                                        $.ajax({
                                            type: "post",
                                            url: '/<?= tema; ?>/ajax_islemler.php/',
                                            data: {
                                                rehber_ad: ad,
                                                rehber_id: id,
                                                rehber_soyad: soyad,
                                                rehber_telefon: yeni_telefon,
                                                operation: 'guncelle'
                                            },
                                            dataType: 'json',
                                            success: function(data) {
                                                if (data.success) {
                                                    editing_tr.children().eq(1).text(ad)
                                                    editing_tr.children().eq(2).text(soyad)
                                                    editing_tr.children().eq(3).text(yeni_telefon)
                                                    vt.success(data.success, {
                                                        position: "top-center",
                                                        duration: 5000
                                                    });
                                                } else if (data.warning) {
                                                    vt.warn(data.warning, {
                                                        position: "top-center",
                                                        duration: 5000
                                                    });
                                                } else if (data.error) {
                                                    vt.error(data.error, {
                                                        position: "top-center",
                                                        duration: 5000
                                                    });
                                                } else if (data.s) {
                                                    console.log(data)
                                                }
                                            }
                                        });
                                    }
                                    if (proper_update) {
                                        $("table .editing").remove()
                                        isEditingModeOpen = false
                                    }
                                })
                            }
                        }
                    }


                }
            })

            $("table").on("click", ".fa-trash", function() {
                Swal.fire({
                    title: 'Silmek istediğinize emin misiniz?',
                    showDenyButton: true,
                    confirmButtonText: 'Sil',
                    denyButtonText: `Vazgeç`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        var rehber_id = $(this).attr("id")
                        $.ajax({
                            type: "post",
                            url: '/<?= tema; ?>/ajax_islemler.php/',
                            data: {
                                id: rehber_id,
                                operation: 'sil'
                            },
                            dataType: 'json',
                            success: function(data) {
                                Swal.fire(data.title, data.content, data.situation)
                                $(" #" + rehber_id).parents("tr").remove()
                            }
                        });

                    }
                })
            })

            $(".ekle").click(function() {
                location.href = 'ekle'
            })
            var searching = false
            $("#search").click(function() {
                if (searching) {
                    $(".searching").remove()
                    filter = {
                        ad: "",
                        soyad: "",
                        telefon: ""
                    }
                    initialize()
                } else {
                    $("#rehber_thead").append("<tr class='searching'><td></td><td><input class='form-control name_search' placeholder='Ad' type='text'></td><td><input class='form-control surname_search' placeholder='Soyad' type='text'></td><td><input class='form-control phone_search' placeholder='Telefon' type='text'></td><td></td><td></td></tr>")
                }
                searching = !searching
            })

            $(document).on("keyup", function() {
                if (searching) {
                    let name = $(".name_search").val()
                    filter.ad = name
                    let surname = $(".surname_search").val()
                    filter.soyad = surname
                    let telefon = $(".phone_search").val()
                    filter.telefon = telefon
                    initialize()
                }
            })
        })
    </script>
<?php }
?>



</html>