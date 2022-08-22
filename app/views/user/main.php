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
                            <a class="btn btn-success" href="<?= ROOT_LINK . "user/add"?>">
                                Add <i class="fas fa-plus-circle"></i>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                          <?php if(isset($this->massegesToUser['error'])):?>
                              <button class="btn btn-success auto-click toastrDefaultError" hidden></button>
                          <?php endif; ?>

                          <?php if(isset($this->massegesToUser['success'])):?>
                              <button class="btn btn-success auto-click toastrDefaultSuccess" hidden></button>
                          <?php endif; ?>

                          <?php if(isset($this->massegesToUser['warning'])):?>
                              <button class="btn btn-success auto-click toastrDefaultWarning" hidden></button>
                          <?php endif; ?>

                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th >Name</th>
                                    <th >Group</th>
                                    <th >Phone Number</th>
                                    <th >E-mail</th>
                                    <th >Last Login</th>
                                    <th >Join Date</th>
                                    <th style="width:15%">Controls</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty ($this->data['groups'])):
                                  foreach ($this->data['groups'] as $group):
                                    ?>
                                      <tr>
                                          <td><?= $group->name ?>
                                          </td>

                                          <td style="text-align: center">
                                              <a class="btn btn-info" href="<?= ROOT_LINK .
                                              "userGroups/edit/" . $group->id?>">
                                                  Edit  <i class="fas fa-edit"></i>
                                              </a>
                                              <a class="btn btn-danger" data-toggle="modal" data-target="#modal-warning"
                                                 href="<?= ROOT_LINK . "userGroups/delete/" . $group->id?>"
                                              >
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

<!-- delete Confirmation -->
<div class="modal fade" id="modal-warning">
    <div class="modal-dialog">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation !</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirm that you want to delete this group.</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-outline-light confirm-agree"
                        onclick="javascript:confirmationDelete($(this));return false;"
                        href='<?php if(!empty ($this->data['groups']))
                          echo ROOT_LINK . "userGroups/delete/{$group->id}"?>'>Yes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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
<!--Confirm Delete-->
<script>
    function confirmationDelete(anchor)
    {
        window.location=anchor.attr("href");
    }
</script>
<!-- Page specific script -->
<?php require_once USER_MESSAGES?>

</body>
</html>
