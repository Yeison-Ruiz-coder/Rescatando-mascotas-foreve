<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslatePosts extends Command
{
    protected $signature = 'translate:posts';
    protected $description = 'Traduce los posts de español a inglés';

    public function handle()
    {
        $translator = new GoogleTranslate('en'); // Traducir a inglés
        $translator->setSource('es'); // Desde español

        $posts = Post::all();

        foreach ($posts as $post) {
            $this->info("Traduciendo post ID: {$post->id}");

            // Traducir título si no tiene inglés
            $title = $post->getTranslations('title');
            if (!isset($title['en']) || empty($title['en'])) {
                $translatedTitle = $translator->translate($title['es'] ?? '');
                $post->setTranslation('title', 'en', $translatedTitle);
            }

            // Traducir contenido si no tiene inglés
            $content = $post->getTranslations('content');
            if (!isset($content['en']) || empty($content['en'])) {
                $translatedContent = $translator->translate($content['es'] ?? '');
                $post->setTranslation('content', 'en', $translatedContent);
            }

            // Traducir extracto si no tiene inglés
            $excerpt = $post->getTranslations('excerpt');
            if (!isset($excerpt['en']) || empty($excerpt['en'])) {
                $translatedExcerpt = $translator->translate($excerpt['es'] ?? '');
                $post->setTranslation('excerpt', 'en', $translatedExcerpt);
            }

            $post->save();
        }

        $this->info('¡Todos los posts han sido traducidos!');
    }
}
