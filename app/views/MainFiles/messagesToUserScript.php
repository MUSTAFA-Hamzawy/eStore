
<!-- Toastr -->
<script src="<?= BACK_ASSETS?>plugins/toastr/toastr.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= BACK_ASSETS?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!--Special Function -->
<script type="text/javascript">
    let element = document.querySelector(".auto-click");

    if (element) {
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        });

      <?php if(isset($this->massegesToUser['success'])):?>
        toastr.success('<?php echo $this->massegesToUser['success'] ?>')
      <?php endif; ?>

      <?php if(isset($this->massegesToUser['error'])):?>
        toastr.error('<?php echo $this->massegesToUser['error'] ?>')
      <?php endif; ?>

      <?php if(isset($this->massegesToUser['warning'])):?>
        toastr.warning('<?php echo $this->massegesToUser['warning'] ?>')
      <?php endif; ?>
    }
</script>