var alan_kodlari_options= "", selectbox= ""
new Promise((resolve, reject) => {
    $.getJSON("alan_kodlari.json", function (json) {
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