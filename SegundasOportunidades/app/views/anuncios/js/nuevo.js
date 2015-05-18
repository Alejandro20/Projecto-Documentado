$(document).ready(function(){
    $('#form1').validate({
        rules:{
            titulo:{
                required: true
            },
            descripcion:{
                required: true
            },
			
        },
        messages:{
            titulo: {
                required: "Debe introducir el titulo del Anuncio"
            },
            descripcion:{
                required: "Debe introducir la Descripcion del Anuncio"
            }
        }
    });
});