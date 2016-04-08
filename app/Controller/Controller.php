<?php
/**
* Base Controller
*
* @author Chris Baptista
*/

namespace App\Controller;

use Slim\App;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Collection\Commits as Commits;

/**
* Base Controller
*
* @package App\Controller;
*/
class Controller {
  /**
   * Application
   * @var App $app
   */
  protected $app;

  /**
   * View
   * @var Twig $view
   */
  protected $view;

  /**
   * Logger
   * @var LoggerInterface $logger
   */
  protected $logger;

  /**
   * Class Constructor
   *
   * @param App $app
   * @param Twig $view
   * @param LoggerInterface $logger
   */
  public function __construct(App &$app, Twig $view, LoggerInterface $logger)
  {
    $this->app = $app;
    $this->view = $view;
    $this->logger = $logger;
  }

  /**
   * Invoke Function
   *
   * @param Request $request
   * @param Response $response
   * @param array $args
   *
   * @return Response
   */
  public function __invoke(Request $request, Response $response, array $args) {
    return $response;
  }
}
