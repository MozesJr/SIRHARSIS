<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageGallery;

class UploadController extends Controller
{
    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('/uploads');
    }

    public  function uploadDropzoneFile(Request $request)
    {

        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }

        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = time() . '.' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filePath);
        }

        $imageUpload = new ImageGallery;
        $imageUpload->original_filename =  $fileName;
        $imageUpload->filename_path = $filePath;
        // $imageUpload->id_harian = $request->idharian;
        $imageUpload->save();
        return response()->json(['success' => $fileName]);
    }

    public function destroyFile(Request $request)
    {
        $filename =  $request->get('name');
        ImageGallery::where('original_filename', $filename)->delete();
        $path = public_path('uploads/') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => $filename]);
    }
}
