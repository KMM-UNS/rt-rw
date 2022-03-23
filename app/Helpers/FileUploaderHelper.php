<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileUploaderHelper
{
  public function store(UploadedFile $uploadedFile, $path = 'uploads')
  {
    if ($uploadedFile) {
      $fileName = time() . Str::random(5) . '_' . $uploadedFile->getClientOriginalName();
      $filePath = $uploadedFile->storeAs($path, $fileName, 'public');

      $public_path = '/storage/' . $filePath;

      return [
        'name' => $fileName,
        'path' => $filePath,
        'public_path' => $public_path
      ];
    }
  }
}
