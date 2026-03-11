<?php

namespace App\Traits;

use Spatie\Translatable\HasTranslations as SpatieHasTranslations;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log; // 👈 IMPORTAR LOG

trait Translatable
{
    use SpatieHasTranslations;

    public static function bootTranslatable()
    {
        static::created(function ($model) {
            try {
                $translator = new GoogleTranslate('en');
                $translator->setSource('es');

                foreach ($model->translatable as $field) {
                    // Obtener valor en español
                    $translations = $model->getTranslations($field);
                    $valueEs = $translations['es'] ?? '';

                    // Traducir si hay valor y no tiene inglés
                    if ($valueEs && !isset($translations['en'])) {
                        $translated = $translator->translate($valueEs);
                        $model->setTranslation($field, 'en', $translated);
                    }
                }
                $model->saveQuietly();
            } catch (\Exception $e) {
                // Log del error pero no detener la ejecución
                Log::error('Error en traducción automática: ' . $e->getMessage());
            }
        });
    }
}
