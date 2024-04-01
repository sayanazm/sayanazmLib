<?php

namespace Core;

class App
{
    private array $routes = [];
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function get(string $routeName, string $className, string $method, string $requestClass = Request::class): void
    {
        $this->routes[$routeName]['GET'] = [
            'class' => $className,
            'method' => $method,
            'requestClass' => $requestClass
        ];

    }

    public function post(string $routeName, string $className, string $method, string $requestClass = Request::class): void
    {
        $this->routes[$routeName]['POST'] = [
            'class' => $className,
            'method' => $method,
            'requestClass' => $requestClass
        ];

    }

    public function run(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];

        try {
            if (isset($this->routes[$requestUri])) {
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $routeMethod = $this->routes[$requestUri];

                if (isset($routeMethod[$requestMethod])) {
                    $handler = $routeMethod[$requestMethod];

                    $class = $handler['class'];
                    $method = $handler['method'];
                    $requestClass = $handler['requestClass'];

                    $obj = $this->container->get($class);

                    $request = new $requestClass($method, $requestUri, headers_list(), $_POST);
                    $obj->$method($request);

                } else {
                    echo "Метод $requestMethod не поддерживается для $requestUri";
                }
            } else {
                require_once './../View/not_found.html';
            }
        } catch (\Throwable $exception) {

            $logger = $this->container->get(LoggerInterface::class);

            $data = [
                'message' => 'message: ' . $exception->getMessage(),
                'file' => 'file: ' . $exception->getFile(),
                'line' => 'line: ' . $exception->getLine(),
            ];

            $logger->error('The server cannot process the request: ', $data);

            require_once '../View/500.html';
        }

    }

}