<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5>MODIFICAR CARGO</h5>              
    </div> <hr>
    <?php 
        foreach ($infompa->result() as $row) {
        echo form_open_multipart('controller_memorandumplanificacion/modificarbd');
        ?>
        <input type="hidden" name="idmpa" value="<?php echo $_POST['idmpa']; ?>">
            <div class="row">
            <div class="col-md-3">
              <label class="float-right">NRO. DE INFORME:</label>
            </div>
            <div class="col-md-8">
              <input type="text" name="numeroInforme" class="col-md-12 form-control" placeholder="Ingrese Nro. de Informe" autocomplete="off" value="<?php echo $row->numeroInforme;?>" > <br>
              <p style="color: red;"><?php echo form_error('numeroInforme');?></p>
            </div>
          </div><br>
          <div class="row">
            <div class="col-md-3">
              <label class="float-right">RESPONSABLE DE EJECUCIÓN:</label>
            </div>
            <div class="col-md-8">
                <select name="idEmpleado" class="col-md-12 form-control" autocomplete="off">
                <option value="<?php echo $row->idEmpleado;?>"><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></option>
                    <?php
                     foreach ($empleado->result() as  $rowa)
                  {?> <option value="<?php echo $rowa->idEmpleado;?>">
                    <?php echo $rowa->nombres.' '.$rowa->primerApellido.' '.$rowa->segundoApellido;?>
                    </option><?php
                    }?>
              </select><br>
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