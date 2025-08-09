<?php

namespace App\Http\Controllers;

use App\Models\BoardMessage;
use Illuminate\Http\Request;
use App\Enums\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BoardMessageController extends Controller
{
    public function index(): View
    {
        $messages = BoardMessage::all();

        return view('messages.index', compact('messages'));
    }

    public function store(Request $request): RedirectResponse
    {
        BoardMessage::create([
            'message'=> $request->message,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('messages.index');
    }

    public function destroy(BoardMessage $message): RedirectResponse
    {
        if ( auth()->user()->role_id === UserRole::Admin->value || $message->user_id === auth()->id() ) {
            $message->delete();
        } else {
            abort(401, 'You are not authorised to perform this action.');
        }
        

        return redirect()->route('messages.index');
    }
}
