<?php

namespace App\Controllers;

use App\Models\ComicModel;

class Comics extends BaseController
{
  protected $comicModel;
  public function __construct() // create __construct therefor we don't rewrite this code each method
  {
    $this->comicModel = new ComicModel(); // connect to ComicModel
  }

  public function index()
  {
    // $comics = $this->comicModel->findAll(); // get All data from database
    $data = [
      'title' => "Comic",
      'comics' => $this->comicModel->getComic() // comicModel,, initial(first) letter must lowercase
    ];

    return view('comic/index', $data);
  }

  public function detail($slug)
  {
    $data = [
      'title' => 'Comics Detail',
      'comic' =>  $this->comicModel->getComic($slug) // comicModel,, initial(first) letter must lowercase
    ];

    if (empty($data['comic'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Comic ' . $slug . ' not found'); // show error that comic not found
    }

    return view('/comic/detail', $data);
  }

  public function add()
  {
    // session(); -> start session (has written in baseController)
    $data = [
      'title' => 'Add Comic',
      'validation' => \Config\Services::validation() // initiate 'validation function' to $data
    ];

    return view('/comic/add', $data);
  }

  public function save()
  {
    // $this->request->getVar('title'); -> get specific data from form
    // $this->request->getVar(); -> get all data from form

    // validation form
    if (!$this->validate([
      'title' => [
        'rules' => 'required|is_unique[comic.title]',
        // checkout here for others rules ==>> https://codeigniter.com/user_guide/libraries/validation.html?highlight=validation#setting-validation-rules
        'errors' => [
          'required' => 'Isi dlu Gann {field}-nya !!', // {field} = output his name table
          'is_unique' => '{field} ini udah ada bossque '
        ]
        // you can replace other errors and rules
      ],
      // === upload file ===
      'cover' => [
        'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/png,image/jpg,image/jpeg]',
        // checkout for more ==>> https://codeigniter.com/user_guide/libraries/validation.html?highlight=validation#rules-for-file-uploads
        'errors' => [
          // 'uploaded' => 'Upload fileki dlu dihh', // must to upload file
          'max_size' => 'Batas maksimalnya 1 MB', // max size is 1 MB
          'is_image' => 'formatnya harus png,jpg, atau jpeg', // format is png, jpg, jpeg
          'mime_in' => 'formatnya harus png/jpg/jpeg' // checking image or not
        ]
      ]
    ])) {
      // $validation = \config\Services::validation(); // initiate validation function
      // return redirect()->to('/comics/add')->withInput()->with('validation', $validation); // go to /comics/add and send $validation
      return redirect()->to('/comics/add')->withInput(); // $validation has included in withInput 
    }

    // get image
    $fileCover = $this->request->getFile('cover');

    // checking there uploaded image or not
    if ($fileCover->getError() == 4) {
      $nameCover = 'default.png';
    } else {
      // generate random name
      $nameCover = $fileCover->getRandomName();
      // move file to img folder
      $fileCover->move('img', $nameCover); // automatically go to public/...

      // get file name cover ==>> get name original image
      // $nameCover = $fileCover->getName();
    }

    $slug = url_title($this->request->getVar('title'), '-', true); // convert string to lowercase and replace space ' ' to '-'
    $this->comicModel->save([ // directly insert data to database
      'title' => $this->request->getVar('title'),
      'author' => $this->request->getVar('author'),
      'slug' => $slug,
      'publisher' => $this->request->getVar('publisher'),
      'cover' => $nameCover
    ]);

    session()->setFlashdata('message', 'Comic success to add'); // making session

    return redirect()->to('/comics'); // go to /comics/index
  }

  public function delete($id)
  {
    $comic = $this->comicModel->find($id);

    if ($comic['cover'] != 'default.png') {
      unlink('img/' . $comic['cover']);
    }

    $this->comicModel->delete($id); // delete data from database by id
    session()->setFlashdata('message', 'Comic success to delete'); // making session

    return redirect()->to('/comics');
  }

  public function edit($slug)
  {
    // session(); -> start session (has written in baseController)
    $data = [
      'title' => 'Edit Comic',
      'validation' => \Config\Services::validation(), // initiate 'validation function' to $data
      'comic' =>  $this->comicModel->getComic($slug)
    ];

    return view('/comic/edit', $data);
  }

  public function update($id) // method to edit data of comic
  {

    // validation form
    if (!$this->validate([
      'title' => [
        'rules'     =>  "required|is_unique[comic.title,id,$id]", // this rule just run if title changed
        // checkout here for others rules => https://codeigniter.com/user_guide/libraries/validation.html?highlight=validation#setting-validation-rules
        'errors' => [
          'required' => 'Isi dlu Gann {field}-nya !!', // {field} = output his name table
          'is_unique' => '{field} ini udah ada bossque '
        ],
        // === upload file ===
        'cover' => [
          'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/png,image/jpg,image/jpeg]',
          // checkout for more ==>> https://codeigniter.com/user_guide/libraries/validation.html?highlight=validation#rules-for-file-uploads
          'errors' => [
            // 'uploaded' => 'Upload fileki dlu dihh', // must to upload file
            'max_size' => 'Batas maksimalnya 1 MB', // max size is 1 MB
            'is_image' => 'formatnya harus png,jpg, atau jpeg', // format is png, jpg, jpeg
            'mime_in' => 'formatnya harus png/jpg/jpeg' // checking image or not
          ]
        ]
        // you can add other errors and rules
      ]
    ])) {
      //$validation = \config\Services::validation(); // initiate validation function
      return redirect()->to('/comics/add')->withInput(); // $validation has included in withInput 
    }

    $fileCover = $this->request->getFile('cover');

    // check image, old or not
    if ($fileCover->getError() == 4) {
      $nameCover = $this->request->getVar('oldCover');
    } else {
      // generate file name random
      $nameCover = $fileCover->getRandomName();
      // move image
      $fileCover->move('img', $nameCover);
      // delete old file
      unlink("img/" . $this->request->getVar('oldCover'));
    }

    $slug = url_title($this->request->getVar('title'), '-', true); // convert string to lowercase and replace space ' ' to '-'
    $this->comicModel->save([ // directly insert data to database
      'id' => $id,
      'title' => $this->request->getVar('title'),
      'author' => $this->request->getVar('author'),
      'slug' => $slug,
      'publisher' => $this->request->getVar('publisher'),
      'cover' => $nameCover
    ]);

    session()->setFlashdata('message', 'Comic success to update'); // making session

    return redirect()->to('/comics'); // go to /comics/index
  }
}
