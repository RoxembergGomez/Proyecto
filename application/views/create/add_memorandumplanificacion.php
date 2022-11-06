<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5>ASIGNAR MEMORANDUM DE PLANIFICACIÓN DE AUDITORÍA</h5>              

    </div> <hr>
     <?php
      echo form_open_multipart('controller_memorandumplanificacion/agregarbdd');
        foreach ($infoid->result() as $row)
        {
        ?>
        <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo; ?>" required>
       <?php } ?>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">NRO. DE INFORME:</label>
        </div>
        <div class="col-md-8">
          <input type="text" name="numeroInforme" class="col-md-12 form-control" placeholder="Ingrese Nro. de Informe" autocomplete="off" value="UAI-P000/2022" > <br>
          <p style="color: red;"><?php echo form_error('numeroInforme');?></p>
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">RESPONSABLE DE EJECUCIÓN:</label>
        </div>
        <div class="col-md-8">
            <select name="idEmpleado" class="col-md-12 form-control" value="<?php echo set_value('idEmpleado'); ?>" autocomplete="off">
            <option value="">Selecione un responsable</option>
                <?php
                 foreach ($seleccion->result() as  $row)
              {?> <option value="<?php echo $row->idEmpleado;?>">
                <?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?>
                </option><?php
                }?>
          </select><br>
          <p style="color: red;"><?php echo form_error('idEmpleado');?></p>
        </div>
      </div>

      <hr>
      <div class="row float-right">
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-database"></i>  Guardar</button>
      <?php 
      echo form_close();
      echo form_open_multipart('controller_actividades/index');?>
          <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
      <?php echo form_close();?>
      </div>
    </div>
    </div>
  </div>
</div>