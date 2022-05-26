function accomplish(id, description){
   $("#accomplish_idmachine").val(id);
   $("#accomplish_description").text("Realizar manutenção: "+ description);
}

function postpone(id, description){
    $("#postpone_maintenance_id").val(id);
    $("#postpone_description").text("Adiar manutenção: "+ description);
}

function modal_hodometro(id, hodometro, description){
    $("#machine_id").val(id);
    $('#hodometro').attr('min', parseInt(hodometro));
    $("#hodometro").val(hodometro);
    $("#machine_description").text("Maquinário: "+ description);
}

function confereHodometro(){
    var min = parseInt($('#hodometro').attr('min'));
    
    if ($('#hodometro').val() < min){
        $('#hodometro').val(min);
    }       
}
