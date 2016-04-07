<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Collection\Messages as Messages;

class MessageText extends Controller
{
  public function __invoke(Request $request, Response $response, $args)
  {
    $message = Messages::getRandomMessage();

    $this->view->render($response, 'message.txt', [
      'message' => $message
      ]);

    return $response;
  }
}
