<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 >INGRESE LAS ACTIVIDADES A REALIZAR</h5>                 
      <?php
      echo form_open_multipart('controller_actividades/agregarbdd');
      ?>
    </div>
      <div class="row">
        <div class="col-md-12">
          <label >INFORME:</label>
          <input type="text" name="informe" class="col-md-12 form-control" placeholder="Ingrese el informe a realizar" autocomplete="off" value="<?php echo set_value('informe'); ?>"><br>
          <p style="color: red;"><?php echo form_error('informe');?></p>
        </div>
      </div> <br>  
      <div class="row">
        <div class="col-md-12">
         <label>OBJETIVO:</label>
          <input type="text" name="objetivo" class="col-md-12 form-control" placeholder="Ingrese el objetivo" autocomplete="off" value="<?php echo set_value('objetivo'); ?>"> <br>
          <p style="color: red;"><?php echo form_error('objetivo');?></p>
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-12">
          <label>NORMATIVA RELACIONADA:</label>
          <input type="text" name="normativa" class="col-md-12 form-control" placeholder="Ingrese la normativa relacionada" autocomplete="off" value="<?php echo set_value('normativa'); ?>"><br>
          <p style="color: red;"><?php echo form_error('normativa');?></p>
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-4">
          <label>FECHA DE INICIO:</label>
          <input type="date" name="fechaInicio" placeholder="Ingrese la fecha de inicio" class="col-md-12 form-control" autocomplete="off" value="<?php echo set_value('fechaInicio'); ?>"><br>
          <p style="color: red;"><?php echo form_error('fechaInicio');?></p>
        </div>
        <div class="col-md-4">
          <label >FECHA DE CONCLUSIÓN:</label>
          <input type="date" name="fechaConclusion" class="col-md-12 form-control" placeholder="Ingrese la fecha de conclusión" autocomplete="off" value="<?php echo set_value('fechaConclusion'); ?>" > <br>
          <p style="color: red;"><?php echo form_error('fechaConclusion');?></p>
        </div>
        <div class="col-md-4">
          <label >GRADO DE PRIORIZACIÓN:</label>
          <select name="gradoPriorizacion" class="col-md-12 form-control" autocomplete="off" value="<?php echo set_value('gradoPriorizacion'); ?>">
            <option value="">Seleccione... </option>
            <option value="Alta">Alta</option>
            <option value="Media">Media</option>
            <option value="Baja">Baja</option>
          </select> <br>
          <p style="color: red;"><?php echo form_error('gradoPriorizacion');?></p>
        </div>
      </div>
      <hr>
      <div class="row float-right">
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-database"></i>  Guardar</button>
      <?php 
      echo form_close();
      echo form_open_multipart('controller_actividades/index');
        ?>
        <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
      <?php echo form_close();?>
      </div>
    </div>
    </div>
  </div>
</div>