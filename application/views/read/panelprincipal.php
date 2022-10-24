<style type="text/css">
  table th{
    border: 1px solid black;
    font-size:18px;
    font-weight: bold;
    color: #000000;
  }

  table td{
    border: 1px solid black;
    font-size:18px;
   }



</style>



<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >REPORTES GENERALES</h5> 
    </div>

    <div class="x_content">
      <div class="col-xl-4 col-md-8 mb-4">
          <div  style="border: 1px solid black; background: #E6F2F3; ">
              <div class="card-header bg-dark font-weight-bold text-light text-center">
                  <h2>PLAN ANUAL DE TRABAJO</h2>
              </div>
              <div class="card-body">
                <div class="h2 mb-0 font-weight-bold">
                  <table style=" width:100%">
                    <thead>
                      <tr>
                        <th class="text-center">Detalle </th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Reporte</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td id="titulo">Pendientes</td>
                        <td class="text-center"><?php echo $this->PlanAnualTrabajo_Model->actividadespendientes(); ?></td>
                        <td class="text-center">
                           <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <?php echo form_open_multipart('controller_actividades/pendientes');?>        
                                <button type="submit" class="dropdown-item" ><i class="fa fa-list"></i>  Sistema</button>
                                <?php echo form_close();?>
                                <?php echo form_open_multipart('controller_actividades/pendientesPDF');?>        
                                <button type="submit" class="dropdown-item"><i class="fa fa-file-pdf-o"></i>  PDF</button>
                                <?php echo form_close();?>  
                              </div>
                            </div>
                        </td>

                      </tr>
                      <tr>
                        <td> Ejecutadas</td>
                        <td class="text-center"><?php echo $this->PlanAnualTrabajo_Model->actividadescerradas(); ?></td>
                        <td class="text-center">
                           <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <?php echo form_open_multipart('controller_actividades/ejecutadas');?>        
                                <button type="submit" class="dropdown-item" ><i class="fa fa-list"></i>  Sistema</button>
                                <?php echo form_close();?>
                                <?php echo form_open_multipart('controller_actividades/ejecutadasPDF');?>        
                                <button type="submit" class="dropdown-item"><i class="fa fa-file-pdf-o"></i>  PDF</button>
                                <?php echo form_close();?>  
                              </div>
                            </div>
                        </td>
                        
                      </tr>
                      <tr>
                        <td id="titulo" >Avance</td>
                        <td colspan="2" class="text-center" ><?php echo round((($this->PlanAnualTrabajo_Model->actividadescerradas()/$this->PlanAnualTrabajo_Model->actividadespendientes())*100),0).'%'; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
      </div>
    
      <?php if ($this->session->userdata('tipo')=='jefe') { ?>
        <div class="col-xl-3 col-md-6 mb-4  ">
          <div class="card   border-dark bg-dark shadow h-100" style="border-radius: 10px ">
                  <?php
                  echo form_open_multipart('cliente/index');
                  ?>
               <button type="submit" class="btn btn-danger btn-block" style="border-radius: 20px ">

              <div class="card-header bg-dark font-weight-bold text-light">
                  <h2>ACTIVIDADES PENDIENTES</h2>
              </div>
                  <div class="card-body">

                    <div class="h2 mb-0 font-weight-bold">
                        <!-- <h3 class="fa fa-users text-info"> Anulada: <?php //echo $this->reporte_model->cantidadventascanseladas(); ?></h3> -->
                    </div>
                    </div>
                    </button><?php
                        echo form_close();
                        ?>
              </div>
        </div>
      <?php } ?>
      
    </div>
  </div>
</div>

  </div>
</div>
