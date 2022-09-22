<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >MODIFICAR UNIDAD DE NEGOCIO</h5>              
    </div>
    <?php 
        foreach ($infounidadnegocio->result() as $row) {
        echo form_open_multipart('controller_unidadnegocio/modificarbd');
        ?>
        <input type="hidden" name="idUnidadNegocio" value="<?php echo $row->idUnidadNegocio; ?>">
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Unidad de Negocio:</label>
        </div>
        <div class="col-md-8">
          <input type="text" name="unidadnegocio" class="col-md-12 form-control" value="<?php echo $row->lineaNegocio; ?>"> <br><br><br>
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