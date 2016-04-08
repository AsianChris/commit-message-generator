<?php
/**
* Message Text
*
* @author Chris Baptista
*/

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Collection\Messages as Messages;

/**
* Message Text Controller
*
* @package App\Controller;
*/
class MessageText extends Controller {
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
    $message = Messages::getRandomMessage();

    $this->view->render($response, 'message.txt', [
      'message' => $message
      ]);

    return $response;
  }
}
