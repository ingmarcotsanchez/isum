<div class="modal fade" id="modalcrearCalificaciones" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="calificaciones_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="cal_id" id="cal_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cal_alfa">Alfanumerico</label>
                                <input type="text" class="form-control" name="cal_alfa" id="cal_alfa" placeholder="Ingrese el Alfanumerico">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cal_nrc">NRC</label>
                                <input type="text" class="form-control" name="cal_nrc" id="cal_nrc" placeholder="Ingrese el NRC">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cal_asig">Asignatura</label>
                                <input type="text" class="form-control" name="cal_asig" id="cal_asig" placeholder="Ingrese el Peso">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cal_cred">Creditos</label>
                                <input type="text" class="form-control" name="cal_cred" id="cal_cred" placeholder="Ingrese el numero de credito">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cal_hor">Horas</label>
                                <input type="text" class="form-control" name="cal_hor" id="cal_hor" placeholder="Ingrese las Horas">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cal_sem">Semestre</label>
                                <input type="text" class="form-control" name="cal_sem" id="cal_sem" placeholder="Ingrese el semestre">
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
