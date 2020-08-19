<?=
  $this->extend('layout/template'); // mark this file to called in template.php
?>

<?=
  $this->section('content'); // Select content that you want
?>
<div class="container ml-3">
  <div class="row">
    <div class="col">
      <h1>Ini Contact Us</h1>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>