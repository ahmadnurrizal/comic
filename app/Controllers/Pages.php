<?php

namespace App\Controllers;

class Pages extends BaseController
{
  public function index()
  {
    $data = [
      'title' => "Home"
    ];
    return view('page/home', $data);  // location/param1/param2/...
  }

  public function about()
  {
    $data = [
      'title' => "About"
    ];
    return view('page/about', $data);
  }

  public function contact()
  {
    $data = [
      'title' => "Contact Us"
    ];
    return view('page/contact', $data);
  }
}
