
function cargar(id,name,url){
    //alert(name);
        var parametros = {
                "id" : id,
        };
        $.ajax({
                data:  parametros,
                url:   url,
                type:  'post',
                beforeSend: function () {
                        //$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#"+name).html(response);
                }
        });
}