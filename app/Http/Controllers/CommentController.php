<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\DataTransferObjects\CommentDto;
use App\Services\Comments\CommentService;

class CommentController extends Controller
{
    public function __construct(
        protected CommentService $service,
    ) {}

    public function store(CommentRequest $request)
    {
        $this->service->store(
            CommentDto::fromRequest($request)
        );

        return redirect()->back()->with('success', 'Success! Comment submitted.');
    }
}
