

                          <table id="example1" class="table table-bordered table-hover text-center" width="100%">
                            <thead>
                              <tr>
                              <th colspan="3">Vitamin A</th>
                              <th colspan="2">Iron</th>
                              <th colspan="2">MNP</th>
                              <th>Deworming</th>
                              <th rowspan="3">Remarks</th>
                              <th rowspan="3"></th>
                            </tr>
                            <tr>
                              <th rowspan="2">6-11 mos.</th>
                              <th colspan="2">12-59 mos.</th>
                              <th rowspan="2">6-11 mos.</th>
                              <th rowspan="2">12-59 mos.</th>
                              <th rowspan="2">6-11 mos.</th>
                              <th rowspan="2">12-59 mos.</th>
                              <th rowspan="2">12-59 mos.</th>
                            </tr>
                            <tr>
                              <th>Dose 1</th>
                              <th>Dose 2</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($data = mysqli_fetch_array($nutrition2)) { ?>
    <tr>
        <?php if (($data['6to11mos'])) { ?>
            <td>
                <?php if ($data['vitamin'] != '00-00-0000') {
                    echo $data['vitamin'];
                } ?>
            </td>
            <td>
                <?php if ($data['irondose1'] != '00-00-0000') {
                    echo $data['irondose1'];
                } ?>
            </td>
            <td>
                <?php if ($data['mnpdose1'] != '00-00-0000') {
                    echo $data['mnpdose1'];
                } ?>
            </td>
        <?php } else { ?>
            <td></td>
            <td></td>
            <td></td>
        <?php } ?>

        <?php if (($data['12to59mos'])) { ?>
            <td>
                <?php if ($data['vitamindose1'] != '00-00-0000') {
                    echo $data['vitamindose1'];
                } ?>
            </td>
            <td>
                <?php if ($data['vitamindose2'] != '00-00-0000') {
                    echo $data['vitamindose2'];
                } ?>
            </td>
            <td>
                <?php if ($data['irondose2'] != '00-00-0000') {
                    echo $data['irondose2'];
                } ?>
            </td>
            <td>
                <?php if ($data['mnpdose2'] != '00-00-0000') {
                    echo $data['mnpdose2'];
                } ?>
            </td>
            <td>
                <?php if ($data['dewormings'] != '00-00-0000') {
                    echo $data['dewormings'];
                } ?>
            </td>
        <?php } else { ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        <?php } ?>

        <td>
            <?php echo nl2br($data['remarks']); ?>
        </td>
        <td>
            <a href="nutrition2-update1.php?id=<?php echo $data['nutrition2_id']; ?>">
                <button type="button" class="btn btn-success btn-xs" data-placement="top" title="Edit">
                    <i class="nav-icon fas fa-user-edit" aria-hidden="true"></i>
                </button>
            </a>
        </td>
    </tr>
<?php } ?>
    </tbody>
  </table>          
