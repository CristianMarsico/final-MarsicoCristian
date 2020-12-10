<?php
require_once 'api/api.view.php';


class MunicipioApiController {

    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->view = new ApiView();
        //$this->model = new CentroModel;  NO PIDEN USARLO
        $this->data = file_get_contents("php://input");
        
    }

    public function getdata(){
        return json_decode($this->data);
    }

    public function getCentros($params = []){
        $tipo = $params[':TIPO'];
        $centros = $this->centroModel-> get($tipo);
        if($centros){
            $this->view->response($centros, 200);
        }else{
            $this->view->response("No existen centros", 404);
        }
    }

    public function getLotesDisponibles($params = []){
        $disponible = $params [':DISPONIBLE'];
        $lotes = $this->model->obtenerDisp($disponible);
        if($lotes){
            $this->view->response($lotes, 200);
        } else {
            $this->view->response("no hay lotes disponibles", 404);
        }
    }
}