<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

final class HomeAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Use view renderer
        $renderer = new PhpRenderer(__DIR__ . '/../../templates/');

        // Render home html layout
        return $renderer->render($response, 'home.php', []);
    }
}