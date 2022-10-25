<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >LISTA DE ACTIVIDADES PENDIENTES DE EJECUCIÓN</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="row float-left">
            <?php echo form_open_multipart('controller_actividades/index');?>
              <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-list-ol"></i>  Lista de Actividades</button>
            <?php echo form_close();?>
          </div>
          <div class="float-rigth">
            <?php echo form_open_multipart('controller_actividades/pendientespdf');?>
              <button type="submit" class="btn btn-info btn-sm float-right"><i class="fa fa-file-pdf-o"></i>  Reporte PDF</button>
            <?php echo form_close();?>
         </div> 
    
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                  <th class="text-center">Informe</th>
                  <th class="text-center">Objetivos</th>
                  <th class="text-center">Normativa Relacionada</th>
                  <th class="text-center">Fecha de Inicio</th>
                  <th class="text-center">Fecha de Conclusión</th>
                  <th class="text-center">Grado de Priorización</th>
                  <th class="text-center">Estado Proceso</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $indice=1;
              foreach ($pendientes->result() as  $row)
              {
              ?>
                 <tr>
                  <td class="text-center"><?php echo $indice;?></td>
                  <td ><?php echo $row->informe;?></td>
                  <td><?php echo $row->objetivo;?></td>
                  <td><?php echo $row->normativa;?></td>
                  <td class="text-center"><?php echo formatearFecha($row->fechaInicio);?></td>
                  <td class="text-center"><?php echo formatearFecha($row->fechaConclusion);?></td>
                  <td class="text-center"><?php echo $row->gradoPriorizacion;?></td>
                  <td class="text-center"><?php if ($row->estadoEjecucion=='0') {
                    echo 'Programado';
                  };?></td>
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
