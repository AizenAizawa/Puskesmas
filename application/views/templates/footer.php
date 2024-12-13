</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/js/') ?>bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/js/') ?>jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/js/') ?>dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/js/') ?>dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/js/') ?>responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/js/') ?>dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/js/') ?>buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/js/') ?>jszip.min.js"></script>
<script src="<?= base_url('assets/js/') ?>pdfmake.min.js"></script>
<script src="<?= base_url('assets/js/') ?>vfs_fonts.js"></script>
<script src="<?= base_url('assets/js/') ?>buttons.html5.min.js"></script>
<script src="<?= base_url('assets/js/') ?>buttons.print.min.js"></script>
<script src="<?= base_url('assets/js/') ?>buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/js/') ?>Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/js/') ?>sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/js/') ?>jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/js/') ?>jquery.vmap.indonesia.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/js/') ?>jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/js/') ?>moment.min.js"></script>
<script src="<?= base_url('assets/js/') ?>daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/js/') ?>tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/js/') ?>summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/js/') ?>jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/js/') ?>adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/js/') ?>demo.js"></script>
<!-- Page specific script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>var base_url = '<?= base_url(); ?>'</script>
<?php if (isset($js)) { ?>
    <script src="<?php echo base_url('app/' . $js . '.js'); ?>"></script>
<?php } ?>

</body>

</html>