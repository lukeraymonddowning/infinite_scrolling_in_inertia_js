<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VideoController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        return Inertia::render('Videos', [
            'users' => fn () => User::select(['id', 'name'])->get(),
            'videos' => fn () => Video::with('user')
                ->when($request->filled('user_id'), fn ($query) => $query->where('user_id', $request->query('user_id')))
                ->paginate(10),
        ]);
    }
}
