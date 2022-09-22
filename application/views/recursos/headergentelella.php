<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Miniatura de la pestaña -->
	  <link href="<?php echo base_url()?>uploads/LOGOTIPO.png" rel="icon" type="image/png"/>
    <title>Sistema de Auditoría Interna</title>

    <link href="<?php echo base_url(); ?>/bootstrap/css/validar.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>gentelella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>gentelella/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<!-- Datatables -->
    
    <link href="<?php echo base_url(); ?>gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>gentelella/build/css/custom.min.css" rel="stylesheet">

      <!-- para las validaciones -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/validar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/login.css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>

    <script>
            
            $(function(){
                // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
                $("#adicional").on('click', function(){
                    $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
                });
             
                // Evento que selecciona la fila y la elimina 
                $(document).on("click",".eliminar",function(){
                    var parent = $(this).parents().get(0);
                    $(parent).remove();
                });
            });
    </script>
    
  </head>

  <body class="nav-md">
    <div class="container body">