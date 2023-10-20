var usu_id = $('#usu_idx').val();

function init(){
    $("#profesor_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#profesor_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/profesor.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#profesor_data').DataTable().ajax.reload();
            $('#modalcrearProfesor').modal('hide');

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
    $('#rol_id').select2({
        dropdownParent: $('#modalcrearProfesor')
    });
    $('#esc_id').select2({
        dropdownParent: $('#modalcrearProfesor')
    });

    combo_rol();
    combo_escalfon();

    $('#profesor_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/profesor.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Profesor');
    $('#profesor_form')[0].reset();
    $('#modalcrearProfesor').modal('show');
}

function editar(prof_id){
    $.post("/ISUM/controller/profesor.php?opc=mostrar",{prof_id:prof_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#prof_id').val(data.prof_id);
        $('#prof_nom').val(data.prof_nom);
        $('#prof_apep').val(data.prof_apep);
        $('#prof_apem').val(data.prof_apem);
        $('#prof_correo').val(data.prof_correo);
        $('#prof_niv').val(data.prof_niv);
        $('#prof_sex').val(data.prof_sex);
        $('#prof_telf').val(data.prof_telf);
        $('#rol_id').val(data.rol_id).trigger('change');
        $('#esc_id').val(data.esc_id).trigger('change');
    });
    $('#titulo_modal').html('Editar Profesor');
    $('#modalcrearProfesor').modal('show');
}

function eliminar(prof_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/ISUM/controller/profesor.php?opc=eliminar",{prof_id:prof_id},function (data){
                $('#profesor_data').DataTable().ajax.reload();
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

function combo_rol(){
    $.post("/ISUM/controller/rol.php?opc=combo", function (data) {
        $('#rol_id').html(data);
    });
}
function combo_escalfon(){
    $.post("/ISUM/controller/escalafon.php?opc=combo", function (data) {
        $('#esc_id').html(data);
    });
}
init();