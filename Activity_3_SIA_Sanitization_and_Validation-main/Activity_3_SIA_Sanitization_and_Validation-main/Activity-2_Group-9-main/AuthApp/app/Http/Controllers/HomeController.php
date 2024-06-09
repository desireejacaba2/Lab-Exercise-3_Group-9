<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Method to display the home page
    public function index()
    {
        return view('home');
    }
}
