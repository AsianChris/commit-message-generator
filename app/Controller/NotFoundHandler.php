<?php
/**
* Not Found Handler
*
* @author Chris Baptista
*/

namespace App\Controller;

use Slim\Handlers\NotFound;
use Slim\Views\Twig;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
* Not Found Handler Controller
*
* @package App\Controller;
*/
class NotFoundHandler extends NotFound {

    /**
     * View
     * @var Twig $view
     */
    private $view;

    /**
     * Class Constructor
     *
     * @param Twig $view
     */
    public function __construct(Twig $view) {
        $this->view = $view;
    }

    /**
     * Invoke Function
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response) {
        parent::__invoke($request, $response);

        $this->view->render($response, '404.html');

        return $response->withStatus(404);
    }

}
