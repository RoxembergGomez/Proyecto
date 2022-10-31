<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >AGREGAR UNIDAD DE NEGOCIO</h5>              
    </div> <hr>
      <?php
      echo form_open_multipart('controller_unidadnegocio/agregarbdd');
      ?>
      <div class="row">
        <div class="col-md-12">
          <label class="float-left" style="">UNIDAD DE NEGOCIO:</label>

          <input type="text" name="unidadnegocio" class="col-md-12 form-control" placeholder="Ingrese la unidad de negocio" autocomplete="off" value="<?php echo set_value('unidadnegocio'); ?>"></input> <br>
          <p style="color: red;"><?php echo form_error('unidadnegocio');?></p>
        </div>
      </div>
      <hr>
      <div class="row float-right">
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-database"></i>  Guardar</button>
      <?php 
      echo form_close();
      echo form_open_multipart('controller_unidadnegocio/index');
        ?>
        <button type="submit" class="btn btn-secondary btn-sm" id="botrights"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
      <?php echo form_close();?>
      </div>
    </div>
    </div>
  </div>
</div>