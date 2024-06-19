<?php

declare(strict_types=1);

namespace App\Http\Services\File;

use App\Http\Requests\UploadFileRequest;
use App\Models\File;

class FileService implements FileServiceInterface {
    public function upload(UploadFileRequest $request)
    {
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName(); // Get original file name
        $size = $file->getSize(); // Get file size in bytes
        $type = $file->getClientMimeType(); // Get file MIME type

        $path = $file->store('uploads', 'public'); // Store file in 'public/uploads' directory

        $fileInDB = File::create([
            'name' => $originalName,
            'size' => $size,
            'type' => $type,
            'path' => $path,
        ]);

        return $fileInDB;
    }
}