<h1>{{ $post->title }}</h1> {{-- Automático: español o inglés según locale --}}

<div>
    <a href="{{ route('locale.switch', 'es') }}">Español</a> |
    <a href="{{ route('locale.switch', 'en') }}">English</a>
</div>

<article>
    {{ $post->content }}
</article>

@if($post->excerpt)
    <p>{{ $post->excerpt }}</p>
@endif
