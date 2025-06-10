<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\UpdateUserDto;
use App\Events\Registered;
use App\Http\Requests\UserRequest;
use App\Services\Users\UserService;
use App\DataTransferObjects\UserDto;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Hash;
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

    public function update(User $user, UpdateUserRequest $request): RedirectResponse
    {
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('users.edit', $user)->with([
                'error' => "Incorrect password given. Please try again."
            ]);
        } else {
            $updated_user = $this->service->update(
                $user,
                UpdateUserDto::fromRequest($request)
            );
        }

        return redirect()->route('users.edit', $updated_user)->with([
            'success' => "User updated successfully"
        ]);
    }
}
