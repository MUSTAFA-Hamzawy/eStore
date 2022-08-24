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
              <a class="btn btn-info" href="<?= ROOT_LINK . $this->controller?>">
                <i class="fas fa-home"></i>
              </a>
            </div>
            <!-- /.card-header -->

            <?php require_once SHOW_USER_MESSAGES?>

            <form  method="POST" class="needs-validation col-lg-6 col-sm-8" novalidate>
              <div class="card-body">
                  <div class="form-group">
                      <label for="name">Supplier Name</label>
                      <input type="text" class="form-control" id="name"
                             name="name"
                             min="5" maxlength="25"
                             value="<?= \MVC\core\helpers::showValue('Name', $this->data['storedSupplier']) ?>"
                      >
                  </div>
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control"
                             id="email" name="email" required
                             value="<?= \MVC\core\helpers::showValue('Email', $this->data['storedSupplier']) ?>"
                  </div>
                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="number" class="form-control"
                         placeholder="Phone Number" id="phone" name="phone"
                         value="<?= \MVC\core\helpers::showValue('PhoneNumber', $this->data['storedSupplier']) ?>">
                </div>
                  <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address"
                             name="address" required
                             value="<?= \MVC\core\helpers::showValue('address', $this->data['storedSupplier']) ?>"
                      >
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
