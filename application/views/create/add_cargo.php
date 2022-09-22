<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >AGREGAR CARGO</h5>              
      <?php
      echo form_open_multipart('controller_cargos/agregarbdd');
      ?>
    </div>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Denominación de Cargo:</label>
        </div>
        <div class="col-md-8">
          <input type="text" name="cargo" class="col-md-12 form-control" placeholder="Describa el cargo" autocomplete="off" > <br><br><br>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Unidad de Negocio:</label>
        </div>
        <div class="col-md-8">
          <select name="idUnidadNegocio" class="col-md-12 form-control" required autocomplete="off">
            <option>Selecione la Unidad de Negocio</option>
               <?php
                 foreach ($seleccion->result() as  $row)
              {?> <option value="<?php echo $row->idUnidadNegocio;?>">
                <?php echo $row->lineaNegocio;?>
                </option><?php
                }?>
          </select>
        </div>
      </div>
      <hr>
      <button type="submit" class="btn btn-success"><i class="fa fa-database"></i>  Agregar Cargo</button>
      <?php 
      echo form_close();
      ?>
    </div>
    </div>
  </div>
</div>
