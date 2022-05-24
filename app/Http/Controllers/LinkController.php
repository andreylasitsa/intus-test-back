<?php

namespace App\Http\Controllers;

use App\Actions\LinkGenerateAction;
use App\Http\Requests\LinkRequest;
use App\Models\Link;
use Illuminate\Http\Response;

class LinkController extends Controller
{
    /**
     * @var LinkGenerateAction
     */
    private $link_generator;

    /**
     * LinkController constructor.
     * @param LinkGenerateAction $link_generator
     */
    public function __construct(LinkGenerateAction $link_generator)
    {
        $this->link_generator = $link_generator;
    }

    /**
     * @param Response $response
     * @return Response
     */
    public function index(Response $response): Response
    {
        return $response->setContent(Link::all());
    }

    /**
     * @param LinkRequest $request
     * @param Response $response
     * @return Response
     */
    public function hash(LinkRequest $request, Response $response): Response
    {
        $original_link = $request->get('link');

        return $response->setContent(($this->link_generator)($original_link));
    }

    /**
     * @param string $hash
     * @param Response $response
     * @return \Illuminate\Http\RedirectResponse | Response
     */
    public function redirect(string $hash, Response $response)
    {
        $url = Link::select('original_link')->where('hash', $hash)->first();
        if ($url == null)
            return $response->setStatusCode(404);

        return redirect()->to($url->original_link);
    }
}
