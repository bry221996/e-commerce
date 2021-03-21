<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request, Store $store)
    {
        return view('client.index', [
            'store' => $store
        ]);
    }
}
