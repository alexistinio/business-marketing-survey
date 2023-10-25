<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFileTrait {

    public function uploadFile($file, $path)
    {    
        $month = strtolower(date('F'));
        $year = date('Y');

        $file_path = strtolower(str_replace(" ", "_", $year . '/' . $month . '/' . ltrim($path, '/')) . '/');
        $file_name = date('mdYHis') . uniqid() . '.' . $file->extension();

        Storage::disk('local')->putFileAs('public/' . $file_path, $file, $file_name);

        return $file_path . $file_name;
    }
}