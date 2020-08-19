<?php

namespace App\Models;

use CodeIgniter\Model;

class PeopleModel extends Model
{
  protected $table = 'people'; // choose your table in database
  protected $useTimestamps = true; // use for count times
  protected $allowedFields = ['name', 'street']; // determine table which can input manually 

  public function search($keyword)
  {
    return $this->table('people')->like('name', $keyword)->orLike('street', $keyword); // set search($keyword) run by name and street
  }
}
