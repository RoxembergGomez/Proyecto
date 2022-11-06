<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
      <div class="x_title text-center">
        <h5 >MODIFICAR PROGRAMA DE TRABAJO</h5>
      </div> <br>
      <?php 
      echo form_open_multipart('controller_programas/modificarbd');
      ?>
      <?php 
        foreach ($actividades->result() as $row) {
      ?>
      <h5>DATOS</h5><br> 
      <input type="hidden" name="idprograma" value="<?php echo $_POST ['idprograma'];?>">
      <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
      <input type="hidden" name="estadoPrograma" value="<?php echo $_POST ['estadoPrograma'];?>">
      <div class="row">
        <div class="col-md-10">
          <label class="float-left">SUBPROCESO:</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->descripcionSubProceso; ?>" disabled >
        </div>
        <div class="col-md-2">
          <label class="float-left">GRADO PRIORIZACIÓN:</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->clasificacionCriticidad; ?>" disabled  >
        </div> 
      </div><br>
        <div class="row">
        <div class="col-md-12">
          <label class="float-left">DESCRICIÓN DE ACTIVIDAD:</label>
          <input type="text" name="programa" class="col-md-12 form-control" value="<?php echo $row->actividad; ?>" autocomplete="off"><br>
          <p style="color: red;"><?php echo form_error('programa');?></p>
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
      echo form_open_multipart('controller_programas/actividades');
          ?>
          <input type="hidden" name="idmpa" value="<?php echo $_POST ['idmpa'];?>">
          <input type="hidden" name="estadoPrograma" value="<?php echo $_POST ['estadoPrograma'];?>">
          <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <?php echo form_close();?>
      </div>
  </div> <br>
  </div>
  </div>
</div>