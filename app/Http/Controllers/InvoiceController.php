<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InvoiceController extends Controller
{
    public function index(){

        $data = Http::get('http://minierp.hpy.co.id//api/resource/POS%20Invoice');


        return $data->json();
    }
}
