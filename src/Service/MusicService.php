<?php

namespace App\Service;

class MusicService
{
    public function checkFields(array $music): array
    {
        $errors = [];
        if (strlen($music['title']) > 100) {
            $errors['title'] = 'Le titre ne doit pas dépasser 100 caractères.';
        }
        if (strlen($music['author']) > 80) {
            $errors['author'] = 'Le nom de l\'auteur ne doit pas dépasser 80 caractères.';
        }
        if (!filter_var($music['source'], FILTER_VALIDATE_URL)) {
            $errors['source'] = 'Veuillez entrer une source valide.';
        }
        if (!filter_var($music['music_image'], FILTER_VALIDATE_URL)) {
            $errors['music_image'] = 'Veuillez entrer un lien d\'image valide.';
        }
        return $errors;
    }
}
