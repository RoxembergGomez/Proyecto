<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >LISTA DE EMPLEADOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
              <div class="row float-left">
                <?php echo form_open_multipart('controller_empleados/agregar');
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?>
                    <button type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-database"></i> Agregar Empleados</button>
                <?php
                  } 
                echo form_close();
                echo form_open_multipart('controller_empleados/eliminados');?>
                    <button  type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-trash"></i> Empleados Eliminados</button>
                <?php echo form_close();?>

              </div>  
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">C.I.</th>
                    <th class="text-center">Expedido</th>
                    <th class="text-center">Nombres y Apellidos</th> 
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
                    <td class="text-center"><?php echo $row->celular;?></td>
                    <td class="text-center"><?php echo $row->telefonoInterno;?></td>
                    <td><?php echo $row->correoInstitucional;?></td>
                    
              <?php
                if($this->session->userdata('tipo')=='jefe')
                {
              ?> 
                  <td>
                    <ul >
                      <li   class="nav-item dropdown open text-center" style="list-style:none;">
                        <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-justify"></i>
                        </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding: 0px;">
                          <?php echo form_open_multipart('controller_empleados/modificar');?>        
                            <input type="hidden" name="idEmpleado" value="<?php echo $row->idEmpleado;?>">
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                          <?php echo form_close(); 
                          echo form_open_multipart('controller_empleados/eliminarbd');?>    
                            <input type="hidden" name="idEmpleado" value="<?php echo $row->idEmpleado;?>">
                            <button type="submit" name="botton" class="dropdown-item"><i class="fa fa-trash"></i>Eliminar</button>
                          <?php echo form_close();?>
                          </div>
                        </li>
                    </ul>
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