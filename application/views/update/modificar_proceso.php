<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5>MODIFICAR CARGO</h5>              
    </div> <hr>
    <?php 
        foreach ($infoproceso->result() as $row) {
        echo form_open_multipart('controller_procesos/modificarbd');
        ?>
        <input type="hidden" name="idproceso" value="<?php echo $_POST['idproceso']; ?>">
        <input type="hidden" name="idPlan" value="<?php echo $_POST['idplan']; ?>">
          <div class="row">
            <div class="col-md-12">
              <label >UNIDAD DE NEGOCIO:</label>
              <select name="idUnidadNegocio" class="col-md-12 form-control" autocomplete="off">
                <option value="<?php echo $row->idUnidadNegocio;?>"><?php echo $row->lineaNegocio;?></option>
                    <?php
                    $indice=1;
                     foreach ($unidadnegocio->result() as  $urow)
                  {?> <option value="<?php echo $urow->idUnidadNegocio;?>">
                    <?php echo $indice.'  '. $urow->lineaNegocio;?>
                    </option><?php
                    $indice++;
                    }?>
              </select> <br>
            </div> 
          </div><br>
            <div class="row">
            <div class="col-md-12">
              <label >DESCRIPCIÓN PROCESO:</label>
              <input type="text" name="proceso" class="col-md-12 form-control" placeholder="Describa el proceso" autocomplete="off" value="<?php echo $row->descripcionProceso;?>"> <br>
                 <p style="color: red;"><?php echo form_error('proceso');?></p>
            </div>
            </div>
      <hr>
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
      echo form_close();
      }
       echo form_open_multipart('controller_memorandumplanificacion/index');
          ?>
          <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <?php echo form_close();?>
      
    </div>
    </div>
    </div>
</div>
</div>