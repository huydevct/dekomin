<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UploadRequest;
use App\Services\StorageService\StorageFile;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    function uploadImage(UploadRequest $request){
        $params = $request->validated();
        if (isset($params['file'])) {
            $data_return = StorageFile::uploadImage($params['file']);
        } else if (isset($params['files'])) {
            $data_return = StorageFile::uploadMultiImages($params['files']);
        } else {
            return $this->response("Not found file upload", 404);
        }

        if ($data_return == false) {
            return $this->response("Upload file fail!", 500);
        }

        return $this->response($data_return);
    }
}
