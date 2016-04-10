<?php
/**
* Message
*
* @author Chris Baptista
*/

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Slim\Exception\NotFoundException;

use App\Collection\Messages as Messages;

/**
* Message Controller
*
* @package App\Controller;
*/
class Message extends Controller {
  /**
   * Invoke Function
   *
   * @param Request $request
   * @param Response $response
   * @param array $args
   *
   * @return Response
   */
  public function __invoke(Request $request, Response $response, array $args)
  {
    $message = Messages::getMessage($args['hash']);

    if($message === null) {
      $this->logger->error("Message not found: " . $args['hash']);
      throw new NotFoundException($request, $response);
    }

    $this->view->render($response, 'message.html', [
      'inProduction' => $this->inProduction,
      'message' => $message
      ]);

    return $response;
  }
}
