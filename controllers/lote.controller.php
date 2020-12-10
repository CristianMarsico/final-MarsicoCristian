<?php
require_once 'models/lote.model.php';
require_once 'models/model.ciudad.php';
class LoteController
{

    private $model;
    private $ciudadModel;
    private $view;

    public function __construct()
    {
        $this->model = new LoteModel();
        $this->ciudadModel = new CiudadModel();
    }

    public function tabla()
    {
        $this->checkLogged();
        $ciudades = $this->modelCiudad->getAll();
        if ($ciudades) {
            foreach ($ciudades as $ciudad) {
                $lotes = $this->model->obtenerLotes($ciudad->id);
                if ($lotes) {
                    $cont = count($lotes);
                    $this->view->CiudadConCant($ciudad, $cont);

                    foreach ($lotes as $lote) {
                        $this->view->detallesLote($lote->nro_lote, $lote->anio_vencimiento);
                    }
                } else {
                    $this->view->shoeError("No hay lotes asociados");
                }
            }
        } else {
            $this->view->shoeError("No ciudades");
        }
    }
    public function agregar()
    {

        $this->checkLogged();

        //ESTOS DATOS LOS AGARRO DE UN FORM POR POST
        $numLote = 2; //EJ... $numLote = $_POST['numeroLote'];
        $añoVenc = 2;
        $ciudad = 3;
        $lab = 4;

        $existe = $this->ciudadModel->get($ciudad);

        if (!empty($numLote) && empty($añoVenc) && empty($ciudad) && empty($lab)) {
            if ($existe) {
                $esAsociado = $this->model->ciudadYLabAsociado($numLote);
                if ($esAsociado) {
                    $temp = $this->model->cumpleTemperatura($ciudad);
                    if ($temp) {
                        $this->model->agregarLote($numLote, $añoVenc, $ciudad, $lab);
                    } else {
                        $this->view->showError("la temperatura no es la indicada");
                    }
                } else {
                    $this->view->showError("No se encuentra asociado");
                }
            } else {
                $this->view->showError("No existe esa ciudad");
            }
        } else {
            $this->view->showError("faltan datos");
        }
    }



    private function checkLogged()
    {
        session_start();
        if (!isset($_SESSION['ID'])) {
            header('Location' . 'login');
            die();
        }
    }
}
