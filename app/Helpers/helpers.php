<?php

use Illuminate\Support\Str;
use App\Models\Comic;

if (!function_exists('generateSlug')) {
    function generateSlug($title, $separator = '-')
    {
        $slug = Str::slug($title, $separator);
        $original_slug = $slug;
        $counter = 1;

        while (Comic::where('slug', $slug)->exists()) {
            $slug = $original_slug . $separator . $counter;
            $counter++;
        }

        return $slug;
    }
}
