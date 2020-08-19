<?=
  $this->extend('layout/template'); // mark this file to called in template.php
?>

<?=
  $this->section('content'); // Select content that you want
?>
<div class="container ml-5">
  <div class="row">
    <div class="col-5">
      <h1 class="my-3">Edit Comic</h1>

      <form action="/comics/update/<?= $comic['id']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); //form only can inputed from this page 
        ?>
        <input type="hidden" name="slug" value="<?= $comic['slug']; ?>">
        <input type="hidden" name="oldCover" id="oldCover" value="<?= $comic['cover']; ?>">
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">Title</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" name="title" placeholder="Title" autocomplete="off" value="<?= old('title', $comic['title']); ?>">
            <!-- old('title', $comic['title']) ==>> show value of title to form and will be changed by $comic['title'] -->
            <div class="invalid-feedback">
              <?= $validation->getError('title'); ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="author" class="col-sm-2 col-form-label">Author</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="password" name="author" placeholder="Author" autocomplete="off" value="<?= old('author', $comic['author']); ?>">
          </div>
        </div>
        <div class=" form-group row">
          <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="password" name="publisher" placeholder="Publisher" autocomplete="off" value="<?= old('publisher', $comic['publisher']); ?>">
          </div>
        </div>
        <div class=" form-group row">
          <label for="cover" class="col-sm-2 col-form-label">Cover</label>
          <div class="col-sm-4 ">
            <img src="/img/<?= $comic['cover']; ?>" class="img-thumbnail img-preview">
          </div>
          <div class="col-sm-6">
            <div class="custom-file">
              <input type="file" class="custom-file-input <?= ($validation->hasError('cover')) ? 'is-invalid' : ''; ?>" id="cover" name="cover" onchange="previewImg()">
              <div class="invalid-feedback">
                <?= $validation->getError('cover'); ?>
              </div>
              <label class="custom-file-label" for="cover"><?= $comic['cover']; ?></label>
            </div>
          </div>
        </div>
        <button type=" submit" class="btn btn-success my-2">Edit Comic</button>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>