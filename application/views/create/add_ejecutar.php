<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >EJECUTAR ACTIVIDAD</h5>              
    </div> <br>
     <?php 
        foreach ($info->result() as $row) {
      ?>
      <h5 style="font-weight: bold; color: #000000; " >DATOS</h5> 
      <div class="row">
        <div class="col-md-10">
          <label class="float-left">SUBPROCESO</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->descripcionSubProceso; ?>" disabled >
        </div>
        <div class="col-md-2">
          <label class="float-left">GRADO PRIORIZACIÓN</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->clasificacionCriticidad; ?>" disabled  >
        </div> 
      </div><br>
        <div class="row">
        <div class="col-md-12">
          <label class="float-left">DESCRICIÓN DE ACTIVIDAD</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->actividad; ?>" disabled >
        </div>
      </div> <br> <hr>

      <h5 style="font-weight: bold; color: #000000; " >EJECUCIÓN</h5> 
      <?php 
      }
      echo form_open_multipart('controller_programas/ejecutaractividad');
      ?>
      <input type="hidden" name="idprograma" value="<?php echo $_POST ['idprograma'];?>">
      <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
  		  <div class="row">        
          <div class="col-md-6">
            <label>VERIFICACIÓN</label>
            <select type="text" class="form-control input-xlg"
               id="txtNombres" name="verificacion">
                <option value="">Seleccione</option>
                <option value="1">SI</option>
                <option value="2">PARCIALMENTE</option>
                <option value="3">NO</option>
                <option value="4">N/A</option>
            </select>
          </div>
          <div class="col-md-6">
            <label>RESPALDO</label>
          <input type="file" class="col-md-12 form-control" name="userfile">                 
          </div>
      </div>         
        <hr>
        <button type="submit" name="ejecutar" class="btn btn-primary float-right"><i class="fa fa-database"></i>  Guardar</button>
      <?php 
      echo form_close();
      ?>
  </div> <br> <br>
        
</div>
    </div>
  </div>
</div>