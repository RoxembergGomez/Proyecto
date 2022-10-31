<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >AGREGAR CARGO</h5>              
    </div> <hr>
      <?php
      echo form_open_multipart('controller_cargos/agregarbdd');
      ?>    
      <div class="row">
        <div class="col-md-12">
          <label >DENOMINACIÓN DE CARGO:</label>
          <input type="text" name="cargo" class="col-md-12 form-control" placeholder="Describa el cargo" autocomplete="off" value="<?php echo set_value('cargo'); ?>" > <br>
          <p style="color: red;"><?php echo form_error('cargo');?></p>
        </div>
      </div> <br>

      <div class="row">
        <div class="col-md-12">
          <label>UNIDAD DE NEGOCIO:</label>
          <select name="idUnidadNegocio" class="col-md-12 form-control" required autocomplete="off" value="<?php echo set_value('idUnidadNegocio'); ?>">
            <option value=" ">Selecione la Unidad de Negocio</option>
               <?php
                 foreach ($seleccion->result() as  $row)
              {?> <option value="<?php echo $row->idUnidadNegocio;?>">
                <?php echo $row->lineaNegocio;?>
                </option><?php
                }?>
          </select> <br>
          <p style="color: red;"><?php echo form_error('idUnidadNegocio');?></p>
        </div>
      </div>
      <hr>
      <div class="row float-right">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-database"></i>  Guardar</button>
         <?php 
        echo form_close();
        echo form_open_multipart('controller_cargos/index');
          ?>
          <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <?php echo form_close();?>
      </div>
    </div>
    </div>
  </div>
</div>
