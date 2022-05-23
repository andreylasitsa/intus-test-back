<?php


namespace App\Actions;


use App\Models\Link;

class LinkUpdateAction
{
    public function __invoke(string $original_link, string $hash, Link $link = null) {
        if($link == null)
            $link = new Link;

        $link->hash = $hash;
        $link->original_link = $original_link;
        return $link;
    }
}
