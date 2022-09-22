<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >EMPLEADOS ELIMINADOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
             <div class="row float-left">
                <?php echo form_open_multipart('controller_empleados/index');?>
                    <button type="submit" class="btn btn-success"><i class="fa fa-list-ol"></i>  Lista de Empleados Activos</button>
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
                    <th scope="col">Acciones</th> 
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
                      <?php echo form_open_multipart('controller_empleados/recuperarbd');?>
                        <input type="hidden" name="idEmpleado" value="<?php echo $row->idEmpleado;?>" >
                        <button type="submit" name="botton" value="recuperar" class="btn btn-warning"><i class="fa fa-database"></i> Recuperar</button>
                      <?php echo form_close(); ?>
                    </td>
                 <?php
              }
            ?>  
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