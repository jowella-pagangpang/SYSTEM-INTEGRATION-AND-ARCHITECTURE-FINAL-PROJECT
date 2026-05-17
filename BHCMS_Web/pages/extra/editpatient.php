<div class="modal fade" id="edit-patient<?php echo $data['deworming1_id']; ?>" style="font-family: Helvetica;">

    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold">Edit Patient Record</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="container-fluid">
            <form method="post" action="edit.php">            
              <div class="row">

              <div>
                <input type="hidden" name="deworming1_id" value="<?php echo $data['deworming1_id']; ?>">
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Date of Registration:</label>
                  <input name="reg_date" class="form-control form-control-sm" type="date"
                    value="<?php echo $data['reg_date']; ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="inputaddress">Complete Address:<br></label>
                  <select name="purok" class="form-control form-control-sm" id="inputaddress" style="width: 100%">
                    <option selected>
                      <?php echo $data['purok']; ?>
                    </option>
                    <option value="Purok 93">Purok 93</option>
                    <option value="Purok 94">Purok 94</option>
                    <option value="Purok 95">Purok 95</option>
                    <option value="Purok 96">Purok 96</option>
                    <option value="Purok 97">Purok 97</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label><br></label>
                  <input name="address" class="form-control form-control-sm" type="text"
                    value="<?php echo $data['address']; ?>" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date of Birth:</label>
                  <input name="birth_date" class="form-control form-control-sm" type="date"
                    value="<?php echo $data['birth_date']; ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Age:<br></label>
                  <select name="age" class="form-control form-control-sm" style="width: 100%;" required>
                    <option selected>
                      <?php echo $data['age']; ?>
                    </option>
                    <option value="1 y/o">1 y/o</option>
                    <option value="2 y/o">2 y/o</option>
                    <option value="3 y/o">3 y/o</option>
                    <option value="4 y/o">4 y/o</option>
                  </select>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-2">
                <label>Name of Child:</label>
                <input name="fname" type="text" class="form-control form-control-sm"
                  value="<?php echo $data['fname']; ?>">
              </div>
              <div class="col-2">
                <label><br></label>
                <input name="minitial" type="text" class="form-control form-control-sm"
                  value="<?php echo $data['minitial']; ?>">
              </div>
              <div class="col-2">
                <label><br></label>
                <input name="lname" type="text" class="form-control form-control-sm"
                  value="<?php echo $data['lname']; ?>">
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>1st Dose (date given):</label>
                  <input name="1stdose" class="form-control form-control-sm" type="date"
                    value="<?php echo $data['1stdose']; ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Sex:<br></label>
                  <select name="sex" class="form-control form-control-sm" style="width: 100%;">
                    <option selected>
                      <?php echo $data['sex']; ?>
                    </option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>2nd Dose (date given):</label>
                  <input name="2nddose" class="form-control form-control-sm" type="date"
                    value="<?php echo $data['2nddose']; ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Complete Name of Mother:</label>
                  <input name="mother_name" class="form-control form-control-sm" type="text"
                    value="<?php echo $data['mother_name']; ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Remarks</label>
                  <textarea name="remarks" class="form-control form-control-sm"
                    rows="1"><?php echo $data['remarks']; ?></textarea>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="update" class="btn btn-primary toastrDefaultSuccess">Edit patient</button>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
  <!-- /.form -->
</div>
<!-- /.modal -->