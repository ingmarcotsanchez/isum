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
});


