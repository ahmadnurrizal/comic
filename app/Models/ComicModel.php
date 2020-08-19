<?php

namespace App\Models;

use CodeIgniter\Model;

class ComicModel extends Model
{
  protected $table = 'comic'; // choose your table in database
  protected $useTimestamps = true; // use for count times
  protected $allowedFields = ['title', 'slug', 'author', 'publisher', 'cover']; // determine table which can input manually 

  public function getComic($slug = false)
  {
    if ($slug == false) {
      return $this->findAll();
    }

    return $this->where(['slug' => $slug])->first(); // find slug with value $slug in database
  }
}
