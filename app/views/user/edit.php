<?php require_once HEADER?>
<?php require_once SIDEBAR?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $this->pageTitle ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= ROOT_LINK . $this->controller?>">Home</a></li>
            <li class="breadcrumb-item active"><?= $this->pageTitle ?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a class="btn btn-info" href="<?= ROOT_LINK . 'user'?>">
                <i class="fas fa-home"></i>
              </a>
            </div>
            <!-- /.card-header -->

            <?php require_once SHOW_USER_MESSAGES?>

            <form  method="POST" class="needs-validation col-lg-6 col-sm-8" novalidate>
              <div class="card-body">

                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="number" class="form-control"
                         placeholder="Phone Number" id="phone" name="phone"
                         value="<?= \MVC\core\helpers::showValue('phone_number', $this->data['storedUserInfo']) ?>">
                </div>

                <div class="form-group" data-select2-id="43">
                  <label>Group</label>
                  <select name="selectedGroup" class="form-control select2bs4 select2-hidden-accessible"
                          style="width:
                  100%;"
                          data-select2-id="17" tabindex="-1" aria-hidden="true" required>

                    <?php if (!empty($this->data['groups'])):
                      foreach ($this->data['groups'] as $group):?>
                        <option <?php if ($this->data['storedUserInfo']->group_id == $group->id) echo 'selected' ?>
                                data-select2-id="<?=$group->id?>"
                                value="<?= $group->id; ?>"><?=$group->name ?></option>
                      <?php endforeach; endif; ?>
                  </select>

                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary"
                        name="submit">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= BACK_ASSETS?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= BACK_ASSETS?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= BACK_ASSETS?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BACK_ASSETS?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= BACK_ASSETS?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= BACK_ASSETS?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= BACK_ASSETS?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= BACK_ASSETS?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= BACK_ASSETS?>plugins/jszip/jszip.min.js"></script>
<script src="<?= BACK_ASSETS?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= BACK_ASSETS?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= BACK_ASSETS?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= BACK_ASSETS?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= BACK_ASSETS?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= BACK_ASSETS?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= BACK_ASSETS?>dist/js/demo.js"></script>
<!-- Page specific script -->
<?php require_once USER_MESSAGES?>
<!--Prevent resubmission  -->
<?php require_once RESUBMISSION_PREVENT?>
<!--Form Validation -->
<?php require_once FORM_VALIDATION?>

</body>
</html>
