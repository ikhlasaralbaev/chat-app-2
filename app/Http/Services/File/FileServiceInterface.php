<?php
declare(strict_types=1);
namespace App\Http\Services\File;

use App\Http\Requests\UploadFileRequest;

interface FileServiceInterface {
    public function upload(UploadFileRequest $request);
}