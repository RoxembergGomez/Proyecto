<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    
    <div class="x_title">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_hallazgos/enviadosdescargosuai');?>
                    <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Retroceder">
                            <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 class="text-center" >HALLAZGOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12"> 
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Observación</th>
                    <th class="text-center">Atención</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($observaciones->result() as  $row)
              {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td><?php echo $row->descripcionHallazgo;?></td>
                    <td class="text-center"><?php echo $row->prioridadAtencion;?></td>
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
