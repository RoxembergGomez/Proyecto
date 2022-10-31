<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5>AGREGAR PROCESOS</h5>              
      <?php
      echo form_open_multipart('controller_procesos/agregarbdd');
      ?>

    </div> <hr>

      <div class="row">
          <input type="hidden" name="idplan" value="<?php echo $_POST['idPlan'];?>">
        <div class="col-md-12">
          <label >UNIDAD DE NEGOCIO:</label>
          <select name="idUnidadNegocio" class="col-md-12 form-control" value="<?php echo set_value('idUnidadNegocio'); ?>" autocomplete="off">
            <option value="">Selecione...</option>
                <?php
                $indice=1;
                 foreach ($unidadnegocio->result() as  $urow)
              {?> <option value="<?php echo $urow->idUnidadNegocio;?>">
                <?php echo $indice.'  '. $urow->lineaNegocio;?>
                </option><?php
                $indice++;
                }?>
          </select> <br>
          <p style="color: red;"><?php echo form_error('idUnidadNegocio');?></p>
        </div> 
      </div><br>
        <div class="row">
        <div class="col-md-12">
          <label >DESCRIPCIÓN PROCESO:</label>
          <input type="text" name="proceso" class="col-md-12 form-control" placeholder="Describa el proceso" autocomplete="off" value="<?php echo set_value('proceso'); ?>" > <br>
             <p style="color: red;"><?php echo form_error('proceso');?></p>
        </div>
        </div><hr>

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