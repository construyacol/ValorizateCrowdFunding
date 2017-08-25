<?php

class rolController extends Controller {

    private $_rol;
    private $_permisos;

    public function __construct() {
        parent::__construct();
        $this->_rol = $this->loadModel('rol', 'admin');
        $this->_permisos = $this->loadModel('permiso', 'admin');
    }

    public function index($pagina = false) {
        $this->_acl->acceso('ver_rol');
        $this->getLibrary('paginador/paginador');
        $paginador = new Paginador();
        $this->_view->setJs(array('ajax'));
        $this->_view->assign('titulo', 'Administracion de Roles');
        $this->_view->assign('datos', $paginador->paginar($this->_rol->consultarRoles(), $pagina));
        $this->_view->assign('paginacion', $paginador->getView('paginas', 'admin/rol/index'));
        $this->_view->renderizar('index','rol');
    }

    public function nuevo() {
        $this->_acl->acceso('crear_rol');        $this->_view->assign('titulo', 'Registrar Rol');
        if ($this->getInt('guardar') == 1) {            $this->_view->assign('datos', $_POST);
            $datos = array(                'rol_nombre' => $this->getTexto('nombre')            );
            $this->_rol->crearRol($datos);            $this->redireccionar('admin/rol');			//$this->_view->renderizar('index');        }
        $this->_view->renderizar('nuevo');    }

    public function editar($id=false) {					
        $this->_acl->acceso('modificar_rol');		$this->_view->assign('titulo', 'Actualizar Rol');        		if(isset($_POST['key']))		$id=$_POST['key'];				$condicion = "rol.rol_key='{$id}'";        $rol = $this->_rol->consultarRol($condicion);        $this->_view->assign('datos', $rol[0]);        $this->_view->setJsPlugin(array('jquery.validate'));        $this->_view->setJs(array('validar'));
        if ($this->getInt('guardar') == 1) {
            $datos = array(                'rol_nombre' => $this->getTexto('nombre')				);            $this->_rol->actulizarRol($id, $datos);
            $this->redireccionar('admin/rol');        }        $this->_view->renderizar('editar');    }
    public function detalles($id) {        $this->_acl->acceso('ver_rol');        $this->_view->assign('titulo', 'Administracion de Roles');        $condicion = "rol.rol_key={$id}";        $rol = $this->_rol->consultarRol($condicion);        $this->_view->assign('datos', $rol[0]);        $condicion = "pxr.rol_key={$rol[0]['rol_key']}";		           $this->_view->assign('permisos', $this->_permisos->consultarPermisosAsignados($condicion));		$permisos =$this->_permisos->consultarPermisosAsignados($condicion);				$modulo=array();				for ($i = 0 ;$i < count($permisos);$i++)			{			$add= $permisos[$i]['per_modulo'];			array_push($modulo,$add);						}		$modulo=array_unique($modulo);				$datos=array();					foreach ($modulo as $mod)			{			$modulo2=array();					for ($i=0;$i<count($permisos);$i++)					{				//	echo "if (".$mod." == ".$permisos[$i]['per_modulo'].")<br>";						if ($mod == $permisos[$i]['per_modulo'])						{							$add1 = array (												'permiso'=>$permisos[$i]['per_nombre']												);						array_push($modulo2,$add1);									}													}				$add=array(						'modulo'=>$mod,						'permisos'=>$modulo2,				);			array_push($datos,$add);			}		/*echo "<pre>";		print_r($datos);		echo "</pre>";*/		$this->_view->assign('datos1', $datos);								        $this->_view->renderizar('detalles');    }    public function detalles2($id) {        $this->_acl->acceso('ver_rol');        		$this->_view->assign('titulo', 'Administracion de Roles');        $condicion = "rol.rol_key={$id}";        		$rol = $this->_rol->consultarRol($condicion);        $this->_view->assign('datos', $rol[0]);        print_r($rol);		$condicion = " rxp.rol_key={$rol[0]['rol_key']}";		$permisos =$this->_permisos->consultarPermisosAsignados($condicion);		print_r($permisos);exit;		$modulo=array();				for ($i = 0 ;$i < count($permisos);$i++)			{			$add= $permisos[$i]['per_modulo'];			array_push($modulo,$add);						}		$modulo=array_unique($modulo);		echo "<pre>";		print_r($modulo);		echo "</pre>";		exit;		$datos=array();					foreach ($modulo as $mod)			{			$modulo2=array();					for ($i=0;$i<count($permisos);$i++)					{				//	echo "if (".$mod." == ".$permisos[$i]['per_modulo'].")<br>";						if ($mod == $permisos[$i]['per_modulo'])						{							$add1 = array (												'permiso'=>$permisos[$i]['per_nombre']												);						array_push($modulo2,$add1);									}													}				$add=array(						'modulo'=>$mod,						'permisos'=>$modulo2,				);			array_push($datos,$add);			}		/*echo "<pre>";		print_r($datos);		echo "</pre>";*/		$this->_view->assign('datos1', $datos);        //$this->_view->assign('permisos', $permisos);		$this->_view->renderizar('detalles2');    }
    public function eliminar($id) {
        $this->_acl->acceso('eliminar_rol');
        $this->_view->assign('titulo', 'Eliminar Rol');
        $this->_rol->eliminarRol($id);
        $this->redireccionar('admin/rol');
    }

    public function asignarPermisos($id) {
        $this->_acl->acceso('asignar_permisos');
        $this->_view->assign('titulo', 'Asignar Permisos al Rol');
        $condicion = "rol.rol_key='{$id}'";
        $roles = $this->_rol->consultarRol($condicion);
        $this->_view->assign('datos', $roles[0]);
        $condicion = "pxr.rol_key='{$id}'";
        $permisosAsignados = $this->_permisos->consultarPermisosAsignados($condicion);
        $condicion='1';
        if ($permisosAsignados) {
            $temp = "";
            foreach ($permisosAsignados as $value) {
                $temp.= $value['per_key'] . ",";
            }
            $temp = trim($temp, ",");
            $condicion = "per_key NOT IN ({$temp})";
        }
        $this->_view->assign('permisos', $this->_permisos->consultarPermiso($condicion));

        $this->_view->setJsPlugin(array('jquery.validate'));
        $this->_view->setJs(array('nuevo'));

        if ($this->getInt('guardar') == 1) {
            $this->_view->assign('datos', $_POST);
            $datos = array();
            for ($i = 1; $i <= $this->getInt('totalPermisos'); $i++) {
                if ($this->getTexto('permiso' . $i)) {
                    $datos[] = array(
                        'rol_key' => $id,
                        'per_key' => $this->getTexto('permiso' . $i)
                    );
                };
            }
            $this->_permisos->asignarPermiso($datos);
            $this->redireccionar("admin/rol/detalles/{$id}");
        }

        $this->_view->renderizar('asignarPermisos', 'rol');
    }

    public function revocarPermiso($id) {
        $this->_acl->acceso('revocar_permisos');
        $this->_view->assign('titulo', 'Revocar Permisos');
        $condicion = "rol.rol_key={$id}";
        $rol = $this->_rol->consultarRol($condicion);
        $this->_view->assign('datos', $rol[0]);
        $condicion = "pxr.rol_key={$rol[0]['rol_key']}";
        $this->_view->assign('permisos', $this->_permisos->consultarPermisosAsignados($condicion));

        if ($this->getInt('guardar') == 1) {
            $revocar = "";
            for ($i = 1; $i <= $this->getInt('totalPermisos'); $i++) {
                if ($this->getTexto('permiso' . $i)) {
                    $revocar.="'" . $this->getTexto('permiso' . $i) . "',";
                };
            }
            $revocar = trim($revocar, ",");
            $this->_permisos->revocarPermiso($revocar);
            $this->redireccionar("admin/rol/detalles/{$id}");
        }

        $this->_view->renderizar('revocarPermisos', 'rol');
    }

    public function consultaAjax() {
        if ($this->getTexto('valor')) {
            $condicion = "(UPPER(rol.rol_nombre) like UPPER('%{$this->getTexto('valor')}%')) AND rol.rol_estado!='0'";
            echo json_encode($this->_rol->consultarRol($condicion));
        }
    }

}

?>