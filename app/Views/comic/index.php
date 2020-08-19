<?=
  $this->extend('layout/template'); // mark this file to called in template.php
?>

<?=
  $this->section('content'); // Select content that you want
?>
<div class="container ml-5">
  <div class="row">
    <div class="col">
      <h1>Comics List</h1>
      <a href="/comics/add" class="btn btn-primary my-3">Add Comic</a>
      <?php if (session()->getFlashdata('message')) { ?>
        <div class="alert alert-success" role="alert">
          <?= session()->getFlashdata('message'); ?>
        </div>
      <?php } ?>
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Title</th>
            <th scope="col">Cover</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($comics as $comic) { ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= $comic['title']; ?></td>
              <td><img src="/img/<?= $comic['cover']; ?>" alt="<?= $comic['slug']; ?>" class="cover"></td>
              <td>
                <a href="/comics/<?= $comic['slug']; ?>" class="btn btn-primary">Detail</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>