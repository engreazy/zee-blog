<?php
/**
 * This class checks the url/variable
 * and calls the appropriate controller accordingly
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 7:54 AM
 */
namespace Controllers;
class ZeeRouter
{
    private $route;
    private $method;
    private $routes;

    /**
     * ZeeRouter constructor.
     * @param $route
     * @param $method
     * @param ZeeRoutes $routes
     */
    public function __construct($route, $method, ZeeRoutes $routes)
    {
        $this->route = $route;
        $this->method = $method;
        $this->routes = $routes;
        $this->checkUrl();
    }

    /**
     *checks if the url user is in lowercase
     * converts user's url to lowercase and redirects user to appropriate page
     */
    private function checkUrl()
    {
        if($this->route !== strtolower($this->route))
        {
            http_response_code(301);
            header('location:'.strtolower($this->route));
        }
    }

    /**
     * render's the view the user for user interactions
     * @param $viewFileName
     * @param array $variables
     * @return string
     */
    private function renderView($viewFileName, $variables = [])
    {
        extract($variables);
        ob_start();
        /** @noinspection PhpIncludeInspection */
        include __DIR__.'/../Views/'.$viewFileName;
        return ob_get_clean();
    }

    /**
     *calls the appropriate route controller action
     */
    public function run()
    {
        $routes = $this->routes->getRoutes();
        $authenticator = $this->routes->getAuthenticator();
        //checks if the current page request requires a user to be logged in
        if (isset($routes[$this->route]['login'])  && !$authenticator->checkAccess()){
            header('location:?route=login/error');
        }elseif (isset($routes[$this->route]['permissions']) && !$this->routes->checkPermission($routes[$this->route]['permissions'])){
            header('location:?route=login/error');
        }else{
        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];
        $page = $controller->$action();
        $title = $page['title'];
        $output = isset($page['variables'])?$this->renderView($page['template'],$page['variables']):$this->renderView($page['template']);

        echo $this->renderView('layout.html.php',['output'=>$output,'title'=>$title]);
        }
    }
}