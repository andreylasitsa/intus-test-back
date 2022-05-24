<?php


namespace App\Actions;


class LinkHashAction
{
    /**
     * @param $original_link
     * @return false|string
     */
    public function __invoke($original_link): string
    {
        return substr(md5($original_link), 0, 6);
    }
}
