<?php
namespace App\Controller;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Collection\Commits as Commits;

class Controller
{
  protected $app;
  protected $view;
  protected $logger;

  public function __construct(&$app, Twig $view, LoggerInterface $logger)
  {
    $this->app = $app;
    $this->view = $view;
    $this->logger = $logger;
  }

  public function __invoke(Request $request, Response $response, $args) {}
}
