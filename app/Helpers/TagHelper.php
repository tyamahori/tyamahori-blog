<?php

namespace App\Helpers;

class TagHelper
{
    /**
     * Validation エラー時に選択されていたTagを整形する関数
     *
     * @param $currentTags
     * @return array
     */
    public static function trimSelectedTags($currentTags): array
    {
        $selectedTags = [];
        if ($currentTags === null) {
            $currentTags = [];
        }

        foreach ($currentTags as $tag) {
            $selectedTags[] = $tag;
        }

        return $selectedTags;
    }
}
