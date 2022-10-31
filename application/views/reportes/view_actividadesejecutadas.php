
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_actividades/index');?>
                    <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Retroceder">
                            <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 style="font-weight: bold; color: #000000; " >LISTA DE ACTIVIDADES EJECUTADAS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="row justify-content-between">
            <?php echo form_open_multipart('controller_actividades/index');?>
              <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-list-ol"></i>  Lista de Actividades</button>
            <?php echo form_close();?>
                <?php 
                echo form_open_multipart('controller_actividades/ejecutadaspdf');?>
                    <button  type="submit" class="btn btn-info btn-sm" formtarget="_blank"><i class="fa fa-file-pdf-o"></i> Reporte pdf</button>
                <?php echo form_close();?>
         </div>
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                  <th class="text-center">Nro. Informe</th>
                  <th class="text-center">Informe</th>
                  <th class="text-center">Objetivos</th>
                  <th class="text-center">Fecha de Inicio</th>
                  <th class="text-center">Fecha de Conclusión</th>
                  <th class="text-center">Grado de Priorización</th>
                  <th class="text-center">Estado Proceso</th>
                  <th class="text-center">Informe Adjunto</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($ejecutadas->result() as  $row)
              {
              ?>
                 <tr>
                  <td class="text-center"><?php echo $indice;?></td>
                  <td ><?php echo $row->numeroInforme;?></td>
                  <td ><?php echo $row->informe;?></td>
                  <td><?php echo $row->objetivo;?></td>
                  <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                  <td class="text-center"><?php echo formatearFecha($row->fechaConclusion);?></td>
                  <td class="text-center"><?php echo $row->gradoPriorizacion;?></td>
                  <td class="text-center"><?php if ($row->estadoEjecucion=='2') {
                    echo 'Ejecutado';
                  };?></td>
                  <td>
                    <?php 
                      $docInforme=$row->docInforme;
                      if ($docInforme=="Sin Informe") 
                      {
                        ?>
                        <p>Sin Informe</p>
                    <?php  
                      }
                      else
                      {
                    ?>
                        <a href="<?php echo base_url();?>/uploads/<?php echo $docInforme?>">
                          <img src="<?php echo base_url();?>/uploads/logopdf.png" width="50px">
                        </a>
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
