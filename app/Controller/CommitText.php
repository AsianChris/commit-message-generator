<?php
namespace App\Controller;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Collection\Commits as Commits;

class CommitText extends Controller
{
    public function __invoke(Request $request, Response $response, $args)
    {
        $commit = Commits::getRandomCommit();

        $this->view->render($response, 'commit.txt', [
          'commit' => $commit
          ]);
        return $response;
    }
}
