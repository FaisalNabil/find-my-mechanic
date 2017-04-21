<?php 
  
  require_once '../phpFiles/SelectProfileData.php';

  $Email = $_POST['Email'];

  $jsonShopOwnerDataString = getJSONFromDB("select ShopName,Address from shopowner where Email='$Email'");
  //echo $jsonShopOwnerDataString;
  $ShopOwnerData = json_decode($jsonShopOwnerDataString);

  $jsonShopOwnerServiceRelationString = getJSONFromDB("select ServicesId from shopservicerelation where ShopEmail='$Email'");

  $ShopServiceRelation = json_decode($jsonShopOwnerServiceRelationString);
  

  $jsonAvailableServiceString = getJSONFromDB("select ServiceName,Cost from availableservices where ServicesId='".$ShopServiceRelation[0]->ServicesId."'");

  $AvailableServiceData = json_decode($jsonAvailableServiceString);

// shopstockrelation table

  $jsonShopStockRelationString = getJSONFromDB("select StockId from shopstockrelation where ShopEmail='$Email'");

  $AvailableStockId = json_decode($jsonShopStockRelationString);

 /*for($i = 0; $i<sizeof($AvailableStockId); $i++){
    $jsonStockString = getJSONFromDB("select PartsName,PricePerUnit,TotalUnit from stock where StockId='".$AvailableStockId[$i]->StockId."'");

  $AvailableStock = json_decode($jsonStockString);
 }*/

?>


<?php  ob_start(); ?>



<div class="modal fade" id="viewProfile" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" onclick="closemodal()">&times;</button>
          <h4 class="modal-title">Shop Profile</h4>
          <?php //echo $jsonStockString; ?>
        </div>
        <div class="modal-body">
           <form class="form-horizontal">
            <div class="form-group">
              <label class="control-label col-sm-2" for="name">Name:</label>
              <div class="col-sm-10">
                  <label for="shopName"><?php echo $ShopOwnerData[0]->ShopName ; ?></label>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="address">Address:</label>
              <div class="col-sm-10">          
                  <label for="address"><?php echo $ShopOwnerData[0]->Address ; ?></label>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="services">Services:</label>
              <div class="col-sm-10">          
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Service Available</th>
                            <th>Service Cost</th>                         
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 0; 
                            foreach ($AvailableServiceData as $service) {
                                 $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $service->ServiceName ; ?></td>
                                <td><?php echo $service->Cost ; ?></td>
                            </tr>
                        <?php 
                            }
                        ?>
                           
                           
                        </tbody>
                    </table>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="services">Parts:</label>
              <div class="col-sm-10">          
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Available Parts</th>                         
                            <th>Price</th>                         
                            <th>TotalUnit</th>                         
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                         for($j = 0; $j<sizeof($AvailableStockId); $j++){
                              $jsonStockString = getJSONFromDB("select PartsName,PricePerUnit,TotalUnit from stock where StockId='".$AvailableStockId[$j]->StockId."'");

                            $AvailableStock = json_decode($jsonStockString);
                             
                               for($i = 0; $i<sizeof($AvailableStock); $i++){
                         ?>
                         <tr>
                            <td><?php echo ($j+1); ?></td>
                            <td><?php echo $AvailableStock[$i]->PartsName; ?></td>
                            <td><?php echo $AvailableStock[$i]->PricePerUnit; ?></td>
                            <td><?php echo $AvailableStock[$i]->TotalUnit; ?></td>
                         </tr>
                        <?php } } ?>

                        </tbody>
                    </table>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="closemodal()">Close</button>
      </div>
    </div>  
  </div>
</div>

<script>
  function closemodal(){
     jQuery('#viewProfile').modal('hide');
     setTimeout(function(){
       jQuery('#viewProfile').remove();
       jQuery('.modal-backdrop').remove();
        
     },300);
  }
</script>

<?php echo ob_get_clean(); ?>