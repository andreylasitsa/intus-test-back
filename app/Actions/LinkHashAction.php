<?php


namespace App\Actions;


class LinkHashAction
{
    public function __invoke($original_link) {
        // TODO: hash link
        return substr($original_link, 0, 6);
    }
}
