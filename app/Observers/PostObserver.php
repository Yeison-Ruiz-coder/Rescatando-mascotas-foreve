<?php

namespace App\Observers;

use App\Models\Post;
use Stichoza\GoogleTranslate\GoogleTranslate;

class PostObserver
{
    public function created(Post $post)
    {
        // Traducir automáticamente a inglés cuando se crea
        $translator = new GoogleTranslate('en');
        $translator->setSource('es');

        // Obtener valores en español
        $titleEs = $post->getTranslations('title')['es'] ?? '';
        $contentEs = $post->getTranslations('content')['es'] ?? '';
        $excerptEs = $post->getTranslations('excerpt')['es'] ?? '';

        // Traducir y guardar en inglés
        if ($titleEs) {
            $post->setTranslation('title', 'en', $translator->translate($titleEs));
        }
        if ($contentEs) {
            $post->setTranslation('content', 'en', $translator->translate($contentEs));
        }
        if ($excerptEs) {
            $post->setTranslation('excerpt', 'en', $translator->translate($excerptEs));
        }

        $post->save(); // Simplemente guarda
    }
}
