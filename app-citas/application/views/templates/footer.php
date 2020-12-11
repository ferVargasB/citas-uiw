  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong>Sistema de citas &copy; 2020 <a href="">UIW Bajío</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url().'assets/';?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url().'assets/';?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/';?>dist/js/adminlte.min.js"></script>

<!-- Plugin sweetalert-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Datatables scripts  -->
<?php if ( isset($jquery_data) && isset($bootstrap_data) && isset($data_responsive) && isset($data_responsive4) ) { ?>
  <script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js';?>"></script>
  <script src="<?php echo base_url().'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';?>"></script>
  <script src="<?php echo base_url().'assets/plugins/datatables-responsive/js/dataTables.responsive.min.js';?>"></script>
  <script src="<?php echo base_url().'assets/plugins/datatables-responsive/js/dataTables.responsive.min.js';?>"></script>


  <script>
    $(function () {
      $('#example1').DataTable({
        language: {
          search: 'Buscar registros:',
          zeroRecords:'No hay registros',
          emptyTable: 'No hay registros',
          info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
          paginate: {
            first:      "Primero",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Ultimo"
          }
        
        },
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

<?php } ?>

<script src="<?php echo base_url().'assets/';?>js/form-cita.js"></script>
</body>
</html>
