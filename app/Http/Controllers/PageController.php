<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        return view('index');
    }

    public function news()
    {
        return view('news');
    }

    public function post()
    {
        return view('post');
    }

    public function opinion()
    {
        return view('opinion');
    }

    public function sport()
    {
        return view('sport');
    }

    public function scitech()
    {
        return view('scitech');
    }

    public function event()
    {
        return view('event');
    }

    public function about()
    {
        return view('about');
    }

    public function video()
    {
        return view('video');
    }

    public function album()
    {
        return view('album');
    }

    public function cartoonist()
    {
        return view('cartoonist');
    }

    public function live()
    {
        return view('live');
    }


    // Add other methods for the respective pages
}
