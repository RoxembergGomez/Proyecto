<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >UNIDAD DE NEGOCIO ELIMINADOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
             <div class="row float-left">
                <?php echo form_open_multipart('controller_unidadnegocio/index');?>
                    <button type="submit" class="btn btn-success"><i class="fa fa-list-ol"></i>  Lista Unidades de Negocio Activos</button>
                <?php echo form_close();?>
              </div>  
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
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
              foreach ($unidadnegocio->result() as  $row)
              {
              ?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td><?php echo $row->lineaNegocio;?></td>                    
              <?php
                if($this->session->userdata('tipo')=='jefe')
                {
              ?> 
                    <td>
                      <?php echo form_open_multipart('controller_unidadnegocio/recuperarbd');?>
                        <input type="hidden" name="idUnidadNegocio" value="<?php echo $row->idUnidadNegocio;?>" >
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
</div>