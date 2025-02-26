<?php

namespace App\Infrastructure\Routing;

class Response
{
    private $content;
    private $statusCode;
    private $headers;

    public function __construct($content = '', $statusCode = 200, $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public static function html($view, $data = [])
    {
        ob_start();
        extract($data);
        include __DIR__ . "/../../views/{$view}.php";  
        $content = ob_get_clean();
        
        return new static($content);
    }
    
    public function send()
    {
        foreach ($this->headers as $header) {
            header($header);
        }

        // Establecer el código de estado
        http_response_code($this->statusCode);

        // Enviar el contenido de la respuesta
        echo $this->content;
        exit;
    }
}
