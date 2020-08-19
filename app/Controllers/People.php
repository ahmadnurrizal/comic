<?php

namespace App\Controllers;

use App\Models\PeopleModel;

class People extends BaseController
{
  protected $peopleModel;
  public function __construct() // create __construct therefor we don't rewrite this code each method
  {
    $this->peopleModel = new PeopleModel(); // connect to ComicModel
  }

  public function index()
  {
    $currentPage = $this->request->getVar('page_people') ?  $this->request->getVar('page_people') : 1;
    $dataEachPage = 5;
    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
      $people = $this->peopleModel->search($keyword);
    } else {
      $people = $this->peopleModel;
    }

    $data = [
      'title' => "People",
      'people' => $this->peopleModel->paginate($dataEachPage, 'people'),
      'pager' => $this->peopleModel->pager,
      'currentPage' => $currentPage,
      'dataEachPage' => $dataEachPage
    ];

    return view('people/index', $data);
  }
}
