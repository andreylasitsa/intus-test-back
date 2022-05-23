<?php


namespace App\Actions;


class LinkHashAction
{
    public function __invoke($original_link)
    {
        return substr(md5($original_link), 0, 6);
    }
}
