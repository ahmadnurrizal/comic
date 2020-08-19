<?=
  $this->extend('layout/template'); // mark this file to called in template.php
?>

<?=
  $this->section('content'); // Select content that you want
?>

<div class="container ml-5">

  <div class="row">
    <div class="col">
      <h1>People List</h1>
      <div class="row">
        <div class="col-6">
          <form action="" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword" id="keyword">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" name="submit">Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


    <table class="table ml-3">
      <thead class="thead-light">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Name</th>
          <th scope="col">Street</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 + ($dataEachPage * ($currentPage - 1)); ?>
        <?php foreach ($people as $person) { ?>
          <tr>
            <th scope="row"><?= $i++; ?></th>
            <td><?= $person['name']; ?></td>
            <td><?= $person['street']; ?></td>
            <td>
              <a href="#" class="btn btn-primary">Detail</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="row  ml-3">
      <?= $pager->links('people', 'people_pagination'); ?>
    </div>

  </div>
</div>
</div>
<?= $this->endSection(); ?>