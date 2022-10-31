<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5>MODIFICAR ACTIVIDAD</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">

      <?php 
        foreach ($infoactividad->result() as $row) {
        echo form_open_multipart('controller_actividades/modificarbd');
        ?>
        <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo; ?>" >
      <div class="row">
        <div class="col-md-12">
          <label>INFORME:</label>
          <input type="text" name="informe" class="col-md-12 form-control" value="<?php echo $row->informe; ?>" > <br>

        </div>
      </div> <br>
      <div class="row">
        <div class="col-md-12">
         <label>OBJETIVO:</label>
          <input type="text" name="objetivo" class="col-md-12 form-control" value="<?php echo $row->objetivo; ?>" > <br>

        </div>
      </div> <br>
      <div class="row">
        <div class="col-md-12">
         <label >NORMATIVA:</label>
          <input type="text" name="normativa" class="col-md-12 form-control" value="<?php echo $row->normativa; ?>" > <br>

        </div>
      </div> <br>
      <div class="row">
        <div class="col-md-4">
          <label >FECHA DE INICIO:</label>
          <input type="date" name="fechaInicio" class="col-md-12 form-control" value="<?php echo $row->fechaInicio; ?>"  > <br>

        </div>
        <div class="col-md-4">
          <label >FECHA DE CONCLUSIÓN:</label>
          <input type="date" name="fechaConclusion" class="col-md-12 form-control" value="<?php echo $row->fechaInicio;?>" > <br>

        </div>
        <div class="col-md-4">
          <label >GRADO DE PRIRIZACIÓN:</label>
          <select name="gradoPriorizacion" class="col-md-12 form-control" >
            <option><?php echo $row->gradoPriorizacion; ?></option>
            <option value="Alta">Alta</option>
            <option value="Media">Media</option>
            <option value="Baja">Baja</option>
          </select>
        </div>
      </div>
       <hr>
      <div class="row float-right">
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalConfirmacion"><i class="fa fa-edit (alias)"></i>  Modificar</button>


        <!-- ALERTA PARA ACCIONES-->
          <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-right" id="exampleModalLongTitle">MODIFICAR</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <p style="font-size: 20px;">Estás seguro de modificar los datos?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit (alias)"></i>  Modificar</button>
                </div>
              </div>
            </div>
          </div>
      <?php echo form_close();
      }     
       
    echo form_open_multipart('controller_actividades/index');?>
       <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
    <?php echo form_close();?>
      </div>
    </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

