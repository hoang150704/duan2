<!-- jQuery -->
<script src="<?= BASE_URL ?>assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= BASE_URL ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= BASE_URL ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/jszip/jszip.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= BASE_URL ?>assets/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= BASE_URL ?>assets/admin/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
document.getElementById('togglePasswordBtn').addEventListener('click', function() {
    var passwordElement = document.querySelector('.password_user');
    var buttonText = document.getElementById('togglePasswordBtn');

    if (passwordElement.textContent === '********') {
        // Hiển thị mật khẩu
        passwordElement.textContent = '<?=$user['password']?>';
        buttonText.textContent = 'Ẩn mật khẩu';
    } else {
        // Ẩn mật khẩu
        passwordElement.textContent = '********';
        buttonText.textContent = 'Hiện mật khẩu';
    }
});
</script>
<!-- ./wrapper -->


<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>