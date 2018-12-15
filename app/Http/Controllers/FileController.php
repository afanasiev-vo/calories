<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        return response()->json([$request]);
    }

    public function upload(Request $request)
    {
        $uploadedFile = $request->file('thumbnail');
        $filename = time().$uploadedFile->getClientOriginalName();
        $realPath = $uploadedFile->getRealPath();
        $path = $uploadedFile->getPath();
        $pathName = $uploadedFile->getPathname();
        Storage::disk('local')->putFileAs(
            'public',
            $uploadedFile,
            $filename
        );
        $url = Storage::url($filename);

        return response()->json([
            'id' => $filename,
            '$realPath'=>$realPath,
            '$path'=>$path,
            '$pathName'=>$pathName,
            'url' => $url
        ]);
    }
}
