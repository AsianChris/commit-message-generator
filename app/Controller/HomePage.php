<?php
namespace App\Controller;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Collection\Messages as Messages;

class HomePage extends Controller
{
  public function __invoke(Request $request, Response $response, $args)
  {
    $message = Messages::getRandomMessage();

    $this->view->render($response, 'message.html', [
      'message' => $message
      ]);

    return $response;
  }
}
