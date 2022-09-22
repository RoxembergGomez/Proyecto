<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; ">MODIFICAR ACTIVIDAD</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">

      <?php 
        foreach ($infoactividad->result() as $row) {
        echo form_open_multipart('controller_actividades/modificarbd');
        ?>
        <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo; ?>" required>
      <div class="row">
        <div class="col-md-2">
          <label class="float-right">* Informe:</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="informe" class="col-md-12 form-control" value="<?php echo $row->informe; ?>" required> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
         <label class="float-right">* Objetivos:</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="objetivo" class="col-md-12 form-control" value="<?php echo $row->objetivo; ?>" required> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
         <label class="float-right">* Normativa:</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="normativa" class="col-md-12 form-control" value="<?php echo $row->normativa; ?>" required> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label class="float-right">* Fecha de Inicio:</label>
        </div>
        <div class="col-md-3">
          <input type="date" name="fechaInicio" class="col-md-12 form-control" value="<?php echo $row->fechaInicio; ?>" required > <br> <br>
        </div>
        <div class="col-md-3">
          <label class="float-right">* Fecha de Conclusión:</label>
        </div>
        <div class="col-md-3">
          <input type="date" name="fechaConclusion" class="col-md-12 form-control" value="<?php echo $row->fechaInicio;?>" required> <br><br><br>
        </div>
        </div>
        <div class="row">
          <div class="col-md-2">
          <label class="float-right">* Grado de Priorización:</label>
        </div>
        <div class="col-md-3">
          <select name="gradoPriorizacion" class="col-md-12 form-control" required>
            <option><?php echo $row->gradoPriorizacion; ?></option>
            <option value="Alta">Alta</option>
            <option value="Media">Media</option>
            <option value="Baja">Baja</option>
          </select> <br> <br>
        </div>
        <div class="col-md-3">
          <label class="float-right">* Seleccionar Archivo:</label>
        </div>
        <div class="col-md-3">
          <input type="file" class="col-md-12 form-control" name="userfile"><br>
        </div>
      </div>
       <hr>
      <div class="row float-left">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalConfirmacion"><i class="fa fa-edit (alias)"></i>  Modificar Actividad</button>


              <!-- DIÁLOGO DE ALERTA PARA ACCIONES-->
              <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Confirmación Edición</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       Estás seguro de editarlo?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                  </div>
                </div>
              </div>
      <?php echo form_close();
      }     
       
    echo form_open_multipart('controller_actividades/index');?>
       <button type="submit" class="btn btn-primary"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
    <?php echo form_close();?>
      </div>
    </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

