
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
     
    function viewProfile(Email){
        
        var data = {"Email" : Email};

        jQuery.ajax({
          url : '/find-my-mechanic/carOwner/TemplateFile/indexViewProfileModal.php',
          method : "post",
          data : data,
          success : function(data){
            jQuery('body').append(data);
            jQuery('#viewProfile').modal('toggle');
          },
          error : function(){
            alert("Something went wrong!");
          }
          
        });

      }




    </script>
     
</body>

</html>