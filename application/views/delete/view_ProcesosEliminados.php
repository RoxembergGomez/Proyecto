<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_procesos/index');?>
          <input type="hidden" name="idPlan" value="<?php echo $_POST['idPlan']; ?>">
          <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Lista de procesos">
          <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 style="font-weight: bold; color: #000000; " >LISTA DE PROCESOS ELIMINADOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                  <th class="text-center">Informe</th>
                  <th class="text-center">Procesos</th>
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
              foreach ($proceso->result() as  $row)
              {
              ?>
    	           <tr>
              		<td class="text-center" ><?php echo $indice;?></td>
                  <td ><?php echo $row->informe;?></td>
              		<td ><?php echo $row->descripcionProceso;?></td>
                  <td ><?php echo $row->lineaNegocio;?></td>
              		<?php
               		 if($this->session->userdata('tipo')=='jefe')
                	{
              		?> 
                  <td class="text-center">
                      <?php echo form_open_multipart('controller_procesos/recuperarbd');?>
                        <input type="hidden" name="idproceso" value="<?php echo $row->idProceso;?>">
                        <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo;?>">
                        <button type="submit" value="recuperar" class="btn btn-warning"><i class="fa fa-database"></i> Recuperar</button>
                      <?php echo form_close(); ?>
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
