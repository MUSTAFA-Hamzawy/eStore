
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

      <?php $messeges = $this->messenger->getMesseges();
      if (! is_null($messeges)):
      foreach ($messeges as $msg):?>
        toastr.<?= strtolower($msg[0])?>('<?= $msg[1] ?>')
      <?php endforeach; endif; ?>

    }
</script>