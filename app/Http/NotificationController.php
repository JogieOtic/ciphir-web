<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show()
    {
        // This method will return the notifications view
        return view('pages.notifications');  // Adjust this path based on where your Blade view file is located
    }
}
