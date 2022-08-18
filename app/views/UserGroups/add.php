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

                  <form autocomplete="off" method="POST" class="needs-validation" novalidate>
                  <div class="card-body col-6">
                      <div class="form-group">
                          <label for="groupName">Group Name</label>
                          <input type="text" class="validationRequired form-control" id="groupName"
                                 placeholder="Ex: Managers" name="groupName"
                          required>
                          <div class="invalid-feedback">
                              Group Name is required!.
                          </div>
                      </div>
                      <label for="groupName">Privileges</label>
                    <?php if (!empty($this->data['privileges'])): $i=0; foreach ($this->data['privileges'] as
                                                                                 $privilege)
                        : ?>
                          <div >
                              <input  type="checkbox" id="privilegeName_<?=$i?>"
                                     value="<?=$privilege->id ?>"
                                     name="privileges[]">
                              <label style="font-weight: 500;" for="privilegeName_<?=$i++?>"
                              ><?=$privilege->privillege ?></label>
                          </div>
                      <?php endforeach; endif;?>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                      <button type="submit" class="btn btn-primary"
                              name="submit">Submit</button>
                  </div>
              </form>

              </div>
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
<!-- AdminLTE App -->
<script src="<?= BACK_ASSETS?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= BACK_ASSETS?>dist/js/demo.js"></script>
<!-- Page specific script -->
<?php require_once USER_MESSAGES?>
<!--Form Validation -->
<?php require_once FORM_VALIDATION?>
<!--Prevent resubmission  -->
<?php require_once RESUBMISSION_PREVENT?>

</body>
</html>
