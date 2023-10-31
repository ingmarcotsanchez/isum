var usu_id = $('#usu_idx').val();

$(document).ready(function(){

    $.post("/ISUM/controller/usuario.php?opc=total_Profesores", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalProfesores').html(data.total);
    });

    $.post("/ISUM/controller/usuario.php?opc=total_Proyectos", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalProyectos').html(data.total);
    });

    $.post("/ISUM/controller/usuario.php?opc=total_Semilleros", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalSemilleros').html(data.total);
    });

    $.post("/ISUM/controller/usuario.php?opc=total_Productos", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalProductos').html(data.total);
    });

    $.post("/ISUM/controller/usuario.php?opc=total_estudiantes", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalEstudiantes').html(data.total);
    });
    $.post("/ISUM/controller/usuario.php?opc=total_egresados", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalEgresados').html(data.total);
    });
    $.post("/ISUM/controller/usuario.php?opc=total_NoGraduados", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalNoGraduados').html(data.total);
    });
    $.post("/ISUM/controller/usuario.php?opc=total_desertores", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalDesertores').html(data.total);
    });
    $.post("/ISUM/controller/usuario.php?opc=total_ausentes", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalAusentes').html(data.total);
    });
    $.post("/ISUM/controller/usuario.php?opc=total_activos", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalActivos').html(data.total);
    });
});


