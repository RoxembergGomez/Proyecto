<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 >LISTA DE EMPLEADOS</h5> 
    </div>
    <div class="row justify-content-between">
      <?php echo form_open_multipart('controller_empleados/agregar');?>
        <button type="submit" class="btn btn-primary btn-sm" id="botleft"><i class="fa fa-database"></i> Agregar</button>
      <?php echo form_close();?>
              <?php echo form_open_multipart('controller_empleados/eliminados');?>
                <button  type="submit" class="btn btn-info btn-sm text-left float-right"><i class="fa fa-trash"></i> Inactivos</button>
              <?php echo form_close();?>
    </div>  <hr>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">C.I.</th>
                    <th class="text-center">Expedido</th>
                    <th class="text-center">Nombre(s) y Apellido(s)</th> 
                    <th class="text-center">Cargo</th>
                    <th class="text-center">Nro. Celular</th>
                    <th class="text-center">Nro. Teléfono Interno</th>
                    <th class="text-center">Correo</th>
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
              foreach ($empleados->result() as  $row)
              {
              ?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td class="text-center"><?php echo $row->ci;?></td>
                    <td class="text-center"><?php echo $row->expedicion;?></td>
                    <td ><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></td>
                    <td><?php echo $row->denominacionCargo;?></td>
                    <td class="text-center"><?php if($row->celular==''){
                      echo '-----';
                    }else{
                      echo $row->celular;
                    };?></td>
                    <td class="text-center"><?php if ($row->telefonoInterno=='') {
                      echo '-----';
                    } else{
                      echo $row->telefonoInterno;
                    }
                    ?></td>
                    <td><?php echo $row->correoInstitucional;?></td>
                    
              <?php
                if($this->session->userdata('tipo')=='jefe')
                {
              ?> 
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i></button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                         <?php echo form_open_multipart('controller_empleados/modificar');?>        
                            <input type="hidden" name="idEmpleado" value="<?php echo $row->idEmpleado;?>">
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                          <?php echo form_close();?>

                            <input type="hidden" name="idEmpleado" value="<?php echo $row->idEmpleado;?>">
                            <button type="submit" name="botton" value="Eliminar" class="dropdown-item" onclick="return confirm_modalFotos(<?php echo $row->idEmpleado; ?>)" ><i class="fa fa-trash"></i>  Eliminar</button>
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
            var url = '<?php echo base_url() . "index.php/controller_empleados/eliminarbd/"; ?>';
            $("#url-delete").attr('href', url + id);
            $('#modalConfirmacion').modal('show');
        } 
</script>