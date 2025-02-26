<?php 
    
    namespace App\Infrastructure\Routing;

    use App\Infrastructure\Routing\Request;
    
    class Router {
        private array $routes = [];
    
        // Este método agrega las rutas a la propiedad routes
        public function addRoute(string $method, string $path, array|callable $action) {
            $this->routes[$method][$path] = $action;
            return $this;
        }
    
        // Este método despacha las solicitudes
        public function dispatch(Request $request) {
            $method = $request->getMethod();
            $path = $request->getPath();
    
            if (isset($this->routes[$method][$path])) {
                $action = $this->routes[$method][$path];
    
                // Verificamos si la acción es un array (controlador y método)
                if (is_array($action)) {
                    // Si es un array, el primer valor debe ser el controlador y el segundo el método
                    list($controller, $method) = $action;
    
                    // Instanciamos el controlador
                    $controllerInstance = new $controller();
    
                    // Verificamos si el método existe en el controlador
                    if (method_exists($controllerInstance, $method)) {
                        // Llamamos al método
                        call_user_func([$controllerInstance, $method]);
                    } else {
                        // Si el método no existe en el controlador, devolvemos error
                        http_response_code(404);
                        echo "Method not found";
                    }
                } elseif (is_callable($action)) {
                    // Si la acción es directamente una función, la llamamos
                    call_user_func($action);
                }
            } else {
                // Si la ruta no existe, devolvemos error
                http_response_code(404);
                echo "Route not found";
            }
        }
    }
    