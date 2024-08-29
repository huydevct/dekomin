<?php


namespace App\Services\StorageService;


use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Storage;

class StorageFile
{
    static function uploadMultiImages(array $files)
    {
        return array_map(function ($file) {
            return self::uploadImage($file);
        }, $files);
    }

    static function uploadImage($file)
    {
        $image_config = config('filesystems.image_resize');

        $original_name = $file->getClientOriginalName();
        $type_file = explode(".", $original_name);
        $type_file = end($type_file);
        $path = AppHelper::getPathSaveFile($type_file);
        $image_upload = AppHelper::resizeAndSaveImage($file, $path['path']);
        $url = [
            'full' => Storage::url(config('filesystems.upload.path_image').'full/'.$path['path'])
        ];
        $url_pre = null;
        foreach ($image_config as $type => $size) {
            if ($image_upload['size']['width'] < $size) {
                $url[$type] = empty($url_pre) ? $url['full'] : $url_pre;
            } else {
                $url[$type] = Storage::url(config('filesystems.upload.path_image').$type.'/'.$path['path']);
            }
            $url_pre = $url[$type];
        }
        return [
            "size" => $image_upload['size'],
            "file_name" => $path['path'],
            "url" => $url,
        ];
    }
}
