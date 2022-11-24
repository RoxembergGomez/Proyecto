<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 >LISTA DE PROCESOS</h5> 
    </div>
    
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
              <div class="row float-left">
                <?php echo form_open_multipart('controller_procesos/agregar');
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?>
                    <button type="submit" class="btn btn-success"><i class="fa fa-database"></i> Agregar Procesos</button>
                <?php
                  } 
                echo form_close();

                echo form_open_multipart('controller_procesos/eliminados');?>
                    <button  type="submit" class="btn btn-success"><i class="fa fa-trash"></i> Precesos Eliminados</button>
                <?php echo form_close();?>

              </div>  
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                  <th class="text-center">Procesos</th>
                  <th class="text-center">Sub-Procesos</th>
                  <th class="text-center">Clasificación de Criticidad</th>
                <?php
                  if($this->session->userdata('tipo')=='jefe')
                  {
                ?> 
                    <th scope="col">Acciones</th> 
                <?php
                  }
                ?>
                
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($proceso->result() as  $row)
              {
              ?>
    	           <tr>
              		<td class="text-center" ><?php echo $indice;?></td>
              		<td ><?php echo $row->descripcionProceso;?></td>
              		<td><?php echo $row->descripcionSubProceso;?></td>
              		<td class="text-center"><?php echo $row->clasificacionCriticidad;?></td>
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
                          <?php echo form_open_multipart('controller_procesos/modificar');?>        
                            <input type="hidden" name="idProceso" value="<?php echo $row->idProceso;?>" >
                            <button type="submit" class="dropdown-item" ><i class="fa fa-edit (alias)"></i>  Modificar</button>
                          <?php echo form_close(); 
                          echo form_open_multipart('controller_procesos/eliminarbd');?>    
                            <input type="hidden" name="IdProceso" value="<?php echo $row->idProceso;?>">
                            <button type="submit" name="botton" value="Eliminar" class="dropdown-item"><i class="fa fa-trash"></i>Eliminar</button>
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
</div>