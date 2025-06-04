<?php

namespace App\Services\Images;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ImageService
{
    public function store(Request $request)
    {
        $img = $request->file('file')->store('images/articles', 'public');

        return Image::create([
            'location' => '/storage/'.$img,
            'article_id' => 0
        ]);
    }


    public function destroy($path)
    {
        if (File::exists($path)) {
            File::delete($path);
            return 'File deleted successfully';
        } else {
            return 'Error: file not deleted';
        }
    }
}