<?php

class logclienteModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function consultarLog() {
        $log = $this->_db->query("SELECT 
    }

    public function consultarLogc($condicion='1') {
        $log = $this->_db->query("SELECT 
        if ($log)
    }

    public function crearLog($datos) {
            $this->_db->prepare("INSERT INTO lcl 
                    ->execute(
                                ':lcl_observacion' => $datos['lcl_observacion'],
                            ));
    }

    public function actulizarlog($key, $datos) {
        $this->_db->prepare("UPDATE lcl SET lcl_observacion=:lcl_observacion, 
                ->execute(
                        array(
                            ':lcl_observacion' => $datos['lcl_observacion'],
                        )
        );
    }

}

?>