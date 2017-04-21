<!-- Modal -->
<div class="modal fade" id="edit_service<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Vehicle Details</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="vehivle_name">Vehicle Name:</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="vehivle_name" value="<?php echo $value->ModelName; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="type">Type:</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="type" id="service_name" value="<?php echo $value->VehicleType; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="reg_no">Reg NO. :</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="RegNo" id="reg_no<?php echo $i ?>" onkeyup="RegNoCheck('reg_no<?php echo $i; ?>','ErrorMessage<?php echo $i ?>')" value="<?php echo $value->VehicleRegNo;
                         //$_SESSION['VehicleRegNo'] = $value->VehicleRegNo;
                       ?>">
                       <span id="ErrorMessage<?php echo $i ?>"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="reg_date">Reg Date :</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="RegDate" id="popupDatepicker" value="<?php echo $value->RegistrationDate; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="insoNo">Insurance NO. :</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="InsuranceNo" id="insoNo" value="<?php echo $value->InsuranceNumber; ?>">
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="hiddenRegNo" id="insoNo" value="<?php echo $value->VehicleRegNo; ?>">

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" name="update" class="btn btn-primary" value="Submit"></input>
                    </div>
                  </div>
            </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><!-- End Modal --> 