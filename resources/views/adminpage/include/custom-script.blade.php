<!-- jQuery -->
<script src="{{asset('adminpage/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminpage/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminpage/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminpage/dist/js/demo.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function convertPriceToNumber(num){
        return parseInt(num.toString().split(".").join(""));
    }
    function convertNumberToPrice(num){
        num = num.toString().split(".").join("");
        return num.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    }
</script>
