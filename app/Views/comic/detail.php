<?=
  $this->extend('layout/template'); // mark this file to called in template.php
?>

<?=
  $this->section('content'); // Select content that you want
?>
<div class="container ml-5">
  <h1 class="mb-3">Detail Comic</h1>
  <div class="row">
    <div class="col">
      <div class="card flex-row flex-wrap " style="width: 40rem;">
        <div class="card-header border-0">
          <img src="/img/<?= $comic['cover']; ?>" alt="<?= $comic['slug']; ?>" width="200px">
        </div>
        <div class="card-body px-3">
          <h4 class="card-title"><?= $comic['title']; ?></h4>
          <h6><b>Author : </b><?= $comic['author']; ?></h6>
          <h6 class="text-muted mb-4"><b>Publisher : </b><?= $comic['publisher']; ?></h6>

          <a href="/comics/edit/<?= $comic['slug']; ?>" class="btn btn-warning mt-2 mr-2">Edit</a>

          <form action="/comics/<?= $comic['id']; ?>" class="d-inline" method="post">
            <?= csrf_field(); //form only can inputed from this page 
            ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Are You Sure ?')">Delete</button>
          </form>
          <br><br><br><br><br>
          <a href="/comics" class="btn btn-primary float-right mr-1">Back</a>
        </div>
      </div>




    </div>

  </div>
  <br>

</div>



<?= $this->endSection(); ?>