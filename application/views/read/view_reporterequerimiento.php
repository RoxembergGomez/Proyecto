<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
        <h5 style="font-weight: bold; color: #000000; " >REPORTE REQUERIMIENTO POR UNIDAD DE NEGOCIO</h5> 
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">

          <input type="hidden" name="idunidad" value="<?php echo $_POST['idunidad'];?>">
          <input type="hidden" name="idmpa" value="<?php echo $_POST['idmpa'];?>">

            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    <th class="text-center">Nro.</th>
                    <th class="text-center">Detalle de Requerimiento</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $indice=1;
              foreach ($reportereq->result() as  $row)
              {?>
                  <tr>
                    <td class="text-center" ><?php echo $indice;?></td>
                    <td><?php echo $row->requerimientoInformacion;?></td>
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