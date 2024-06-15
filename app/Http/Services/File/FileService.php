<?php

declare(strict_types=1);

namespace App\Http\Services\File;

use App\Http\Requests\UploadFileRequest;
use App\Models\File;

class FileService implements FileServiceInterface {
    public function upload(UploadFileRequest $request)
    {
        $request->validated();

        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        $fileInDB = File::create(["path" => $path]);

        return $fileInDB;
    }
}