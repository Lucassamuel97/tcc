function accomplish(id, description){
   $("#accomplish_idmachine").val(id);
   $("#accomplish_description").text("Realizar manutenção: "+ description);
}

function postpone(id, description){
    $("#postpone_maintenance_id").val(id);
    $("#postpone_description").text("Adiar manutenção: "+ description);
 }