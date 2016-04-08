<?php
/**
* Home Page
*
* @author Chris Baptista
*/

namespace App\Controller;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Collection\Messages as Messages;

/**
* Home Page Controller
*
* @package App\Controller;
*/
class HomePage extends Controller {
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

    $this->view->render($response, 'message.html', [
      'message' => $message
      ]);

    return $response;
  }
}
