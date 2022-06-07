var dial = '<table class="dial">'
for (var rowNum = 0; rowNum < 4; rowNum++) {
    dial += "<tr>"
    if (rowNum != 3) {
        for (var colNum = 0; colNum < 3; colNum++) {
            dial += "<td class='dialDigit'><span class='handleChange'>" + (3 * rowNum + colNum + 1) + "</span></td>"
        }
    } else if (rowNum === 3) {
        /* if last row */
        dial += "<tr><td class='dialDigit'><span></span></td><td class='dialDigit'><span class='handleChange'>0</span></td><td class='dialDigit'><span class='handleChange'>X</span></td></tr>"
    }
}
dial += "</table>"

var dial_wrapper =
    '<div class="row pos-rel dialWrapper col-9">' +
    '<input att="phoneNo" class="form-control phoneNo" value="(___) " style="user-select:none" type="tel">' +
    '<span class="pos-abs r-1 m-auto"><i class="fa fa-phone"></i></span></i>' +
    '</div>'
function _dial_wrapper(value) {
    return '<div class="row pos-rel dialWrapper col-9 editing">' +
        '<input class="form-control phoneNo" value="' + value + ' "style="user-select:none" type="tel">' +
        '<span class="pos-abs r-1 m-auto"><i class="fa fa-phone"></i></span></i>' +
        '</div>'
}

$("table").on("click", ".fa-phone", function () {
    if ($(this).parent().attr("class").includes("dialIsOpen")) {
        $(this).parent().removeClass("dialIsOpen")
        $(".dial").remove()
    } else {
        $(this).parent().addClass("dialIsOpen")
        $(this).parent().append(dial)
    }
})

$(document).click(function (e) {
    if (!$(e.target).closest($(".dial")).length && !$(e.target).closest($(".fa-phone")).length) {
        $(".dialIsOpen").removeClass("dialIsOpen    ")
        $(".dial").remove()
    }
})

var focused = true
$("table").on("focus", ".phoneNo", function () {
    focused = true
    $(document).keydown(function (e) {
        if (focused) {
            var code = e.keyCode || e.which;
            const keys = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 27, 13, 32].includes(code)
            if (!keys) {
                e.preventDefault()
            } 
        }
    })
    return
})
$("table").on("blur", ".phoneNo", function () {
    focused = false
})