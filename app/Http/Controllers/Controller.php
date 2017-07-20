<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $request
     * @param $instance
     * @return array|bool
     */
    public function uploadRequestImage($request, $instance)
    {
        if ($request->hasFile('image'))
        {
            $imageDetails = [
                'path' => $request->image->store(strtolower(str_plural(class_basename($instance))), 'public')
            ];

            if ($instance->image)
            {
                $instance->image->deleteImage();
                $instance->image->update($imageDetails);
            }
            else
            {
                $instance->image()->create($imageDetails);
            }
        }

        if ($request->hasFile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $imageDetails = [
                    'path' => $image->store(strtolower(str_plural(class_basename($instance))), 'public')
                ];

                $instance->images()->create($imageDetails);
            }
        }

        return false;
    }
}
