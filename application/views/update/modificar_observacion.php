<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
      <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >HALLAZGO</h5>
      </div> <br>
       <?php 
        foreach ($info->result() as $row) {
      ?>
      <h5 style="font-weight: bold; color: #000000; " >DATOS</h5> <br>
      <div class="row">
        <div class="col-md-10">
          <label class="float-left">OBSERVACIÓN:</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->descripcionHallazgo; ?>" disabled >
        </div>
        <div class="col-md-2">
          <label class="float-left">ATENCIÓN:</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->prioridadAtencion; ?>" disabled  >
        </div> 
      </div><br>
        <hr>
      <h5  >COMENTARIOS</h5> <br>
      <?php 
      }
  
      echo form_open_multipart('controller_hallazgos/insertarcomentario');
      ?>
      <input type="hidden" name="idhallazgo" value="<?php echo $_POST ['idhallazgo'];?>">
      <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
      <input type="hidden" name="estadoProceso" value="<?php echo $_POST ['estadoProceso'];?>">
        <div class="row">
          <div class="col-md-12">
            <label>ACCIÓN CORRECTIVA:</label>
            <input type="text" class="form-control input-lg" placeholder="Redacte su acción correctiva" name="comentario" value="<?php echo $row->comentarioResponsable;?>" autocomplete="off" >
             <p><?php echo form_error('comentario');?></p>
          </div>
        </div> <br>
        <div class="row">
        <div class="col-md-6">
          <label>PLAZO PROPUESTO:</label>
          <input type="date" class="col-md-12 form-control" name="fecha" value="<?php echo $row->plazoAccionCorrectiva;?>">
          <p><?php echo form_error('fecha');?></p>
        </div>
        <div class="col-md-6">
          <label>RESPONSABLES:</label>
          <select name="responsable" class="col-md-12 form-control" autocomplete="off">
            <?php if ($row->responsable==" ") {?>
              <option value="">Seleccione...</option>
           <?php  } else { ?>
                <option value="<?php echo $row->idEmpleado;?>"><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></option>
                    <?php
                     foreach ($empleado->result() as  $rowa)
                  {?> <option value="<?php echo $rowa->idEmpleado;?>">
                    <?php echo $rowa->nombres.' '.$rowa->primerApellido.' '.$rowa->segundoApellido;?>
                    </option><?php
                    } }?>
              </select><br>
              <p><?php echo form_error('responsable');?></p>
        </div>
        </div>
        <hr>
        <div class="row float-right">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-database"></i>  Guardar</button>
      <?php 
      echo form_close();
      echo form_open_multipart('controller_hallazgos/observacionesenviadas');
        ?>
        <input type="hidden" name="idhallazgo" value="<?php echo $_POST ['idhallazgo'];?>">
      <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
      <input type="hidden" name="estadoProceso" value="<?php echo $_POST ['estadoProceso'];?>">
        <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
      <?php echo form_close();?>

      </div>
  </div>
</div>
    </div>
  </div>
</div>