<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >ASIGNAR MEMORANDUM DE PLANIFIACIÓN DE AUDITORÍA</h5>              
      <?php
      echo form_open_multipart('controller_memorandumplanificacion/agregarbdd');
      ?>
    </div>
     <?php 
        foreach ($infoid->result() as $row)
        {
        ?>
        <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo; ?>" required>
       <?php } ?>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Nro. Informe:</label>
        </div>
        <div class="col-md-8">
          <input type="text" name="numeroInforme" class="col-md-12 form-control" placeholder="Ingrese Nro. de Informe" required autocomplete="off"> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Responsable de Ejecución</label>
        </div>
        <div class="col-md-8">
            <select name="idEmpleado" class="col-md-12 form-control" required autocomplete="off">
            <option>Selecione un responsable</option>
                <?php
                 foreach ($seleccion->result() as  $row)
              {?> <option value="<?php echo $row->idEmpleado;?>">
                <?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?>
                </option><?php
                }?>
          </select> <br><br><br> 
        </div>
      </div>

      <hr>
      <button type="submit" class="btn btn-success"><i class="fa fa-database"></i>  Asignar MPA</button>
      <?php 
      echo form_close();
      ?>
    </div>
    </div>
  </div>
</div>