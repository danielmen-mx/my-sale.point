<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class SalePointController extends Controller
{
    public function index()
    {
        return view('sale_point.index');
    }
}
