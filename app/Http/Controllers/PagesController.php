<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function brands()
    {
        return view('pages.brands');
    }

    public function contact_us()
    {
        return view('pages.contact-us');
    }

    public function registration()
    {
        return view('pages.registration');
    }

    public function access_denied()
    {
        return view('pages.access-denied');
    }
}
