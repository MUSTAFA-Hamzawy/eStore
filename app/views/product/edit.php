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

            <form  method="POST" class="needs-validation col-lg-6 col-sm-8" novalidate enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name"
                         name="name" required
                         min="5" maxlength="25"
                         value="<?= \MVC\core\helpers::showValue('Name', $this->data['storedProduct']) ?>"
                  >
                </div>

                  <div class="form-group">
                      <label for="quantity">Quantity</label>
                      <input type="number" class="form-control" id="quantity"
                             name="quantity" min="1"
                             value="<?= \MVC\core\helpers::showValue('Quantity', $this->data['storedProduct']) ?>"
                      >
                  </div>
                  <div class="form-group">
                      <label for="price">Price in dollars</label>
                      <input type="number" class="form-control" id="price"
                             name="price" min="1"
                             value="<?= \MVC\core\helpers::showValue('Price', $this->data['storedProduct']) ?>"

                      >
                  </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="selectedCategory" class="form-control select2bs4 select2-hidden-accessible"
                                style="width:100%;"
                                data-select2-id="17" tabindex="-1" aria-hidden="true" required>

                          <?php if (!empty($this->data['categories'])):
                            foreach ($this->data['categories'] as $category):?>
                                <option <?php if ($this->data['storedProduct']->CategoryId == $category->CategoryId) echo 'selected' ?>
                                        data-select2-id="<?=$category->CategoryId?>"
                                        value="<?= $category->CategoryId; ?>"><?=$category->Name ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>


                <div class="form-group">
                  <label for="image">Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input name="image" type="file" class="custom-file-input" id="image" accept="image/*">
                      <label class="custom-file-label" for="image">Upload Image</label>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <img src="<?= "../../uploads/images/" . \MVC\core\helpers::showValue('Image',
                      $this->data['storedProduct'])  ?> " width="150px">
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
