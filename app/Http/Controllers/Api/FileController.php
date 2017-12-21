<?php

namespace App\Http\Controllers\Api;

use App\File;
use App\Http\Resources\FilesCollection;
use App\Http\Controllers\Controller;

class FileController extends Controller
{

	const PERPAGE = 5;

    public function index() {
    	return new FilesCollection(File::with(['user', 'uploads'])->readyToBeShown()->paginate(self::PERPAGE));
    }
}
