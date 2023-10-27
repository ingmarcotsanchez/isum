var usu_id = $('#usu_idx').val();

function init(){

}

$(document).ready(function(){
    $('#est_id').select2();
    
    combo_estudiante();

    $('#asig_id').select2({
        dropdownParent: $("#modalagregarCalificacion")
    });
    select_asignatura();

    /* Obtener Id de combo estudiante */
    $('#est_id').change(function(){
        $("#est_id option:selected").each(function (){
            est_id = $(this).val();
            //console.log(est_id);

            $('#detalle_data').DataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                ],
                "ajax":{
                    url:"/ISUM/controller/calificaciones.php?opc=listar",
                    type:"post",
                    data:{est_id:est_id},
                },
                "bDestroy": true,
                "responsive": true,
                "bInfo":true,
                "iDisplayLength": 10,
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
    });

});

function agregar(){
    if ($('#est_id').val()==''){
        Swal.fire({
            title: 'Error!',
            text: 'Seleccionar Estudiante',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    }else{
        var est_id = $('#est_id').val();
        listar_asignaturas(est_id);
        $('#modalmantenimiento').modal('show');
    }
}

function listar_asignaturas(est_id){
    $('#asignatura_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/asignatura.php?opc=listar_asignaturas",
            type:"post",
            data:{est_id:est_id}
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
}

function eliminar(asigxest_id){
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar la calificación?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("/ISUM/controller/calificaciones.php?opc=eliminar_estudiante_asignatura",{asigxest_id : asigxest_id}, function (data) {
                $('#detalle_data').DataTable().ajax.reload();

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

function registrarasignatura(){
    table = $('#asignatura_data').DataTable();
    var asig_id =[];

    table.rows().every(function(rowIdx, tableLoop, rowLoop) {
        cell1 = table.cell({ row: rowIdx, column: 0 }).node();
        if ($('input', cell1).prop("checked") == true) {
            id = $('input', cell1).val();
            asig_id.push([id]);
        }
    });

    if (asig_id == 0){
        Swal.fire({
            title: 'Error!',
            text: 'Seleccionar Asignaturas',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    }else{
        /* Creando formulario */
        const formData = new FormData($("#form_detalle")[0]);
        formData.append('est_id',est_id);
        formData.append('asig_id',asig_id);

        $.ajax({
            url: "../../controller/estudiante.php?opc=insert_curso_usuario",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success : function(data) {
                data = JSON.parse(data);

                data.forEach(e => {
                    e.forEach(i => {
                        console.log(i['asigxest_id']);
                        $.ajax({
                            type: "POST",
                            url: "../../controller/estudiante.php?opc=generar_qr",
                            data: {asigxest_id : i['asigxest_id']},
                            dataType: "json"
                        });
                    });
                });
            }
        });

        /* Recargar datatable de los usuarios del curso */
        $('#detalle_data').DataTable().ajax.reload();

        $('#usuario_data').DataTable().ajax.reload();
        /* ocultar modal */
        $('#modalmantenimiento').modal('hide');

    }
}



function combo_estudiante(){
    $.post("/ISUM/controller/estudiante.php?opc=combo", function (data) {
        $('#est_id').html(data);
    });
}

function select_asignatura(){
    $.post("/ISUM/controller/asignatura.php?opc=combo",function (data){
        $('#asig_id').html(data);
    });
}

init();