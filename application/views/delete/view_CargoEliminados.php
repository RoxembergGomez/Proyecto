<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >LISTA DE CARGOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
              <div class="row float-left">
                 <?php echo form_open_multipart('controller_cargos/index');?>
                    <button type="submit" class="btn btn-success"><i class="fa fa-list-ol"></i>  Lista Unidades de Cargos Activos</button>
                <?php echo form_close();?>

              </div>  
    
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
                    <td>
                      <?php echo form_open_multipart('controller_cargos/recuperarbd');?>
                        <input type="hidden" name="idCargo" value="<?php echo $row->idCargo;?>" >
                        <button type="submit" name="botton" value="recuperar" class="btn btn-warning center-block"><i class="fa fa-database"></i> Recuperar</button>
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