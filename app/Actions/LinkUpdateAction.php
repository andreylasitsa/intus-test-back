<?php


namespace App\Actions;


use App\Models\Link;

class LinkUpdateAction
{
    /**
     * @param string $original_link
     * @param string $hash
     * @param Link|null $link
     * @return Link|null
     */
    public function __invoke(string $original_link, string $hash, Link $link = null): ?Link
    {
        if ($link == null)
            $link = new Link;

        $link->hash = $hash;
        $link->original_link = $original_link;

        return $link;
    }
}
