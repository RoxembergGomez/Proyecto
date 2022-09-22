<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >ACTIVIDADES ELIMINADAS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
              <div class="row float-left">
                <?php echo form_open_multipart('controller_actividades/index');?>
                    <button type="submit" class="btn btn-success"><i class="fa fa-list-ol"></i>  Lista de Actividades Activas</button>
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
              <th class="text-center">Acción</th>
          </tr>
       </thead>
      <tbody>

    <?php
    $indice=1;
    foreach ($plananualtrabajo->result() as  $row)
    {
    ?>
      <tr>
          <td><?php echo $indice;?></td>
          <td><?php echo $row->informe;?></td>
          <td><?php echo $row->objetivo;?></td>
          <td><?php echo $row->normativa;?></td>
          <td><?php echo formatearFecha($row->fechaInicio);?></td>
          <td><?php echo formatearFecha($row->fechaConclusion);?></td>
          <td><?php echo $row->gradoPriorizacion;?></td>
          <td>
            <?php echo form_open_multipart('controller_actividades/recuperarbd');?>
              <input type="hidden" name="idPlan" value="<?php echo $row->idPlanAnualTrabajo;?>" >
              <button type="submit" name="botton" value="recuperar" class="btn btn-warning"><i class="fa fa-database"></i> Recuperar</button>
            <?php echo form_close(); ?>
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