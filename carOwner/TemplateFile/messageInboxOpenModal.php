<div id="inbox" class="tab-pane fade in active">
       <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Action</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($i=0;$i<sizeof($inboxMessageData);$i++){
                ?>
              <tr>
                <td><?php echo $inboxMessageData[$i]->name; ?></td>
                <td><?php echo $inboxMessageData[$i]->Date; ?></td>
                <td>
                  <button type="button" onclick="statusChange('status<?php echo $i; ?>','<?php echo $inboxMessageData[$i]->SenderMail ?>')" class="btn btn-info" data-toggle="modal" data-target="#open<?php echo $i ?>">Open</button>            
            <!-- Modal -->
                  <div class="modal fade" id="open<?php echo $i ?>" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Message Details</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action="" method="POST">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="sendeName">Sender:</label>
                                    <div class="col-sm-10">
                                      <span><?php echo $inboxMessageData[$i]->name ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Email:</label>
                                    <div class="col-sm-10">
                                      <span><?php echo $inboxMessageData[$i]->SenderMail ?></span>
                                    </div>
                                </div>
                                <input type="hidden" name="SenderMail" value="<?php echo $inboxMessageData[$i]->SenderMail ?>">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="message">Message: </label>
                                    <div class="col-sm-10">          
                                       <span><?php echo $inboxMessageData[$i]->MessageBody ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="reply">Reply: </label>
                                    <div class="col-sm-10">          
                                        <textarea class="form-control" rows="5" id="reply" name="reply"></textarea>
                                    </div>
                                </div>
                                 <button type="submit" name="send" class="btn btn-primary margin-left">Send</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
            </td>
                <td id="status<?php echo $i; ?>"><?php if($inboxMessageData[$i]->Status == "unread") echo "Unread"; ?></td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
    </div>