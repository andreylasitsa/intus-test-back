<?php

namespace App\Http\Controllers;

use App\Actions\LinkHashAction;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LinkController extends Controller
{
    private $hasher;

    public function __construct(LinkHashAction $hasher) {
        $this->hasher = $hasher;
    }

    public function index(Response $response): Response {
        $response->setContent(Link::all());
        return $response;
    }

    public function hash(Request $request, Response $response): Response {
        $link = new Link();
        $link->original_link = $request->get('link');
        $link->hash = ($this->hasher)($link->original_link);
        $link->save();
        $response->setContent(['link' => $link->hash]);
        return $response;
    }

    public function redirect($hash) {
        $link = Link::select('original_link')->where('hash', $hash)->get();
        // TODO: redirect full path
        return redirect()->away($link->get(0)->original_link);
    }
}
