<!-- Libs JS -->
<script src="../public/build/js/jquery.min.js"></script>
<script src="../public/build/js/bootstrap.bundle.js"></script>
<script src="../public/build/js/jquery.slimscroll.min.js"></script>
<script src="../public/build/js/feather.min.js"></script>
<script src="../public/build/js/prism-core.min.js"></script>
<script src="../public/build/js/prism-markup.min.js"></script>
<script src="../public/build/js/prism-line-numbers.min.js"></script>
<script src="../public/build/js/apexcharts.min.js"></script>
<script src="../public/build/js/dropzone.min.js"></script>
<!-- clipboard -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
<!-- Theme JS -->
<!-- build:js ./assets/js/theme.min.js -->
<script src="../public/build/js/main.js"></script>
<script src="../public/build/js/feather.js"></script>
<script src="../public/build/js/copyButton.js"></script>
<script src="../public/build/js/sidebarMenu.js"></script>
<script src="../public/build/js/app.js"></script>
<!-- endbuild -->
<script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js" defer>
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table_id').DataTable({
      "order": [
        [2, "desc"]
      ],
      "paging": false,
      "info": false,
      "language": {
        search: 'Buscar: ',
        emptyTable: "No hay registro de pólizas"
      },
      "columnDefs": [{
        "orderable": false,
        "targets": [0, -1],
      }],
    });
  });
</script>
</body>

</html>