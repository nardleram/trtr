<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\View\View;
use App\Http\Requests\ThreadRequest;
use App\DataTransferObjects\ThreadDto;
use App\Exceptions\ThreadException;
use App\Http\Resources\ThreadResource;
use App\Services\Threads\ThreadService;
use Exception;

class ThreadController extends Controller
{
    public function __construct(protected ThreadService $service)
    {}

    public function index(): View
    {
        return view('threads.index')->with(['threads' => Thread::all()]);
    }

    public function create(): View
    {
        return view('threads.create');
    }

    public function store(ThreadRequest $request): View
    {
        $thread = $this->service->store(
            ThreadDto::fromRequest($request)
        );

        return view('threads.show')->with([
            'thread' =>Thread::where('id', $thread->id)->first()
        ]);
    }

    public function show($id): View
    {
        try {
            Thread::where('id', $id)->firstOrFail();
        } catch (Exception $e) {
            throw ThreadException::threadNotFound();
        }

        return view('threads.show')->with([
            'thread' => $this->service->show($id, 'App\Models\Thread')
        ]);
    }

    public function edit(Thread $thread): View
    {
        return view('thread.edit')->with([
            'thread' => $thread
        ]);
    }
}
