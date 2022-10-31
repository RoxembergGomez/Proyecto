<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >LISTA DE CARGOS</h5> 
    </div>
    <div class="row justify-content-between">
      <?php echo form_open_multipart('controller_cargos/agregar');?>
        <button type="submit" class="btn btn-primary btn-sm" id="botleft"><i class="fa fa-database"></i> Agregar</button>
      <?php echo form_close();?>
        <div class="btn-group" role="group" id="botright">
          <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>  Ver Cargos</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <?php echo form_open_multipart('controller_cargos/eliminados');?>
                <button  type="submit" class="btn btn-outline-info btn-sm col-sm-12 text-left"><i class="fa fa-trash"></i> Eliminados</button>
              <?php echo form_close();?>
            </div>
        </div>
    </div>  <hr>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Denominación Cargo</th>
                    <th class="text-center">Unidad de Negocio</th>
                <?php
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?> 
                    <th class="text-center">Acciones</th> 
                <?php
                  }
                ?>
                
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($cargo->result() as  $row)
              {
              ?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td><?php echo $row->denominacionCargo;?></td>
                    <td><?php echo $row->lineaNegocio;?></td>
              <?php
                if($this->session->userdata('tipo')=='jefe')
                {
              ?> 
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                         <?php echo form_open_multipart('controller_cargos/modificar');?>        
                            <input type="hidden" name="idCargo" value="<?php echo $row->idCargo;?>">
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                          <?php echo form_close();?>

                            <input type="hidden" name="idCargo" value="<?php echo $row->idCargo;?>">
                            <button type="submit" name="botton" value="Eliminar" class="dropdown-item" onclick="return confirm_modalFotos(<?php echo $row->idCargo; ?>)" ><i class="fa fa-trash"></i>  Eliminar</button>

                      </div>
                    </div>
                  <?php
                    } 
                  ?>
                  </td>
                  </tr>
            <?php
              $indice++;
              }
            ?>
              </tbody>
            </table>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!-- ALERTAS PARA ELIMINAR -->
<div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ELIMNAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <p style="font-size: 20px;">Estás seguro de eliminar los datos?</p>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <a id="url-delete" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>  Eliminar</a>
      </div>
    </div>
  </div>
</div>

<script>
     function confirm_modalFotos(id) {
            var url = '<?php echo base_url() . "index.php/controller_cargos/eliminarbd/"; ?>';
            $("#url-delete").attr('href', url + id);
            $('#modalConfirmacion').modal('show');
        } 
</script>