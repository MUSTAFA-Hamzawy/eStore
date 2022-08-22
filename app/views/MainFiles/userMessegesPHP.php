
<?php $messeges = $this->messenger->getMesseges();
if (! is_null($messeges)):
  foreach ($messeges as $msg)?>
    <button class="btn btn-success auto-click toastrDefault<?= $msg[0]?>" hidden></button>
<?php endif; ?>