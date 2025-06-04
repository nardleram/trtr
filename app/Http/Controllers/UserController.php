<?php

namespace App\Http\Controllers;

use App\Events\Registered;
use App\Http\Requests\UserRequest;
use App\Services\Users\UserService;
use App\DataTransferObjects\UserDto;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ) {}

    public function edit(User $user): View
    {
        return view('users.edit')->with([
            'user' => $user
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $user = $this->service->store(
            UserDto::fromRequest($request)
        );

        Auth::login($user);
        event(new Registered($user));

        return redirect()->route('threads.create');
    }

    public function update(UserRequest $request): RedirectResponse
    {
        $user = $this->service->update(
            $request->user,
            UserDto::fromRequest($request)
        );

        return redirect()->route('users.edit')->with([
            'user' => $user,
            'success' => "User updated successfully"
        ]);
    }
}
