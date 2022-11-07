<div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo base_url()."index.php/controller_panelprincipal/index";?>" class="site_title"><i class="fa fa-check-square"></i>   <span>      SAIB-RISK</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3 style="font-size: 18px">MÓDULOS</h3>
              <ul class="nav side-menu">
              <?php if ($this->session->userdata('tipo')=='jefe') {?>
                <li><a><i class="fa fa-users"></i>Gestión de Usuarios<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('controller_usuarios/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Usuarios</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-male"></i>Gestión de Empleados<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('controller_empleados/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Empleados</button>
                      <?php echo form_close();?>
                    </li>
                    <li>
                      <?php echo form_open_multipart('controller_cargos/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Cargos</button>
                      <?php echo form_close();?>
                    </li>
                     <li>
                      <?php echo form_open_multipart('controller_unidadnegocio/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Unidades de Negocio</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
              <?php }
              if ($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor') {?>
                <li><a><i class="fa fa-list"></i>Planificación<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('controller_actividades/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Actividades</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-list"></i>Ejecución<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('controller_memorandumplanificacion/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >MPA</button>
                      <?php echo form_close();?>
                    </li>
                    <li>
                      <?php echo form_open_multipart('controller_programas/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Programas de Trabajo</button>
                      <?php echo form_close();?>
                    </li>
                    <li>
                      <?php echo form_open_multipart('controller_requerimientoinformacion/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Requerimiento</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
              <?php }?>
                <li><a><i class="fa fa-file-text"></i>Hallazgos<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <?php if ($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor') {?>
                    <li>
                      <?php echo form_open_multipart('controller_hallazgos/pendiente');?>
                        <button  type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;">En Proceso</button>
                      <?php echo form_close();?>
                    </li>
                    <?php } 
                      if ($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor') {
                      ?>
                    <li>
                      <?php echo form_open_multipart('controller_hallazgos/enrevision');?>
                        <button  type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;">En Revisión</button>
                      <?php echo form_close();?>
                    </li>
                    <?php }
                     if ($this->session->userdata('tipo')=='auditado') {?>
                    <li>
                      <?php echo form_open_multipart('controller_hallazgos/enviado');?>
                        <button  type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;">Pendientes de Descargos</button>
                      <?php echo form_close();?>
                    </li>
                    <?php } 
                     if ($this->session->userdata('tipo')=='ejecutor' || $this->session->userdata('tipo')=='jefe') {?>
                      <li>
                      <?php echo form_open_multipart('controller_hallazgos/enviadosdescargosuai');?>
                        <button  type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;">Enviados a Descargos</button>
                      <?php echo form_close();?>
                    </li>
                    <li>
                      <?php echo form_open_multipart('controller_hallazgos/concluidos');?>
                        <button  type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;">Concluidos</button>
                      <?php echo form_close();?>
                    </li>
                  <?php } ?>
                  </ul>
                </li>
            </div>
        </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">