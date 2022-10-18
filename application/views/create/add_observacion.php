<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
      <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >HALLAZGO</h5>
       
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

      <h5 style="font-weight: bold; color: #000000; " >OBSERVACIÓN</h5> 
      <?php 
      }
      echo form_open_multipart('controller_programas/agregarObservacion');
      ?>
        
      <input type="text" name="idprograma" value="<?php echo $_POST ['idprograma'];?>">
      <input type="text" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
        <div class="row">
          <div class="col-md-12">
            <label>OBSERVACIÓN</label>
            <textarea type="text" class="form-control input-lg" placeholder="Redacte la observación" name="observacion"></textarea>
          </div>
        </div> <br>
        <div class="row">
        <div class="col-md-4">
          <label>PRIORIDAD ATENCIÓN</label>
          <select type="text" class="form-control input-xlg" name="prioridad">
              <option value="">Seleccione</option>
              <option value="ALTA">ALTA</option>
              <option value="MEDIA">MEDIA</option>
               <option value="BAJA">BAJA</option>
          </select>
        </div>
        <div class="col-md-4">
          <label>EMPLEADO RESPONSABLE</label>
          <input type="text" class="col-md-12 form-control" name="idEmpleado"> 
        </div>
        <div class="col-md-4">
          <label>ANEXO</label>
          <input type="file" class="col-md-12 form-control" name="userfile"> 
        </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-success"><i class="fa fa-database"></i>  Ejecutar</button>
      <?php 
      echo form_close();
      ?>
  </div> <br>
</div>
    </div>
  </div>
</div>