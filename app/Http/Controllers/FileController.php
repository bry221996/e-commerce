<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\UploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(UploadRequest $request)
    {
        $path = $request->file('file')->store('file', 's3');

        return response()->json([
            'status' => true, 
            'data' => ['link' => $path]
        ]);
    }
}
