<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error403()
    {
        $data['page'] = '403';
        $data['title'] = "Error 403";
        return view('errors.403', compact('data'));
    }

    public function error404()
    {
        $data['page'] = '404';
        $data['title'] = "Error 404";
        return view('errors.404', compact('data'));
    }
}
