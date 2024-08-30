<?php

namespace App\Casts\Product;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Images implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $image_config = config('filesystems.image_resize');
        if (!empty($value)) {
            $value = json_decode($value, 1);
            if (empty($value)) return null;
            if (!empty($value)) {
                $value = array_map(function ($item) use ($image_config) {
                    if (!str_contains($item['file_name'], 'upload/')){
                        $item['file_name'] = config('filesystems.upload.path_image').'full/'.$item['file_name'];
                    }
                    $url = [
                        'full' => Storage::url($item['file_name'])
                    ];
                    $url_pre = null;
                    foreach ($image_config as $type => $size) {
                        if ($item['size']['width'] < $size) {
                            $url[$type] = empty($url_pre) ? $url['full'] : $url_pre;
                        } else {
                            $url[$type] = Storage::url($item['file_name']);
                        }
                        $url_pre = $url[$type];
                    }
                    $item['url'] = $url;
                    return $item;
                }, $value);
            }
        }
        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return json_encode($value);
    }
}
