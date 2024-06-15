<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Http\Requests\UploadFileRequest;
use App\Http\Resources\Api\FileResource;
use App\Http\Services\Chat\FileService;
use App\Http\Services\File\FileService as FileFileService;
use App\Models\File;

class FileController extends Controller
{
    public function __construct(private FileFileService $fileService) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::all();

        return FileResource::collection($files);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(UploadFileRequest $request)
    {
        return $this->fileService->upload($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}