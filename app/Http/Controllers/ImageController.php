<?php

namespace App\Http\Controllers;

use App\Services\Images\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function __construct(protected ImageService $service)
    {}

    public function store(Request $request): void
    {
        $img = $this->service->store($request);

        echo json_encode(array('location' => "$img->location"));
    }

    public function update(Request $request): void
    {
        $this->service->update($request);
    }
}
