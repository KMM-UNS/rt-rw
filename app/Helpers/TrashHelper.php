<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TrashHelper
{
  public static function moveToTrash($filePath)
  {
    try {
      $newPath = (string) Str::of($filePath)->replace('storage', 'trash');
      $oldPath = (string) Str::of($filePath)->replace('storage', '');

      $storage = Storage::disk('public');
      $storage->move($oldPath, $newPath);
      return '/storage' . $newPath;
    } catch (\Throwable $th) {
      // dd($th);
    }
  }

  public static function empty()
  {
    try {
      $storage = Storage::disk('public');
      return $storage->deleteDirectory('trash');
    } catch (\Throwable $th) {
      // dd($th);
    }
  }
}
