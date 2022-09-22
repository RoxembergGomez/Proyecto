<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; ">LISTA DE USUARIOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
              <div class="row float-left">
                <?php echo form_open_multipart('controller_usuarios/agregar');
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?>
                    <button type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-database"></i> Agregar Usuarios</button>
                <?php
                  } 
                echo form_close();
                echo form_open_multipart('controller_usuarios/eliminados');?>
                    <button  type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-trash"></i> Usuarios Eliminados</button>
                <?php echo form_close();?>
              </div>  
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                   <th class="text-center">Nombre (s) y Apellido(s)</th> 
                    <th class="text-center">Nombre de Usuario</th> 
                    <th class="text-center">Tipo de Usuario</th>
                <?php
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?> 
                    <th th class="text-center">Acciones</th> 
                <?php
                  }
                ?>
                
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($usuario->result() as  $row)
              {
              ?>
                  <tr>
                    <td th class="text-center" ><?php echo $indice;?></td>
                    <td ><?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?></td>
                    <td ><?php echo $row->usuario;?></td>
                    <td><?php echo $row->tipo;?></td>
              <?php
                if($this->session->userdata('tipo')=='jefe')
                {
              ?> 
                  <td>
                    <ul>
                      <li class="nav-item dropdown open" style="list-style:none;">
                        <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-align-justify"></i>
                        </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding: 0px;">
                          <?php echo form_open_multipart('controller_usuarios/modificar');?>        
                            <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario;?>" >
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                          <?php echo form_close(); 
                          echo form_open_multipart('controller_usuarios/eliminarbd');?>    
                            <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario;?>">
                            <button type="submit" name="botton" value="Deshabilitar" class="dropdown-item"><i class="fa fa-trash"></i>Eliminar</button>
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