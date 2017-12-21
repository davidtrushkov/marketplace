<?php

namespace App\Http\Controllers\Api;

use App\File;
use App\Http\Resources\FilesCollection;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function index() {
    	return new FilesCollection(File::with(['user', 'uploads'])->paginate(5));
    }
}
