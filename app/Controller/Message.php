<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Slim\Exception\NotFoundException;

use App\Collection\Messages as Messages;

class Message extends Controller
{
  public function __invoke(Request $request, Response $response, $args)
  {
    $message = Messages::getMessage($args['hash']);

    if($message === null) {
      $this->logger->error("Message not found: " . $args['hash']);
      throw new NotFoundException($request, $response);
    }

    $this->view->render($response, 'message.html', [
      'message' => $message
      ]);

    return $response;
  }
}
