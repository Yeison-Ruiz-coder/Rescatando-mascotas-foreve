<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <input type="text" name="title" placeholder="Título en español" required>
    <textarea name="content" placeholder="Contenido en español" required></textarea>
    <textarea name="excerpt" placeholder="Extracto en español"></textarea>
    <button type="submit">Guardar Post</button>
</form>
