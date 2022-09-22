<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >MODIFICAR UNIDAD DE NEGOCIO</h5>              
    </div>
    <?php 
        foreach ($infocargo->result() as $row) {
        echo form_open_multipart('controller_cargos/modificarbd');
        ?>
        <input type="hidden" name="idCargo" value="<?php echo $row->idCargo; ?>">
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Denominación de Cargo:</label>
        </div>
        <div class="col-md-8">
          <input type="text" name="cargo" class="col-md-12 form-control" value="<?php echo $row->denominacionCargo;?>" autocomplete="off" > <br><br><br>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Unidad de Negocio:</label>
        </div>
        <div class="col-md-8">
          <select name="idUnidadNegocio" class="col-md-12 form-control" required autocomplete="off">
            <option value="<?php echo $row->idUnidadNegocio;?>"><?php echo $row->lineaNegocio;?></option>
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
      <button type="submit" class="btn btn-success"><i class="fa fa-edit (alias)"></i>  Modificar Unidad de Negocio</button>
      <?php 
      echo form_close();
      }
      ?> 
    </div>
    </div>
</div>
</div>