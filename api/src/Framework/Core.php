<?php

namespace SignupFormTest\Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use SignupFormTest\Framework\Output\OutputResponse;
use SignupFormTest\Framework\Output\OutputProtector;
use SignupFormTest\Framework\Output\Exception\UnauthorizedException;
use SignupFormTest\Framework\DatabaseConnection\DatabaseConnection;
use SignupFormTest\Framework\DatabaseConnection\PsqlDatabase;
use SignupFormTest\Framework\Configuration;

class Core
{
    /**
     * @var RouteCollection
     */
    protected $routes;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $psql;

    public function __construct()
    {
        $this->routes = new RouteCollection();

        $psql = new DatabaseConnection(new PsqlDatabase());
        $this->psql = $psql->connect(Configuration::get('db.psql'));
    }

    /**
     * Handle the request
     * @param Request $request Request object
     * @return Response
     */
    public function handle(Request $request)
    {
        $context = new RequestContext();
        $context->fromRequest($request);
        
        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $attributes = $matcher->match($request->getPathInfo());
            $controller = $attributes['controller'];
            
            $className = $controller[0];
            $method = $controller[1];

            // Check protection
            if ($attributes['protect']) {
                OutputProtector::check($request);
            }

            unset($attributes['protect'], $attributes['_route'], $attributes['controller']);

            $class = new $className;
            $response = call_user_func_array(array($class, $method), $attributes);
        } catch (ResourceNotFoundException $e) {
            $response = OutputResponse::send('Not found!', Response::HTTP_NOT_FOUND);
        } catch (MethodNotAllowedException $e) {
            $response = OutputResponse::send('Method not allowed!', Response::HTTP_METHOD_NOT_ALLOWED);
        }

        return $response;
    }

    /**
     * Create Route Map
     * @param string $method Http method
     * @param string $name Route identifier
     * @param string $path Url path
     * @param array $controller Controller and action to call
     * @return void
     */
    public function map($method, $name, $path, $controller, $protect = false)
    {
        if (!is_array($method)) {
            $method = array($method);
        }
        $route = new Route($path, array('controller' => $controller, 'protect' => $protect));
        $route->setMethods($method);

        $this->routes->add($name, $route);
    }
}
