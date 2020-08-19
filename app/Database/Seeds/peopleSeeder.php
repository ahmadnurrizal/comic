<?php
// fill people table in database

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class peopleSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $faker = \Faker\Factory::create('id_ID'); // dont need namespace because ci4 using autoloading

    for ($i = 0; $i < 100; $i++) { // create people data and insert to database one by one
      $data = [
        'name'       => $faker->name, // create dummy name
        'street'      => $faker->street, // create dummy street
        'created_at'  => Time::createFromTimestamp($faker->unixTime()), // create dummy born date
        'updated_at'  => Time::now() // time now
      ];
      $this->db->table('people')->insert($data); // insert one data to database
    }

    // Simple Queries
    // $this->db->query(
    //   "INSERT INTO people (name, street) VALUES(:name:, :street:)",
    //   $data
    // );

    // Using Query Builder
    // $this->db->table('people')->insert($data); // insert one data to database
    // $this->db->table('people')->insertBatch($data); // insert any data to database 
  }
}
