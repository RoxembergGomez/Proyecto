<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left" >
      <?php 
        echo form_open_multipart('controller_unidadnegocio/index');?>
          <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Volver a la lista unidades de negocio activos" id="atras" style="background: black;">
            <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 style="font-weight: bold; color: #000000; " >UNIDAD DE NEGOCIO ELIMINADOS</h5> 
    </div>

    <div class="x_content">
      <div class="row">
        <div class="col-sm-12"> 
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Unidad de Negocio</th>
                    <th class="text-center">Acciones</th> 
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
                      <div class="row justify-content-center">
                      <?php echo form_open_multipart('controller_unidadnegocio/recuperarbd');?>
                        <input type="hidden" name="idUnidadNegocio" value="<?php echo $row->idUnidadNegocio;?>" >
                        <button type="submit" name="botton" value="recuperar" class="btn btn-warning "><i class="fa fa-database"></i> Recuperar</button>
                      <?php echo form_close(); ?>
                      </div>
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