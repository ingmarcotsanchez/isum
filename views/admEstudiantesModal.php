<div class="modal fade" id="modalcrearEstudiante" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="estudiante_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="est_id" id="est_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="est_nom">Nombre</label>
                                <input type="text" class="form-control" name="est_nom" id="est_nom" placeholder="Ingrese su Nombre">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_apep">Apellido Paterno</label>
                                <input type="text" class="form-control" name="est_apep" id="est_apep" placeholder="Ingrese su Nombre">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_apem">Apellido Materno</label>
                                <input type="text" class="form-control" name="est_apem" id="est_apem" placeholder="Ingrese su Apellido">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_correo">Correo Electrónico</label>
                                <input type="email" class="form-control" name="est_correo" id="est_correo" placeholder="Ingrese su Correo">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_sem">semestre</label>
                                <input type="text" class="form-control" name="est_sem" id="est_sem" placeholder="Ingrese el semestre">
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_sex">Sexo</label>
                                <select class="form-control select2" name="est_sex" id="est_sex" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="est_tel">Teléfono</label>
                                <input type="text" class="form-control" name="est_tel" id="est_tel" placeholder="Ingrese su Telefono">
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
