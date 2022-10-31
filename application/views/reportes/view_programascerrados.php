<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <div class="row float-left " >
      <?php 
          echo form_open_multipart('controller_programas/programascerrados');?>
            <button class="btn btn-primary float-center" data-toggle="tooltip" data-placement="top" title="Retroceder">
                            <i class="glyphicon glyphicon-arrow-left"></i>
      <?php echo form_close();?>
      </div>
        <h5 style="font-weight: bold; color: #000000; " >DETALLE DE PROGRAMAS DE TRABAJOS</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th> 
                    <th class="text-center">Descripción Actividad</th>
                    <th class="text-center">Respaldo</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($actividades->result() as  $row)
              {?>
                <?php if( $this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor'){?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td ><?php echo $row->actividad;?></td>
                    <td>
                    <?php 
                      $docRespaldo=$row->respaldo;
                      if ($docRespaldo=="Sin Respaldo") 
                      {
                        ?>
                        <p>Sin Respaldo</p>
                    <?php  
                      }
                      else
                      {
                    ?>
                        <a href="<?php echo base_url();?>/uploads/respaldoPrograma/<?php echo $docRespaldo?>" target="_blank"> Respaldo
                          <!--- <img src="<?php echo base_url();?>/uploads/logopdf.png" width="50px">-->
                        </a>
                    <?php  
                      }
                    ?>
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