<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/<?= tema; ?>/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
    <link rel="stylesheet" href="/<?= tema; ?>/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="kol col-12">
                <div class="top_baslik">
                    <a href="/" class="baslik" style="margin-bottom: 25px;">Baslik </a>
                    <span class="ekle"><button id="go_back" class="btn btn-primary">Geri Dön <i class="fa fa-arrow-left" aria-hidden="true"></i></button></span>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><i id="satir_ekle" class="fa fa-plus" aria-hidden="true"></i></th>
                            <th scope="col">Ad</th>
                            <th scope="col">Soyad</th>
                            <th scope="col">Telefon Numarası</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">

                    </tbody>
                </table>
                <button class="btn btn-primary kaydet">Kaydet</button>
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
        var mevcut_input_sayisi = 0;
        $("#satir_ekle").click(function() {
            if (mevcut_input_sayisi < 5) {
                $(".tbody").append("<tr class='add'><td><i class='fa fa-minus'></i></td><td><input att='ad' class='form-control' type='text'></td><td><input att='soyad' class='form-control' type='text'></td><td><div class='row telefon_container'>" + selectbox + dial_wrapper + "</div></td></tr>")
                mevcut_input_sayisi += 1
            }
        })
        $("table").on("click", ".fa-minus", function() {
            $(this).parents("tr").remove()
            mevcut_input_sayisi -= 1
        })
        $(".kaydet").click(async function() {
            if (!$(".add").length) return
            var hepsi_bosmu = true
            let tel_numb_arr = []
            let tekrar_eden_tel = false
            let proper_add = true
            new Promise((resolve, reject) => {
                var adds = $(".add").children()
                adds.each(function(i) {
                    if (i % 4 != 0 && $(this).find("input").val() != "") {
                        hepsi_bosmu = false
                    }
                    if (i % 4 == 3) {
                        let num = $(this).find("input").val()
                        if (num != "" && $.trim(num) != "(___)") {
                            tel_numb_arr.push(num)
                        }
                        for (var i = 0; i < tel_numb_arr.length; i++) {
                            for (var j = 0; j < tel_numb_arr.length; j++) {
                                if (i != j) {
                                    if (tel_numb_arr[i] == tel_numb_arr[j]) {
                                        tekrar_eden_tel = true
                                    }
                                }
                            }
                        }
                        resolve()
                    }
                })
            }).then(() => {
                if (tekrar_eden_tel) {
                    proper_add = false
                    vt.warn("Aynı telefon numarası sadece bir kere eklenebilir.", {
                        position: "top-center",
                        duration: 5000
                    });
                } else {
                    if (!hepsi_bosmu) {
                        var all_row_filled = true
                        new Promise((resolve, reject) => {
                            $.getJSON("/<?= tema; ?>/alan_kodlari.json", function(json) {
                                resolve(json)
                            })
                        }).then((json) => {

                            new Promise((resolve, reject) => {
                                var sql = "INSERT INTO rehber (rehber_ad, rehber_soyad, rehber_telefon) VALUES "
                                $(".add").each(function(index) {
                                    let inputlar = $(this).children()
                                    let ad = $.trim(inputlar.eq(1).find("input").val())
                                    if (ad == "") {
                                        vt.warn("İsim boş olamaz", {
                                            position: "top-center",
                                            duration: 5000
                                        });
                                        return
                                    }
                                    let soyad = $.trim(inputlar.eq(2).find("input").val())
                                    if (soyad == "") {
                                        vt.warn("Soysim boş olamaz", {
                                            position: "top-center",
                                            duration: 5000
                                        });
                                        return
                                    }
                                    var telefon = $.trim(inputlar.eq(3).find("input").val())
                                    let regx = /\(\+[0-9]{2,5}\)/
                                    let result = telefon.match(regx);
                                    if (result == null) {
                                        proper_add = false
                                        vt.warn("Alan kodu formatı uygun değil!", {
                                            position: "top-center",
                                            duration: 5000
                                        });
                                    } else {
                                        if (all_row_filled) {
                                            let alan_kodu = result[0]
                                            let alan_kodu_trim = alan_kodu.slice(1, alan_kodu.length - 1)
                                            let telefon_kismi = $.trim(telefon.slice(telefon.indexOf(")") + 1, telefon.length)).replace(/ /g, '')
                                            if (telefon_kismi.length != 10) {
                                                proper_add = false
                                                vt.warn("Telefon 10 haneden olusmalıdır", {
                                                    position: "top-center",
                                                    duration: 5000
                                                });
                                            } else {
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
                                                let alan_kodu_validation = false
                                                json.forEach(element => {
                                                    if (element.dial_code == alan_kodu_trim) {
                                                        alan_kodu_validation = true
                                                    }
                                                });
                                                if (!alan_kodu_validation) {
                                                    proper_add = false
                                                    vt.warn("Alan kodu herhangi bir ülkeye ait değildir!", {
                                                        position: "top-center",
                                                        duration: 5000
                                                    });
                                                } else {
                                                    sql += "('" + ad + "','" + soyad + "','" + yeni_telefon + "'),"
                                                }
                                                if (index == ($(".add").length - 1)) {
                                                    sql = sql.substr(0, sql.length - 1)
                                                    resolve({
                                                        sql: sql,
                                                        yeni_telefon: yeni_telefon
                                                    })
                                                }
                                            }
                                        }
                                    }
                                })
                            }).then((res) => {
                                Swal.fire({
                                    title: 'Kaydetmek istediğinize emin misiniz?',
                                    showDenyButton: true,
                                    confirmButtonText: 'Evet',
                                    denyButtonText: `Vazgeç`,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            type: "post",
                                            url: '/<?= tema; ?>/ajax_islemler.php/',
                                            data: {
                                                sql: res.sql,
                                                rehber_telefon: res.yeni_telefon,
                                                operation: 'ekle'
                                            },
                                            dataType: 'json',
                                            success: function(data) {
                                                if (data.success) {
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
                                                }
                                                $(".add").remove()
                                                mevcut_input_sayisi = 0
                                            }
                                        })
                                    }
                                })
                            })
                        })
                    }
                }
            })
        })
        $("#go_back").click(function() {
            var sure = true
            if (!$(".add").length) {
                location.href = './index.php'
            } else {
                $(".add").children().each(function(i) {
                    if (i % 4 != 0 && $(this).find("input").val() != "" && $(this).find("input").val() != "(___) ") {
                        sure = false
                    }
                })
                if (!sure) {
                    Swal.fire({
                        title: 'Yaptığınız değişiklikler kaydedilmedi. Çıkmak istediğinize emin misiniz?',
                        showDenyButton: true,
                        confirmButtonText: 'Evet',
                        denyButtonText: `Vazgeç`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = './index.php'
                        }
                    })
                } else {
                    location.href = './index.php'
                }
            }

        })
    })
</script>

</html>