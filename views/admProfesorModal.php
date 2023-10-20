<div class="modal fade" id="modalcrearProfesor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="profesor_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="prof_id" id="prof_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_nom">Nombre</label>
                                <input type="text" class="form-control" name="prof_nom" id="prof_nom" placeholder="Ingrese un Nombre">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_apep">Apellido Paterno</label>
                                <input type="text" class="form-control" name="prof_apep" id="prof_apep" placeholder="Ingrese Primer Apellido ">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_apem">Apellido Materno</label>
                                <input type="text" class="form-control" name="prof_apem" id="prof_apem" placeholder="Ingrese Segundo Apellido">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_correo">Correo Electrónico</label>
                                <input type="email" class="form-control" name="prof_correo" id="prof_correo" placeholder="Ingrese un Correo">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_niv">Último Nivel de Estudio</label>
                                <select class="form-control select2" style="width:100%" name="prof_niv" id="prof_niv" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="P">Pregrado</option>
                                    <option value="E">Especialización</option>
                                    <option value="M">Maestria</option>
                                    <option value="D">Doctorado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_sex">Sexo</label>
                                <select class="form-control select2" style="width:100%" name="prof_sex" id="prof_sex" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_telf">Teléfono</label>
                                <input type="text" class="form-control" name="prof_telf" id="prof_telf" placeholder="Ingrese Segundo Apellido">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="rol_id">Rol</label>
                                <select class="form-control select2" style="width:100%" name="rol_id" id="rol_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="esc_id">Escalafón</label>
                                <select class="form-control select2" style="width:100%" name="esc_id" id="esc_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
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