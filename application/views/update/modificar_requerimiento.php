<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
      <div class="x_title text-center">
        <h5 >MODIFICAR REQUERIMIENTO DE INFORMACIÓN</h5>
      </div> <br>
      <?php 
      echo form_open_multipart('controller_requerimientoinformacion/modificarbd');

        foreach ($info->result() as $row) {
      ?>
      <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
      <input type="hidden" name="idunidad" value="<?php echo $_POST ['idunidad'];?>">
      <input type="hidden" name="idrequerimiento" value="<?php echo $_POST ['idrequerimiento'];?>">
      <input type="hidden" name="requerimiento" value="<?php echo $_POST['requerimiento'];?>">      
      <div class="row">
        <div class="col-md-12">
          <label class="float-left">UNIDAD DE NEGOCIO:</label>
          <select name="gradocriticidad" class="col-md-12 form-control" autocomplete="off">
            <option value="<?php echo $row->idUnidadNegocio;?>"><?php echo $row->lineaNegocio;?></option>
                <?php
                $indice=1;
                 foreach ($unidadnegocio->result() as  $urow)
              {?> <option value="<?php echo $urow->idUnidadNegocio;?>">
                <?php echo $indice.'  '. $urow->lineaNegocio;?>
                </option><?php
                $indice++;
                }?>
          </select>
        </div> 
      </div><br>
        <div class="row">
        <div class="col-md-12">
          <label class="float-left">REQUERIMIENTO DE INFORMACIÓN:</label>
          <input type="text" name="suproceso" class="col-md-12 form-control" value="<?php echo $row->requerimientoInformacion; ?>" autocomplete="off"><br>
          <p><?php echo form_error('subproceso');?></p>
        </div>
      </div><hr>
      <div class="row float-right"> 
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalConfirmacion"><i class="fa fa-edit (alias)"></i>  Modificar</button>
       <!-- ALERTA PARA ACCIONES-->
          <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-right" id="exampleModalLongTitle">MODIFICAR</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <p style="font-size: 20px;">Estás seguro de modificar los datos?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit (alias)"></i>  Modificar</button>
                </div>
              </div>
            </div>
          </div>
      <?php 
    }
      echo form_close();
      echo form_open_multipart('controller_requerimientoinformacion/detallerequerimiento');
          ?>
          <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
          <input type="hidden" name="idunidad" value="<?php echo $_POST ['idunidad'];?>">
          <input type="hidden" name="idrequerimiento" value="<?php echo $_POST ['idrequerimiento'];?>"> 
          <input type="hidden" name="requerimiento" value="<?php echo $_POST['requerimiento'];?>"> 
          <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <?php echo form_close();?>
      </div>
  </div>
  </div>
</div>
</div>