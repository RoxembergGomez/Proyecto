<div id="modal_form_vertical" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">REVISIÓN DE ACTIVIDADES</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body col-md-12">

                <fieldset class="content-group">
                    <div class="form-group">
                        <div class="col-md-12">
                          <input type="text" value="<?php echo $_POST['idprograma']; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                        <label>Verificación</label>
                                        <select type="text" class="form-control input-xlg"
                                           id="txtNombres" name="txtNombres">
                                            <option value="">Seleccione</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                             <option value="N/A">N/A</option>
                                        </select>
                                </div>
                                <div class="col-md-6">
                                        <label>Respaldo</label>
                                        <input type="text" class="form-control input-lg"
                                            placeholder="Seleccione Archivo" id="txtPrimerApellido"
                                            name="txtPrimerApellido">
                                </div>
                            </div> <br>

                            <div class="row">
                                <div class="col-md-12">
                                        <label>Observación</label>
                                        <input type="text" class="form-control input-lg"
                                            placeholder="Redacte la observación" id="txtSegundoApellido"
                                            name="txtPrimerApellido">
                                </div>
                            </div> <br>

                            <div class="row">
                                <div class="col-md-6">
                                        <label>Prioridad de Atención</label>
                                        <select type="text" class="form-control input-xlg"
                                           id="txtNombres" name="txtNombres">
                                            <option value="">Seleccione</option>
                                            <option value="ALTA">ALTA</option>
                                            <option value="MEDIA">MEDIA</option>
                                             <option value="BAJA">BAJA</option>
                                        </select>
                                </div>
                                <div class="col-md-6">
                                        <label>Respaldo</label>
                                        <input type="text" class="form-control input-lg"
                                            placeholder="Seleccione un anexo" id="txtPrimerApellido"
                                            name="txtPrimerApellido">
                                </div>
                            </div> <br>

                            </div>
                        </div>
                </fieldset>

                <div class="text-right">
                    <a class="btn btn-primary" type="button" class="close" data-dismiss="modal" class="fa fa-arrow-circle-left"></i> Cancelar</a>
                    <!-- <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar
                        <i class="icon-arrow-right14 position-right"></i></button> -->
                        <button class="btn btn-success" onclick="registrarCliente()">Generar Cliente</button>
                </div>

            
            </div>

        </div>
    </div>
</div> class="text-right">
                    <a class="btn btn-primary" type="button" class="close" data-dismiss="modal" class="fa fa-arrow-circle-left"></i> Cancelar</a>
                    <!-- <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar
                        <i class="icon-arrow-right14 position-right"></i></button> -->
                        <button class="btn btn-success" onclick="registrarCliente()">Generar Cliente</button>
                </div>

            
            </div>

        </div>
    </div>
</div>
