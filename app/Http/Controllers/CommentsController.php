<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentsController extends Controller
{
    public function __invoke(Request $request)
    {
        $comments = Comment::with('user')->paginate(10);

        return Inertia::render('Comments', [
            'comments' => $comments
        ]);
    }
}
