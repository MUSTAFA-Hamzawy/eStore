<?php require_once "header.php" ?>
<?php require_once "sidebar.php" // todo-me make add button ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
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
                                <a class="btn btn-success" href="<?= ROOT_LINK . "privileges/add"?>">
                                    Add <i class="fas fa-plus-circle"></i>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Group</th>
                                        <th>E-mail</th>
                                        <th>Joining Date</th>
                                        <th>Last Login</th>
                                        <th>Controls</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Trident</td>
                                        <td>Internet
                                            Explorer 4.0
                                        </td>
                                        <td>Win 95+</td>
                                        <td> 4</td>
                                        <td>X</td>
                                        <td>
                                            <a class="btn btn-info" href="<?= ROOT_LINK .
                                            "privileges/edit"?>">
                                                Edit  <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger" href="<?= ROOT_LINK .
                                            "privileges/delete"?>">
                                                Delete  <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

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
<!-- AdminLTE App -->
<script src="<?= BACK_ASSETS?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= BACK_ASSETS?>dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>
</html>