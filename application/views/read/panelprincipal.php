<style type="text/css">
  table th{
    border: 1px solid black;
    font-size:15px;
    font-weight: bold;
    color: #000000;
  }

  table td{
    border: 1px solid black;
    font-size:15px;
   }

   #reporte:hover {
    background-color: #C7D8D9;
   }



</style>



<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_content">
      <div class="row">

      <!-- REPORTES DE PLAN ANUAL DE TRABAJO-->
      <div class="col-xl-4 col-md-8 mb-4">
          <div  style="border: 1px solid black; background: #E6F2F3; ">
              <div class="card-header bg-dark font-weight-bold text-light text-center">
                  <h4>PLAN ANUAL DE TRABAJO</h4>
              </div>
              <div class="card-body">
                <div class="h2 mb-0 font-weight-bold">
                  <table style=" width:100%">
                    <thead>
                      <tr>
                        <th class="text-center">DETALLE </th>
                        <th class="text-center">CANTIDAD</th>
                        <th class="text-center">REPORTES</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td id="titulo">PENDIENTES</td>
                        <td class="text-center"><?php echo $this->PlanAnualTrabajo_Model->actividadespendientes(); ?></td>
                        <td class="text-center">
                           <div class="btn-group" role="group" style=" padding: 3px; ">
                              <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="<?php echo base_url()."index.php/controller_actividades/pendientes";?>" id="reporte"><i class="fa fa-desktop"></i>  Sistema</a>
                                <a class="dropdown-item" href="<?php echo base_url()."index.php/controller_actividades/pendientespdf";?>" id="reporte" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a> 
                              </div>
                            </div>
                        </td>

                      </tr>
                      <tr>
                        <td> EN PROCESO</td>
                        <td class="text-center"><?php echo $this->PlanAnualTrabajo_Model->actividadesenproceso(); ?></td>
                        <td class="text-center">
                           <div class="btn-group" role="group" style=" padding: 3px; ">
                              <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>                               
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="<?php echo base_url()."index.php/controller_memorandumplanificacion/index";?>" id="reporte"><i class="fa fa-desktop"></i>  Sistema</a>
                                <a class="dropdown-item" href="<?php echo base_url()."index.php/controller_memorandumplanificacion/enprocesopdf";?>" id="reporte" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>  
                              </div>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td> EJECUTADAS</td>
                        <td class="text-center"><?php echo $this->PlanAnualTrabajo_Model->actividadescerradas(); ?></td>
                        <td class="text-center">
                           <div class="btn-group" role="group" style=" padding: 3px; ">
                              <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>                               
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="<?php echo base_url()."index.php/controller_actividades/ejecutadas";?>" id="reporte"><i class="fa fa-desktop"></i>  Sistema</a>
                                <a class="dropdown-item" href="<?php echo base_url()."index.php/controller_actividades/ejecutadaspdf";?>" id="reporte" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>  
                              </div>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td id="titulo" >AVANCE EN %</td>
                        <td colspan="2" class="text-center" ><?php echo round(($this->PlanAnualTrabajo_Model->actividadescerradas()/($this->PlanAnualTrabajo_Model->actividadespendientes()+$this->PlanAnualTrabajo_Model->actividadesenproceso()+$this->PlanAnualTrabajo_Model->actividadescerradas())*100),0).'%'; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
      </div>

<!-- REPORTES POR EMPLEADO-->
      <div class="col-xl-4 col-md-8 mb-4">
          <div  style="border: 1px solid black; background: #E6F2F3; ">
              <div class="card-header bg-dark font-weight-bold text-light text-center">
                  <h4>ACTIVIDADES EN PROCESO POR EMPLEADO </h4>
              </div>
              <div class="btn-group float-right" role="group" style=" padding: 3px; ">
                  <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i>   Reportes</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                      <a class="dropdown-item" href="<?php echo base_url()."index.php/controller_actividades/ejecutadasporempleado";?>" id="reporte"><i class="fa fa-desktop"></i> Sistema</a>
                      <a class="dropdown-item" href="<?php echo base_url()."index.php/controller_actividades/porempleadopdf";?>" id="reporte" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>  
                    </div>
                </div>
              <div class="card-body">
                <div class="h2 mb-0 font-weight-bold">
                  <table style=" width:100%">
                    <thead>
                      <tr>
                        <th class="text-center">NOMBRE(S) Y APELLIDO(S) </th>
                        <th class="text-center">CANTIDAD</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
              $indice=1;
              foreach ($proceso->result() as  $row)
              {
              ?>
                 <tr>
                  <td ><?php echo ucwords($row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido);?></td>
                  <td class="text-center"><?php echo $row->cantidad;?></td>
                
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
      
    <!-- PENDIENTES DE RESPUESTAS-->
      <div class="col-xl-4 col-md-8 mb-4">
          <div  style="border: 1px solid black; background: #E6F2F3; ">
              <div class="card-header bg-dark font-weight-bold text-light text-center">
                  <h4>PROGRAMAS DE TRABAJO</h4>
              </div>
              <div class="card-body">
                <div class="h2 mb-0 font-weight-bold">
                  <table style=" width:100%">
                    <thead>
                      <tr>
                        <th class="text-center">DETALLE </th>
                        <th class="text-center">CANTIDAD</th>
                        <th class="text-center">REPORTE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td id="titulo" > PARA REVISIÓN</td>
                        <td class="text-center"><?php echo $this->Programas_Model->programasrevision(); ?></td>
                        <td class="text-center" rowspan="2">
                          <?php echo form_open_multipart('controller_programas/index');
                            ?>
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-desktop"></i></button>
                          <?php         
                          echo form_close();?>
                        </td>

                      </tr>
                      <tr>
                        <td> APROBADO</td>
                        <td class="text-center"><?php echo $this->Programas_Model->programasaprobados(); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
      </div>
      </div>
      <div class="row">
        <div class="col-xl-4 col-md-8 mb-4">
          <div  style="border: 1px solid black; background: #E6F2F3; ">
              <div class="card-header bg-dark font-weight-bold text-light text-center">
                  <h4>HALLAZGOS</h4>
              </div>
              <div class="card-body">
                <div class="h2 mb-0 font-weight-bold">
                  <table style=" width:100%">
                    <thead>
                      <tr>
                        <th class="text-center">DETALLE </th>
                        <th class="text-center">CANTIDAD</th>
                        <th class="text-center">REPORTE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td id="titulo">PARA REVISIÓN</td>
                        <td class="text-center"><?php echo $this->Observaciones_Model->hallazgosrevision(); ?></td>
                        <td class="text-center">
                           <?php echo form_open_multipart('controller_hallazgos/enrevision');
                            ?>
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-desktop"></i></button>
                          <?php         
                          echo form_close();?>
                        </td>

                      </tr>
                      <tr>
                        <td> ENVIADOS</td>
                        <td class="text-center"><?php echo $this->Observaciones_Model->hallazgosenviados(); ?></td>
                        <td class="text-center">
                           <?php echo form_open_multipart('controller_hallazgos/enviado');
                            ?>
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-desktop"></i></button>
                          <?php         
                          echo form_close();?>
                            </div>
                        </td>
                      </tr>
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

  </div>
</div>