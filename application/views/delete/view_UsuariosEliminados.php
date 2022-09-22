<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >USUARIOS ELIMINADOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
             <div class="row float-left">
                <?php echo form_open_multipart('controller_usuarios/index');?>
                    <button type="submit" class="btn btn-success"><i class="fa fa-list-ol"></i>  Lista de Usuarios Activos</button>
                <?php echo form_close();?>
              </div>  
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                   <th class="text-center">Nombre(s) y Apellido(s)</th> 
                    <th class="text-center">Nombre Usuario</th> 
                    <th class="text-center">Tipo Usuario</th>
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
                      <?php echo form_open_multipart('controller_usuarios/recuperarbd');?>
                        <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario;?>" >
                        <button type="submit" name="botton" value="recuperar" class="btn btn-warning"><i class="fa fa-database"></i> Recuperar</button>
                      <?php echo form_close(); ?>
                    </td>
              <?php } ?>
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