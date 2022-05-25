<?php

namespace App\Actions;

use App\Models\Link;

class LinkGenerateAction
{
    /**
     * @var LinkHashAction
     */
    private $hash_action;
    /**
     * @var LinkUpdateAction
     */
    private $update_action;
    /**
     * @var LinkHashExistAction
     */
    private $hash_exist_action;
    /**
     * @var LinkCheckerAction
     */
    private $checker_action;

    /**
     * LinkController constructor.
     * @param LinkHashAction $hash_action
     * @param LinkUpdateAction $update_action
     * @param LinkHashExistAction $hash_exist_action
     * @param LinkCheckerAction $checker_action
     */
    public function __construct(LinkHashAction $hash_action, LinkUpdateAction $update_action, LinkHashExistAction $hash_exist_action, LinkCheckerAction $checker_action)
    {
        $this->hash_action = $hash_action;
        $this->update_action = $update_action;
        $this->hash_exist_action = $hash_exist_action;
        $this->checker_action = $checker_action;
    }

    /**
     * @param string $original_link
     * @return array|string[]
     */
    public function __invoke(string $original_link): array
    {
        $link = Link::where('original_link', $original_link)->first();
        if ($link != null) {
            return ['link' => url("/{$link->hash}")];
        }

        if(!($this->checker_action)($original_link))
            abort(422);

        $hash = ($this->hash_action)($original_link);

        if (($this->hash_exist_action)($hash)) {
            abort(500);
        }

        $link = ($this->update_action)($original_link, $hash);
        $link->save();

        return ['link' => url("/{$link->hash}")];
    }
}
