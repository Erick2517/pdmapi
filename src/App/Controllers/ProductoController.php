<?php
namespace App\Controllers;

use App\Models\Producto;
use App\Repositories\ProductoRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProductoController {
    private ProductoRepository $repo;

    public function __construct() {
        $this->repo = new ProductoRepository();
    }

    public function getAll(Request $request, Response $response): Response {
        $productos = $this->repo->getAll();
        $data = json_encode($productos);
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getByLocal(Request $request, Response $response, ): Response {
        $params = $request->getQueryParams();
        if(isset($params['local'])){
            $id_local = (int) $params['local'];
            $productos = $this->repo->getByLocal($id_local);
            $data = json_encode($productos);
            $response->getBody()->write($data);
            return $response->withHeader('Content-Type', 'application/json');
        }else{
            //aqui se podrian enviar todos pero de momento solo validamos que se tenga que especificar el local
            $data = json_encode(["error" => "El parametro local no se especificó"]);
            $response->getBody()->write($data);
            return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
        }
        
    }
}
