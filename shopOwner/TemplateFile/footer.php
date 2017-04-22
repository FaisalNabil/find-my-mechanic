
</div>
    <!-- end wrapper -->

    <script src="../assets/plugins/jquery-1.12.0.min.js"></script>
    <script src="../assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/plugins/jquery.plugin.min.js"></script>
     <script src="../assets/plugins/jquery.datepick.js"></script>
     <script src="../assets/js/custom.js"></script>
    <script>
    $(function() {
        $('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd'});
    });
        $(document).ready(function(){
            $("span").click(function(){
                //$(this).hide();
                //alert("hello");
                $('#myModal').modal('show');
            });
        });

    </script>
     
</body>

</html>