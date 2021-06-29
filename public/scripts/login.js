$(document).on( "change, keyup, mousemove", "input", function(){
    check()
})

function check() {
    if (
        $("#login").val() == ''
        ||
        $("#senha").val() == ''
    ) {
        $(":submit").attr("disabled", "disabled")
    } else {
        $(":submit").removeAttr("disabled")
    }
}

$(document).ready(function(){
    $("#reveal").click(function(){
        if ( $(this).attr("src") == "public/img/eye-view.png") {
            $(this).attr("src", "public/img/eye-hide.png")
            $("#senha").attr("type", "text")
        } else {
            $(this).attr("src", "public/img/eye-view.png")
            $("#senha").attr("type", "password")
        }
    })
})
