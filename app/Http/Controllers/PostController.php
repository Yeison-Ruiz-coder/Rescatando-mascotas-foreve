<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; // 👈 IMPORTAR ESTO

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse //
    {
        // Guardar SOLO en español (el observer lo traducirá)
        $post = Post::create([
            'title' => ['es' => $request->title],
            'content' => ['es' => $request->contenthash],
            'excerpt' => ['es' => $request->excerpt],
            'status' => 'published',
        ]);

        // ¡El observer traducirá automáticamente a inglés!

        return redirect()->route('posts.show', $post);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
