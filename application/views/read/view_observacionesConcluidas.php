<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    
    <div class="x_title text-center">
      <div class="row float-left " >
      <?php 
        echo form_open_multipart('controller_hallazgos/concluidos');?>
          <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Retroceder"><i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 >HALLAZGOS</h5> 
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
                    <th class="text-center">Comentario del Responsable y Acción Correctiva </th>
                    <th class="text-center">Plazo Propuesto</th>
                    <th class="text-center">Responsable</th> 
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($observaciones->result() as  $row)
              {
                if ($this->session->userdata('tipo') == 'jefe' || $this->session->userdata('tipo') == 'ejecutor')
                  {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td><?php echo $row->descripcionHallazgo;?></td>
                    <td class="text-center"><?php echo $row->prioridadAtencion;?></td>
                    <td>
                      <?php if($row->comentarioResponsable==''){
                          ?> <p style="font-weight: bold; color: red; " >Sin Comentario del Responsable</p> <?php
                      } else{
                        echo $row->comentarioResponsable;
                      } ?>
                    </td>
                    <td class="text-center">
                      <?php if($row->plazoAccionCorrectiva=='0000-00-00'){
                          ?> <p style="font-weight: bold; color: red; " >Sin Fecha</p> <?php
                      } else{
                        echo $row->plazoAccionCorrectiva;
                      } ?>
                    </td>
                    <td>
                      <?php if($row->responsable==''){
                          ?> <p style="font-weight: bold; color: red; " >Sin Responsable</p> <?php
                      } else{
                        echo $row->responsable;
                      } ?>
                    </td>  
                  </tr> 
                    <?php
                  }
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
