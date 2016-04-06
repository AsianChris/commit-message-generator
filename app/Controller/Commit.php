<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Slim\Exception\NotFoundException;

use App\Collection\Commits as Commits;

class Commit extends Controller
{
  public function __invoke(Request $request, Response $response, $args)
  {
    $commit = Commits::getCommit($args['hash']);

    if($commit === null) {
        throw new NotFoundException($request, $response);
    }

    $this->view->render($response, 'commit.html', [
      'commit' => $commit
      ]);

    return $response;
  }
}
