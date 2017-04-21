          <div id="outbox" class="tab-pane fade">
       <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($i=0;$i<sizeof($outboxMessageData);$i++){
                ?>
              <tr>
                <td><?php echo $outboxMessageData[$i]->name; ?></td>
                <td><?php echo $outboxMessageData[$i]->Date; ?></td>
                <td>
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#outboxMessage<?php echo $i; ?>">Open</button>   
          <!-- Modal -->
                  <div class="modal fade" id="outboxMessage<?php echo $i; ?>" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Message Details</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="receiverName">To:</label>
                                    <div class="col-sm-10">
                                      <span><?php echo $outboxMessageData[$i]->name; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="message">Message: </label>
                                    <div class="col-sm-10">          
                                       <span><?php echo $outboxMessageData[$i]->MessageBody; ?></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
        </td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
    </div>