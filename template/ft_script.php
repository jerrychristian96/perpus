    <div class="az-footer ht-40">
      <div class="container ht-100p pd-t-0-f">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">FULL TIME TRAINING INDONESIA</span>
        <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span> -->
      </div><!-- container -->
    </div><!-- az-footer -->
    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>
    <script src="../lib/jquery.flot/jquery.flot.js"></script>
    <script src="../js/dashboard.sampledata.js"></script>
    <script src="../js/jquery.cookie.js" type="text/javascript"></script>

<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.2/css/buttons.dataTables.min.css">

<!-- DataTables Buttons JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.2/js/buttons.html5.min.js"></script>


<script>
    $(document).ready( function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'print'
            ]
        });
    });
</script>

<!-- <script> $(document).ready(function(){ var table = $('#table-product').DataTable({ pageLength: 25, processing: true, serverSide: true, dom: '<"html5buttons">Bfrtip', language: { buttons: { colvis : 'show / hide', // label button show / hide colvisRestore: "Reset Kolom" //lael untuk reset kolom ke default } }, buttons : [ {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] }, {extend:'csv'}, {extend: 'pdf', title:'Contoh File PDF Datatables'}, {extend: 'excel', title: 'Contoh File Excel Datatables'}, {extend:'print',title: 'Contoh Print Datatables'}, ], ajax: "{{ route ('api.product') }}", columns: [ {"data":"name"}, {"data":"satuan"}, {"data":"buy_price"}, {"data":"sell_price"}, ], }); }); </script> -->