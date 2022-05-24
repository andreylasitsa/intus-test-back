<?php


namespace App\Actions;


use App\Models\Link;

class LinkHashExistAction
{
    public function __invoke($hash): bool {
        $link = Link::where('hash', $hash)->first();
        return (bool)$link;
    }
}
