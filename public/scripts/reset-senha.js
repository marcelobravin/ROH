// Verificação dos caracteres da nova senha

$("#senha1").on("input", function(){
    var elemento = $(this).val();
    var nivel_forca = 0;
    elemento.match(/[A-Z]/) ?
    ( nivel_forca++, $("li > i")[0].classList.add("verificado") ):
    ( $("li > i")[0].classList.remove("verificado") );

    elemento.match(/[a-z]/) ?
    ( nivel_forca++, $("li > i")[1].classList.add("verificado") ):
    (  $("li > i")[1].classList.remove("verificado") );

    elemento.match(/[0-9]/) ?
    ( nivel_forca++, $("li > i")[2].classList.add("verificado") ):
    ( $("li > i")[2].classList.remove("verificado") );

    elemento.match(/[-!$%^&*()@_+|~=`{}\[\]:";'< ?,.\/]/) ?
    ( nivel_forca++, $("li > i")[3].classList.add("verificado") ):
    ( $("li > i")[3].classList.remove("verificado") );

    elemento.length >= 8 ?
    ( nivel_forca++, $("li > i")[4].classList.add("verificado") ):
    ( $("li > i")[4].classList.remove("verificado") );


    $(".barra-prog").css({"width": $(".verificado").length * 20 + "%"});

    switch (nivel_forca){
        case 1:
            $(".barra-prog").css("background", "#e62323");
        break;

        case 2:
            $(".barra-prog").css("background", "#ffc107");
        break;

        case 3:
            $(".barra-prog").css("background", "#ff5722");
        break;

        case 4:
            $(".barra-prog").css("background", "#a2d26b");
        break;

        case 5:
            $(".barra-prog").css("background", "#4bea51");
        break;
    }
})

// Efeito mostrar botão de enviar

$(document).ready(function(){
    if($("#senha1").val() != "" && $("#senha2").val() != ""){
        $(":submit").removeAttr("disabled");
        $(":submit").css("opacity", "1");
    }
    else{
        $(":submit").attr("disabled", "disabled");
        $(":submit").css("opacity", ".2");
    }
})

$("input").on("input", function(){
    if($("#senha1").val() != "" && $("#senha2").val() != "" && $(".verificado").length == 5){
        $(":submit").removeAttr("disabled");
        $(":submit").css("opacity", "1");
    }
    else{
        $(":submit").attr("disabled", "disabled");
        $(":submit").css("opacity", ".2");
    }
})

// Efeito botão revelar senha

$("label + i").on("click", function(){
    $(this).toggleClass("fa-eye-slash");
    $("#senha1, #senha2").attr("type") == "password"
        ? $("#senha1, #senha2").attr("type", "text")
        : $("#senha1, #senha2").attr("type", "password");
})

// Verificar se as senhas são iguais ao clicar em enviar

$(":submit").on("click", function(event){
    if($("#senha1").val() != $("#senha2").val()){
        event.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Aviso!',
            text: 'As senhas precisam ser iguais!',
            showConfirmButton: true
        });
        // return false;
    }


})

// $("#enviar").on("click", function(){
//      $.ajax({
//       url: "../../app/Controller/PasswordUpdateController.php",
//       method: "POST"
//     }).then((data) => {
//         console.log(data);
//     });
// })


// $(document).on("change, keyup", "input", function(){
//                 check()
//             })
//
//             function check() {
//                 if (
//                     (
//                         $("#senha1").val() != ''
//                         &&
//                         $("#senha2").val() != ''
//                     ) &&
//                     $("#senha1").val() == $("#senha2").val()
//                 ) {
//                     $(":submit").removeAttr("disabled")
//                 } else {
//                     $(":submit").attr("disabled", "disabled")
//                 }
//             }

//             function validateEmail(email) {
//                 var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//                 return re.test(email);
//             }

//             function CheckPassword(inputtxt) {
//                 var decimal = /^(?=.\d)(?=.[a-z])(?=.[A-Z])(?=.[^a-zA-Z0-9])(?!.*\s).{8,20}$/;
//                 if( decimal.test(inputtxt) ) {
//                     return true;
//                 } else {
//                     return false;
//                 }
//             }

//             // The password is at least 8 characters long
//             function has8Chars (str) {
//                 var patt = /^.{8,}$/;
//                 return patt.test(str);
//             }
//             // The password has at least one uppercase letter
//             function hasUpper (str) {
//                 var patt = /[A-Z]/;
//                 return patt.test(str);
//             }
//             // The password has at least one lowercase letter
//             function hasLower (str) {
//                 var patt = /[a-z]/;
//                 return patt.test(str);
//             }
//             // The password has at least one digit
//             function hasNumber (str) {
//                 var patt = /[0-9]/;
//                 return patt.test(str);
//             }
//             // The password has at least one special character ([^A-Za-z0-9]).
//             function hasSymbol (str) {
//                 var patt = /[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/;
//                 return patt.test(str);
//             }

//             function validatePasswordStrenght (str) {
//                 let sn = 0;
//                 if ( has8Chars(str)) { sn++; $("#tamanho").addClass("validado")    ;} else { $("#tamanho").removeClass("validado")    }
//                 if ( hasUpper(str) ) { sn++; $("#maiusculas").addClass("validado") ;} else { $("#maiusculas").removeClass("validado") }
//                 if ( hasLower(str) ) { sn++; $("#minusculas").addClass("validado") ;} else { $("#minusculas").removeClass("validado") }
//                 if ( hasNumber(str)) { sn++; $("#numeros").addClass("validado")    ;} else { $("#numeros").removeClass("validado")    }
//                 if ( hasSymbol(str)) { sn++; $("#simbolos").addClass("validado")   ;} else { $("#simbolos").removeClass("validado")   }

//                 $("#password-strength-meter").attr('data-value', sn);
//             }

//             $(document).ready(function(){
//                 $("#senha1").keyup(function(){
//                     validatePasswordStrenght( $(this).val() )
//                 });

//                 $("#reveal").click(function(){
//                     if ( $(this).attr("src") == "public/img/eye-view.png") {
//                         $(this).attr("src", "public/img/eye-hide.png")
//                         $(":password").attr("type", "text")
//                     } else {
//                         $(this).attr("src", "public/img/eye-view.png")
//                         $(":text").attr("type", "password")
//                     }
//                 })
//             });
