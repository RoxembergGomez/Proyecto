<style type="text/css">

   a h2{
    font-size: 22px;
    font-weight: bold;
   }


</style>



<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_content">
      <div class="row">
        <?php if ($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor') {?>
          <div class="col-xl-3">
            <?php if ($this->session->userdata('tipo')=='jefe') {?>
            <a class="btn btn-primary col-md-12" href="<?php echo base_url()."index.php/controller_memorandumplanificacion/index";?>" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" ><?php echo $this->PlanAnualTrabajo_Model->actividadesenproceso(); ?></h1>
                <h2 class="text-left">Actividades Asignadas</h2>
            </a>
            <?php } ?>
             <?php if ($this->session->userdata('tipo')=='ejecutor') {?>
            <a class="btn btn-info col-md-12" href="<?php echo base_url()."index.php/controller_memorandumplanificacion/index";?>" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" ><?php echo $this->MemorandumPlanificacion_Model->misactividades(); ?></h1>
                <h2 class="text-left">Mis Actividades</h2>
            </a>
            <?php } ?>
          </div>

        <?php } ?>
        <?php if ($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor') {?>
        <div class="col-xl-3">  
            <a class="btn btn-warning col-md-12" href="<?php echo base_url()."index.php/controller_actividades/pendientes";?>" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" ><?php echo $this->PlanAnualTrabajo_Model->actividadespendientes(); ?></h1>
                <h2 class="text-left">Actividades Pendientes</h2>
            </a>
      </div>

      <div class="col-xl-3">  
            <a class="btn btn-success col-md-12" href="<?php echo base_url()."index.php/controller_actividades/ejecutadas";?>" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" ><?php echo $this->PlanAnualTrabajo_Model->actividadescerradas(); ?></h1>
                <h2 class="text-left">Actividades Ejecutadas</h2>
            </a>
      </div>

      <div class="col-xl-3" style=" border-radius:10px;">  
        <?php if ($this->session->userdata('tipo')=='jefe') {?>
            <a class="btn btn-info col-md-12" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" style=" color:white;" ><?php echo round(($this->PlanAnualTrabajo_Model->actividadescerradas()/($this->PlanAnualTrabajo_Model->actividadespendientes()+$this->PlanAnualTrabajo_Model->actividadesenproceso()+$this->PlanAnualTrabajo_Model->actividadescerradas())*100),0).'%'; ?></h1>
                <h2 class="text-left" style=" color:white;">Porcentaje de Avance</h2>
            </a>
             <?php } ?>
            <?php if ($this->session->userdata('tipo')=='ejecutor') {?>
            <a class="btn btn-info col-md-12" href="<?php echo base_url()."index.php/controller_hallazgos/enviadosdescargosuai";?>" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" ><?php echo $this->Observaciones_Model->hallazgosenviados(); ?></h1>
                <h2 class="text-left">Hallazgos en Descargos</h2>
            </a>
            <?php } ?>
      </div>
      </div> <br>
      <?php } ?>

      <?php if ($this->session->userdata('tipo')=='jefe') {?>
      <div class="row">
        <div class="col-xl-3" style=" border-radius:10px;">  
            <a class="btn btn-primary col-md-12" href="<?php echo base_url()."index.php/controller_programas/index";?>" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" ><?php echo $this->Programas_Model->programasrevision(); ?></h1>
                <h2 class="text-left">Programas para Revisión</h2>
            </a>
      </div>

        <div class="col-xl-3">  
            <a class="btn btn-warning col-md-12" href="<?php echo base_url()."index.php/controller_programas/index";?>" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" ><?php echo $this->Programas_Model->programasaprobados(); ?></h1>
                <h2 class="text-left">Programas Aprobados</h2>
            </a>
      </div>
      <div class="col-xl-3">  
            <a class="btn btn-success col-md-12" href="<?php echo base_url()."index.php/controller_hallazgos/enrevision";?>" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" ><?php echo $this->Observaciones_Model->hallazgosrevision(); ?></h1>
                <h2 class="text-left">Hallazgos para Revisión</h2>
            </a>
      </div>
      <?php } ?>
      <?php if ($this->session->userdata('tipo')=='jefe') {?>

      <div class="col-xl-3">  
            <a class="btn btn-info col-md-12" href="<?php echo base_url()."index.php/controller_hallazgos/enviadosdescargosuai";?>" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" ><?php echo $this->Observaciones_Model->hallazgosenviados(); ?></h1>
                <h2 class="text-left">Hallazgos en Descargos</h2>
            </a>
      </div>
      <?php } ?>
      </div>
<br>
     <div class="row">
        <?php if ($this->session->userdata('tipo')=='jefe') {?>
        <div class="col-xl-3" style=" border-radius:10px;">  
            <a class="btn btn-info col-md-12" href="<?php echo base_url()."index.php/controller_memorandumplanificacion/index";?>" id="reporte" style=" border-radius:10px;">
                <h1 class="text-left" ><?php echo $this->MemorandumPlanificacion_Model->misactividades(); ?></h1>
                <h2 class="text-left">Mis Actividades</h2>
            </a>
      </div>
      <?php } ?>
      </div> 
  
  </div>
  </div>
  </div>
</div>
</div>

