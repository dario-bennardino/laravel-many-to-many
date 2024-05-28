<?php

namespace App\Functions;

use Illuminate\Support\Str;


class Helper
{
    public static function generateSlug($string, $model)
    {
        /*
            1. ricevo la stringa da "sluggare"
            2. genero lo slug
            3. faccio una query per vedere se lo slug è già presente nel db
            4. se non è presente restituisco lo slug
            5. se è presente ne genero un altro con un valore incrementale e ad ogni generazione verifico che non sia prente
            6. una volta trovato uno slug non presento le restituisco
        */

        //2
        $slug = Str::slug($string, '-');
        $original_slug = $slug;

        //3
        $exixts = $model::where('slug', $slug)->first();
        $c = 1;

        while ($exixts) {
            $slug = $original_slug . '-' . $c;
            $exixts = $model::where('slug', $slug)->first();
            $c++;
        }

        return $slug;
    }
}
