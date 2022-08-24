<?php require_once HEADER?>
<?php require_once SIDEBAR ?>

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
              <a class="btn btn-success" href="<?= ROOT_LINK . $this->controller . "/add"?>">
                Add <i class="fas fa-plus-circle"></i>
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <?php require_once SHOW_USER_MESSAGES?>

              <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th >Name</th>
                  <th >Phone Number</th>
                  <th >E-mail</th>
                  <th >Address</th>
                  <th style="width:20%">Controls</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty ($this->data['mainData'])):
                  foreach ($this->data['mainData'] as $supplierInfo):
                    ?>
                    <tr>
                      <td><?= $supplierInfo->Name?></td>
                      <td><?= $supplierInfo->PhoneNumber?></td>
                      <td><?= $supplierInfo->Email?></td>
                      <td><?= $supplierInfo->address?></td>
                      <td style="width:17%; text-align: center">
                        <a class="btn btn-info" href="<?= ROOT_LINK . $this->controller . "/edit/" .
                        $supplierInfo->ClientId?>">
                          Edit  <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger"
                           href="<?= ROOT_LINK . $this->controller . "/delete/" . $supplierInfo->ClientId?>"
                           onclick="javascript:return confirm('Are You Confirm Deletion');">
                          Delete
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; endif; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
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

<!-- SweetAlert2 -->
<script src="<?= BACK_ASSETS?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= BACK_ASSETS?>plugins/toastr/toastr.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= BACK_ASSETS?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= BACK_ASSETS?>dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $('#dataTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<!-- Page specific script -->
<?php require_once USER_MESSAGES?>

</body>
</html>
