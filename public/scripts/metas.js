$(document).ready(function(){
    $("#categoria").change(function(){
        // console.log( $(this).val() )
        $( "table" ).addClass('invisivel');
        $( "#"+ $(this).val() ).removeClass('invisivel');
    })
})
