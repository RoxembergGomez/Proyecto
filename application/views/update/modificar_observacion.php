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
          <label class="float-left">OBSERVACIÓN</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->descripcionHallazgo; ?>" disabled >
        </div>
        <div class="col-md-2">
          <label class="float-left">ATENCIÓN</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->prioridadAtencion; ?>" disabled  >
        </div> 
      </div><br>
        <hr>
      <h5 style="font-weight: bold; color: #000000; " >COMENTARIOS</h5> <br>
      <?php 
      }
  
      echo form_open_multipart('controller_hallazgos/insertarcomentario');
      ?>
      <input type="hidden" name="idhallazgo" value="<?php echo $_POST ['idhallazgo'];?>">
      <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
        <div class="row">
          <div class="col-md-12">
            <label>ACCIÓN CORRECTIVA</label>
            <textarea type="text" class="form-control input-lg" placeholder="Redacte su acción correctiva" name="comentario"></textarea>
          </div>
        </div> <br>
        <div class="row">
        <div class="col-md-6">
          <label>PLAZO PROPUESTO</label>
          <input type="date" class="col-md-12 form-control" name="fecha"> 
        </div>
        <div class="col-md-6">
          <label>RESPONSABLES</label>
          <input type="text" class="col-md-12 form-control" placeholder="Redacte el/los responsables" name="responsable" autocomplete="off" > 
        </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-database"></i>  Guardar</button>
      <?php 
      echo form_close();
      ?>
  </div> <br>
</div>
    </div>
  </div>
</div>