<?php

namespace App\Http\Controllers;

use App\Actions\LinkHashAction;
use App\Actions\LinkUpdateAction;
use App\Http\Requests\HashRequest;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    /**
     * @var LinkHashAction
     */
    private $hash_action;
    private $update_action;

    /**
     * LinkController constructor.
     * @param LinkHashAction $hasher
     */
    public function __construct(LinkHashAction $hash_action, LinkUpdateAction $update_action)
    {
        $this->hash_action = $hash_action;
        $this->update_action = $update_action;
    }

    /**
     * @param Response $response
     * @return Response
     */
    public function index(Response $response): Response
    {
        $response->setContent(Link::all());

        return $response;
    }

    /**
     * @param HashRequest $request
     * @param Response $response
     * @return Response
     */
    public function hash(HashRequest $request, Response $response): Response
    {
        $original_link = $request->get('link');
        $db_link = Link::where('original_link', $original_link)->first();
        if($db_link != null) {
            $response->setContent(['link' => url("/{$db_link->hash}")]);
            return $response;
        }
        $link = ($this->update_action)($original_link, ($this->hash_action)($original_link));
        $link->save();
        $response->setContent(['link' => url("/{$link->hash}")]);
        return $response;
    }

    /**
     * @param $hash
     * @return \Illuminate\Http\RedirectResponse | Response
     */
    public function redirect($hash, Response $response)
    {
        $url = Link::select('original_link')->where('hash', $hash)->first();
        if($url == null)
            return $response->setStatusCode(404);

        return redirect()->to($url->original_link);
    }
}
