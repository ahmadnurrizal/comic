<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>CodeIgniter_4 | <?= $title; ?> </title>

  <!-- My CSS (directly connect to public) -->
  <link rel="stylesheet" href="/css/style.css">

  <?php
  // d($var) -> same as var_dump, but special in CodeIgniter
  // dd($var) -> same as var_dump and die, but special in CodeIgniter
  ?>
</head>

<body>
  <?=
    $this->include('layout/navbar'); // connect to layout/navbar.php 
  ?>

  <?=
    $this->renderSection('content'); // get data from views (home,about,dll) and run 
  ?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
    // showing preview img when upload file
    function previewImg() {
      const cover = document.querySelector('#cover'); // choose the target
      const coverLabel = document.querySelector('.custom-file-label');
      const imgPreview = document.querySelector('.img-preview');

      coverLabel.textContent = cover.files[0].name; // show name of img

      const fileCover = new FileReader();
      fileCover.readAsDataURL(cover.files[0]);

      fileCover.onload = function(e) {
        imgPreview.src = e.target.result;
      }
    }
  </script>
</body>

</html>