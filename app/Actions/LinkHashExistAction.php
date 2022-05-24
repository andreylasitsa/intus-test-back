<?php


namespace App\Actions;


use App\Models\Link;

class LinkHashExistAction
{
    /**
     * @param $hash
     * @return bool
     */
    public function __invoke($hash): bool
    {
        return (bool)Link::where('hash', $hash)->first();
    }
}
