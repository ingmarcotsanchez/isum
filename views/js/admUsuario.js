var usu_id = $('#usu_idx').val();

function init(){
    $("#usuario_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/usuario.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#usuario_data').DataTable().ajax.reload();
            $('#modalcrearUsuario').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#esc_id').select2({
        dropdownParent: $("#modalcrearUsuario")
    });

    select_escalafon();
    select_rol();

    $('#usuario_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/usuario.php?opc=listar",
            type:"post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });

});

function nuevo(){
    $('#titulo_modal').html('Nuevo Usuario');
    $('#usuario_form')[0].reset();
    select_escalafon();
    select_rol();
    $('#modalcrearUsuario').modal('show');
}

function editar(usu_id){
    $.post("/ISUM/controller/usuario.php?opc=mostrar",{usu_id:usu_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#usu_id').val(data.usu_id);
        $('#usu_nom').val(data.usu_nom);
        $('#esc_id').val(data.esc_id).trigger('change');
    });
    $('#titulo_modal').html('Editar Usuario');
    $('#modalcrearUsuario').modal('show');
}

function eliminar(usu_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/ISUM/controller/usuario.php?opc=eliminar",{usu_id:usu_id},function (data){
                $('#usuario_data').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            }); 
        }
    });

}

function select_escalafon(){
    $.post("/ISUM/controller/usuario.php?opc=inputselectEscalafon",function (data){
        $('#esc_id').html(data);
    });
}

function select_rol(){
    $.post("/ISUM/controller/usuario.php?opc=inputselectRol",function (data){
        $('#rol_id').html(data);
    });
}



init();