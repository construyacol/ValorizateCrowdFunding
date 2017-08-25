<?phpclass usuarioController extends Controller {    private $_rol;    private $_usuario;    private $_tdocumento;    private $_departamento;    private $_ciudad;    public function __construct() {        parent::__construct();        $this->_rol = $this->loadModel('rol', 'admin');        $this->_usuario = $this->loadModel('usuario', 'admin');        $this->_genero = $this->loadModel('genero', 'admin');        $this->_tdocumento = $this->loadModel('tdocumento', 'admin');        $this->_departamento = $this->loadModel('departamento', 'admin');        $this->_ciudad = $this->loadModel('ciudad', 'admin');    }        public function index(){    }    public function login()    {            $condicion = "usu.usu_login='{$this->getTexto('usuario')}'";             $row = $this->_usuario->consultar($condicion);            $comprobar = 0;            foreach ($row as $nombre) {                if ($nombre['usu_password'] == Hash::getHash('sha1', $this->getTexto('pass'), $nombre['usu_key'])) {                    $comprobar = 1;                    break;                }            }            if ($comprobar != 1) {                $data=array("message"=>"error",                            "data"=>0,                            "body"=>"Usuario y/o password incorrectos",                            "tam"=>0 );               echo json_encode($data);               exit;            }            if ($nombre['usu_estado'] != 1) {               $data=array("message"=>"error",                           "data"=>0,                           "body"=>"Este usuario no esta habilitado",                           "tam"=>0,);               echo json_encode($data);               exit;            }            $data=array("message"=>"success",                        "data"=>$row,                        "body"=>"Bienvenido!",                        "tam"=>count($row));                        echo json_encode($data);            exit;            }    public function registrar(){    	$nombre = $this->getTexto('nombre');    	$email = $this->getTexto('email');    	$pass = $this->getTexto('pass');    	    	//validar email    	 $condicion = "usu.usu_email='{$this->getTexto('email')}'";          $row = $this->_usuario->consultar($condicion);         if (count($row)>0) {         	$data=array("message"=>"error",                        "data"=>"",                        "body"=>"Tu email ya esta en nuestros datos!.",                        "tam"=>"");         }         else         {         	if($nombre=="")         	{         		$data=array("message"=>"error",                        "data"=>"",                        "body"=>"El usuario no a podido ser creado",                        "tam"=>"");         		echo json_encode($data);         		exit;         	}         	if($email=="")         	{         		$data=array("message"=>"error",                        "data"=>"",                        "body"=>"El usuario no a podido ser creado",                        "tam"=>"");         		echo json_encode($data);         		exit;         	}         	         	if($pass=="")         	{         		$data=array("message"=>"error",                        "data"=>"",                        "body"=>"El usuario no a podido ser creado",                        "tam"=>"");         		echo json_encode($data);         		exit;         	}         	         	$datos = array(                'tdo_key' => 1,                'usu_num_documento' => "0",                'rol_key' => 2,                'usu_nombre' => $this->getTexto('nombre'),                'usu_apellidos' => $this->getTexto('nombre'),                'usu_login' => $this->getTexto('email'),                'usu_observaciones' => "",                'usu_foto' => "",                'usu_email' => $this->getTexto('email'),                'usu_tarjeta' => "",                'usu_mes_ven' => "",                'usu_ano_ven' => "",                'usu_codigo' => ""            );            $key = $this->_usuario->crear($datos);            $pass = $this->getTexto('pass');            if ($key['usu_key']) {                $this->_usuario->actualizarPassword(Hash::getHash('sha1', $pass, $key['usu_key']), $key['usu_key']);            }            if($key){            	$data=array("message"=>"success",                        "data"=>"",                        "body"=>"Usuario Creado!.",                        "tam"=>"");            }            else            {            	$data=array("message"=>"error",                        "data"=>"",                        "body"=>"El usuario no a podido ser creado",                        "tam"=>"");            }	         }         echo json_encode($data);         exit;    		    }    public function crear(){                $id = $this->getTexto('id');        $nombre = $this->getTexto('nombre');        $email = $this->getTexto('email');        $pass = $this->getTexto('pass');        $img = $this->getTexto('img');        $ubi = $this->getTexto('ubi');        $tarjeta=$this->getTexto('tarjeta');        $tarjetames=$this->getTexto('mes');        $tarjetaano=$this->getTexto('ano');        $tarjetacodigo=$this->getTexto('cod');                //validar email         $condicion = "usu.usu_email='{$this->getTexto('email')}'";          $row = $this->_usuario->consultar($condicion);         if (count($row)>0) {            $data=array("message"=>"error",                        "data"=>"",                        "body"=>"Tu email ya esta en nuestros datos!.",                        "tam"=>"");         }         else         {            if($nombre=="")            {                $data=array("message"=>"error",                        "data"=>"",                        "body"=>"1.El usuario no a podido ser creado",                        "tam"=>"");                echo json_encode($data);                exit;            }            if($email=="")            {                $data=array("message"=>"error",                        "data"=>"",                        "body"=>"2.El usuario no a podido ser creado",                        "tam"=>"");                echo json_encode($data);                exit;            }                        if($pass=="")            {                $data=array("message"=>"error",                        "data"=>"",                        "body"=>"3.El usuario no a podido ser creado",                        "tam"=>"");                echo json_encode($data);                exit;            }                                                $datos = array(                'usu_key' =>$id,                'tdo_key' => 1,                'usu_num_documento' => "0",                'rol_key' => 2,                'usu_nombre' => $this->getTexto('nombre'),                'usu_apellidos' => $this->getTexto('nombre'),                'usu_login' => $this->getTexto('email'),                'usu_observaciones' => $ubi,                'usu_foto' => $img,                'usu_email' => $this->getTexto('email'),                'usu_tarjeta' => $tarjeta,                'usu_mes_ven' => $tarjetames,                'usu_ano_ven' => $tarjetaano,                'usu_codigo'  => $tarjetacodigo,                'usu_estado'  => 1            );                       $key = $this->_usuario->crear($datos);            $pass = $this->getTexto('pass');            if ($key['usu_key']) {                $this->_usuario->actualizarPassword(Hash::getHash('sha1', $pass, $key['usu_key']), $key['usu_key']);            }            if($key){                $data=array("message"=>"success",                        "data"=>"",                        "body"=>"Usuario Creado!.",                        "tam"=>"");            }            else            {                $data=array("message"=>"error",                        "data"=>"",                        "body"=>"4.El usuario no a podido ser creado",                        "tam"=>"");            }             }         echo json_encode($data);         exit;    }    public function listausuario(){        $condicion = "usu_estado!=0";        $usuarios = $this->_usuario->consultar($condicion);        $url='public/img/usuario/perfil/';        for ($i=0; $i <count($usuarios) ; $i++) {             //nombre de la imagen            $usuarios[$i]['usu_foto2']=$usuarios[$i]['usu_foto'];            $url=$url.$usuarios[$i]['usu_key']."/";                        $usuarios[$i]['usu_foto']=$url.$usuarios[$i]['usu_foto'];            $url='public/img/usuario/perfil/';        }        if (count($usuarios)>0) {            $data=array("message"=>"success",                    "data"=>$usuarios,                    "body"=>"",                    "tam"=>count($usuarios));        }        else        {            $data=array("message"=>"errror",                    "data"=>"",                    "body"=>"No existen datos para esta consulta.",                    "tam"=>0);        }                 echo json_encode($data);         exit;    }            public function crearDirectorio($ruta){               if(!file_exists($ruta))        {            mkdir ($ruta);        }    }        public function random(){        $data=array("message"=>"success",                    "data"=>date('Y').date('m').date('d').rand(0, 999),                    "body"=>"",                    "tam"=>"");        echo json_encode($data);        }        public function subir($id){               $uploaddir = 'public/img/usuario/perfil/'.$id.'/';        $this->crearDirectorio($uploaddir);        $uploadfile = $uploaddir . basename(        str_replace("&", "_",        str_replace("ú", "u",            str_replace("ú", "u",                str_replace("ó", "o",                    str_replace("í", "i",                        str_replace("é", "e",                            str_replace("á", "a",                                str_replace("ñ", "n",                                    str_replace(" ", "_",$_FILES['userfile']['name'])))))))))                            );        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {                $data=array("message"=>"success",                    "data"=>"",                    "body"=>"Carga exitosa!.",                    "tam"=>"");                }                 else {                    $data=array("message"=>"error",                    "data"=>"",                    "body"=>"Carga no completada!.",                    "tam"=>"");                }      echo json_encode($data);    }            public function delete($dir) {        unlink( ROOT."public".DS."archivos".DS.$dir);        $this->redireccionar('archivo/archivos');    }       public function perfil($id){        $condicion = "usu_key=".$id;        $usuarios = $this->_usuario->perfil($condicion);        $url='public/img/usuario/perfil/';                for ($i=0; $i <count($usuarios) ; $i++) {             $usuarios[$i]['usu_foto2']=$usuarios[$i]['usu_foto'];            $url=$url.$usuarios[$i]['usu_key']."/";            $usuarios[$i]['usu_foto']=$url.$usuarios[$i]['usu_foto'];            $url='public/img/usuario/perfil/';        }        if (count($usuarios)>0) {            $data=array("message"=>"success",                    "data"=>$usuarios[0],                    "body"=>"",                    "tam"=>count($usuarios));        }        else        {            $data=array("message"=>"errror",                    "data"=>"",                    "body"=>"No existen datos para esta consulta.",                    "tam"=>0);        }                 echo json_encode($data);         exit;        }    public function eliminar($id) {        $this->_view->assign('titulo', 'Eliminar Rol');        $this->_usuario->eliminar($id);                $data=array("message"=>"success",                    "data"=>"",                    "body"=>"Eliminación completada.",                    "tam"=>0);    }    public function editar($id){        $id = $id;        $nombre = $this->getTexto('nombre');        $email = $this->getTexto('email');        $img = $this->getTexto('img');        $ubi = $this->getTexto('ubi');        $tarjeta=$this->getTexto('tarjeta');        $tarjetames=$this->getTexto('mes');        $tarjetaano=$this->getTexto('ano');        $tarjetacodigo=$this->getTexto('cod');          $datos = array(                'usu_nombre' => $this->getTexto('nombre'),                'usu_apellidos' => $this->getTexto('nombre'),                'usu_login' => $this->getTexto('email'),                'usu_observaciones' => $ubi,                'usu_foto' => $img,                'usu_email' => $this->getTexto('email'),                'usu_tarjeta' => $tarjeta,                'usu_mes_ven' => $tarjetames,                'usu_ano_ven' => $tarjetaano,                'usu_codigo'  => $tarjetacodigo,                'usu_estado'  => 1            );    $this->_usuario->actualizar($id,$datos);             }/*    public function index($pagina = false) {        $this->_acl->acceso('ver_usuario');        $this->getLibrary('paginador/paginador');        $paginador = new Paginador();        $this->_view->setJs(array('ajax'));        $condicion = "usu_estado!=0";        $this->_view->assign('datos', $paginador->paginar($this->_usuario->consultar($condicion), $pagina));        $this->_view->assign('paginacion', $paginador->getView('paginas', 'admin/usuario/index'));        $this->_view->assign('titulo', 'Administración Usuarios');        $this->_view->renderizar('index', 'usuario');    }       public function nuevo() {        $this->_acl->acceso('crear_usuario');                $this->_view->assign('roles', $this->_rol->consultarRoles());                        $condicion = "gen_estado!=0";        $this->_view->assign('generos', $this->_genero->consultar($condicion));        $condicion = "tdo_estado!=0";        $this->_view->assign('tDocumento', $this->_tdocumento->consultar($condicion));        $condicion = "dep_estado!=0";        $this->_view->assign('departamento', $this->_departamento->consultar($condicion));        $this->_view->assign('titulo', 'Nuevo Usuario');        $this->_view->setJsPlugin(array('jquery.validate', 'jquery.ui.datepicker'));        $this->_view->setJs(array('ajax', 'validar'));        if ($this->getInt('guardar') == 1) {            $this->_view->assign('datos', $_POST);            $imagen = "";            if (isset($_FILES['imagen']['name'])) {                if ($_FILES['imagen']['name']) {                    $this->getLibrary('upload' . DS . 'class.upload');                    $ruta = ROOT . 'public' . DS . 'adjuntos' . DS . 'usuarios' . DS;                    $upload = new upload($_FILES['imagen'], 'es_Es');                    $upload->file_new_name_body = 'upl_' . uniqid();                    $upload->process($ruta);                    if ($upload->processed) {                        $imagen = $upload->file_dst_name;                    } else {                        $this->_view->assign('_error', $upload->error);                        $this->_view->renderizar('nuevo');                        exit;                    }                }            }            $condicion = "usu_login='{$this->getTexto('login')}'";            $login = $this->_usuario->consultar($condicion);            if ($login) {                $this->_view->assign('_error', 'Login ya existe');                $this->_view->renderizar('nuevo', 'usuario');                exit;            }            $datos = array(                'tdo_key' => $this->getTexto('tipoDocumento'),                'usu_num_documento' => $this->getTexto('numDocumento'),                'rol_key' => $this->getTexto('rol'),                'usu_nombre' => $this->getTexto('nombre'),                'usu_apellidos' => $this->getTexto('apellidos'),                'usu_login' => $this->getTexto('login'),                'usu_observaciones' => $this->getTexto('observaciones'),                'usu_foto' => $imagen,                'usu_email' => $this->getTexto('email'),            );            $key = $this->_usuario->crear($datos);            $pass = Hash::generarPass();            if ($key['usu_key']) {                $this->_usuario->actualizarPassword(Hash::getHash('sha1', $pass, $key['usu_key']), $key['usu_key']);            }            if ($this->getTexto('email')) {                $body = "Cordial Saludo<br/>                La presente es para informar los datos de conexion al aplicativo " . APP_NAME . ". A continuacion se informan los datos.<br/><br/>                Usuario: " . $this->getTexto("login") . "<br/>" . "Password: " . $pass . "<br/><br/>                Podra acceder por medio de la pagina <a href='" . BASE_URL . "'>" . BASE_URL . "</a>";                $this->getLibrary("xpm" . DS . "MAIL");                //require_once 'libs/xpm/MAIL.php';                $m = new MAIL;                $m->From(EMAIL_REMITENTE, EMAIL_NOMBRE_REMITENTE); // set from address                $m->AddTo($this->getTexto("email")); // add to address                $m->Subject('Creacion de Usuario'); // set subject                $m->html($body);                $c = $m->Connect(EMAIL_HOST, (int) EMAIL_SALIDA, EMAIL_USER, EMAIL_PASS) or die(print_r($m->Result));                $m->Send($c);                $m->Disconnect();            }            $this->_view->assign('datos', array());            $this->_view->assign('_mensaje', "El usuario '{$this->getTexto('nombre')} {$this->getTexto('apellidos')}' fue creado exitosamente");        }        $this->_view->renderizar('nuevo', 'usuario');    }    public function detalles($id) {        $this->_acl->acceso('ver_usuario');        $this->_view->assign('titulo', 'Administración de Usuarios');        $condicion = "usu.usu_key={$id}";        $usuario = $this->_usuario->consultar($condicion);        $this->_view->assign('datos', $usuario[0]);        $condicion = "rol.rol_key={$usuario[0]['rol_key']}";        $rol = $this->_rol->consultarRol($condicion);        $this->_view->assign('rol', $rol[0]);        $condicion = "tdo.tdo_key={$usuario[0]['tdo_key']}";        $tdocumento = $this->_tdocumento->consultar($condicion);        $this->_view->assign('tdocumento', $tdocumento[0]);        $this->_view->renderizar('detalles', 'departamento');    }    public function editar($id) {        $this->_acl->acceso('modificar_usuario');        $this->_view->assign('titulo', 'Administración de Usuarios');        $condicion = "usu_key={$id}";        $usuario = $this->_usuario->consultar($condicion);        $this->_view->assign('datos', $usuario[0]);        $this->_view->assign('roles', $this->_rol->consultarRoles());        $condicion = "gen_estado!=0";        $this->_view->assign('generos', $this->_genero->consultar($condicion));        $condicion = "tdo_estado!=0";        $this->_view->assign('tDocumento', $this->_tdocumento->consultar($condicion));        $this->_view->setJsPlugin(array('jquery.validate'));        $this->_view->setJs(array('ajax', 'validar'));        if ($this->getInt('guardar') == 1) {            $this->_view->assign('datos', $_POST);            $imagen = $this->getTexto('old_imagen');            if ($_FILES['imagen']['name']) {                $this->getLibrary('upload' . DS . 'class.upload');                $ruta = ROOT . 'public' . DS . 'adjuntos' . DS . 'usuarios' . DS;                $upload = new upload($_FILES['imagen'], 'es_Es');                $upload->file_new_name_body = 'upl_' . uniqid();                $upload->process($ruta);                if ($upload->processed) {                    $imagen = $upload->file_dst_name;                } else {                    $this->_view->assign('_error', $upload->error);                    $this->_view->renderizar('nuevo');                    exit;                }            }            $datos = array(                'tdo_key' => $this->getTexto('tipoDocumento'),                'usu_num_documento' => $this->getTexto('numDocumento'),                'rol_key' => $this->getTexto('rol'),                'usu_nombre' => $this->getTexto('nombre'),                'usu_apellidos' => $this->getTexto('apellidos'),                'usu_observaciones' => $this->getTexto('observaciones'),                'usu_foto' => $imagen,                'usu_email' => $this->getTexto('email'),            );            $this->_usuario->actualizar($id, $datos);            if ($this->getTexto('email')) {                $body = "Cordial Saludo<br/>                La presente es para informar sus datos en el aplicativo " . APP_NAME . " fueron modificados, si no fue por su solicitud, contactenos.<br/><br/>                El usuario y la contrase&ntilde; son iguales, podra acceder por medio de la pagina <a href='" . BASE_URL . "'>" . BASE_URL . "</a>";                $this->getLibrary("xpm" . DS . "MAIL");                //require_once 'libs/xpm/MAIL.php';                $m = new MAIL;                $m->From(EMAIL_REMITENTE, EMAIL_NOMBRE_REMITENTE); // set from address                $m->AddTo($this->getTexto("email")); // add to address                $m->Subject('Modificacion datos Usuario'); // set subject                $m->html($body);                $c = $m->Connect(EMAIL_HOST, (int) EMAIL_SALIDA, EMAIL_USER, EMAIL_PASS) or die(print_r($m->Result));                $m->Send($c);                $m->Disconnect();            }            $this->_view->assign('_mensaje', "El usuario '{$this->getTexto('nombre')} {$this->getTexto('apellidos')}' fue actualizado exitosamente");            $condicion = "usu_key={$id}";            $usuario = $this->_usuario->consultar($condicion);            $this->_view->assign('datos', $usuario[0]);        }        $this->_view->renderizar('editar', 'usuario');    }    public function personal() {        if (Session::get('autenticado')) {            $this->_view->assign('titulo', 'Administración de Usuarios');            $condicion = "usu.usu_key=" . Session::get('id_usuario');            $usuario = $this->_usuario->consultar($condicion);            $this->_view->assign('datos', $usuario[0]);            $condicion = "gen_estado!=0";            $this->_view->assign('generos', $this->_genero->consultar($condicion));            $condicion = "tdo_key={$usuario[0]['tdo_key']}";            $tdocumento = $this->_tdocumento->consultar($condicion);            $this->_view->assign('tdocumento', $tdocumento[0]);            $this->_view->setJsPlugin(array('jquery.validate'));            $this->_view->setJs(array('ajax', 'validar'));            if ($this->getInt('guardar') == 1) {                $this->_view->assign('datos', $_POST);                $imagen = $this->getTexto('old_imagen');                if ($_FILES['imagen']['name']) {                    $this->getLibrary('upload' . DS . 'class.upload');                    $ruta = ROOT . 'public' . DS . 'adjuntos' . DS . 'usuarios' . DS;                    $upload = new upload($_FILES['imagen'], 'es_Es');                    $upload->file_new_name_body = 'upl_' . uniqid();                    $upload->process($ruta);                    if ($upload->processed) {                        $imagen = $upload->file_dst_name;                    } else {                        $this->_view->assign('_error', $upload->error);                        $this->_view->renderizar('nuevo');                        exit;                    }                }                $datos = array(                    'tdo_key' => $usuario[0]['tdo_key'],                    'usu_num_documento' => $usuario[0]['usu_num_documento'],                    'rol_key' => $usuario[0]['rol_key'],                    'usu_nombre' => $this->getTexto('nombre'),                    'usu_apellidos' => $this->getTexto('apellidos'),                    'usu_observaciones' => $usuario[0]['usu_observaciones'],                    'usu_foto' => $imagen,                    'usu_email' => $this->getTexto('email'),                );                $key = $this->_usuario->actualizar(Session::get('id_usuario'), $datos);                if ($this->getTexto('email')) {                    $body = "Cordial Saludo<br/>                La presente es para informar sus datos en el aplicativo " . APP_NAME . " fueron modificados, si no fue por su solicitud, contactenos.<br/><br/>                El usuario y la contrase&ntilde; son iguales, podra acceder por medio de la pagina <a href='" . BASE_URL . "'>" . BASE_URL . "</a>";                    $this->getLibrary("xpm" . DS . "MAIL");                    //require_once 'libs/xpm/MAIL.php';                    $m = new MAIL;                    $m->From(EMAIL_REMITENTE, EMAIL_NOMBRE_REMITENTE); // set from address                    $m->AddTo($this->getTexto("email")); // add to address                    $m->Subject('Modificacion datos Usuario'); // set subject                    $m->html($body);                    $c = $m->Connect(EMAIL_HOST, (int) EMAIL_SALIDA, EMAIL_USER, EMAIL_PASS) or die(print_r($m->Result));                    $m->Send($c);                    $m->Disconnect();                }                $this->redireccionar();            }            $this->_view->renderizar('personal');        }    }    public function eliminar($id) {        $this->_acl->acceso('eliminar_usuario');        $this->_view->assign('titulo', 'Eliminar Usuario');        $this->_usuario->eliminar($id);        $this->redireccionar('admin/usuario', 'usuario');    }    public function password() {        if (Session::get('autenticado')) {            $this->_view->assign('usuario', Session::get('usuario'));			$this->_view->assign('titulo', 'Cambio de contraseña');            $this->_view->setJsPlugin(array('jquery.validate'));            $this->_view->setJs(array('password'));            if ($this->getInt('guardar') == 1) {                if (!$this->getTexto("old")) {                    $this->_view->assign('_error', 'La contraseña anterior es obligatoria');                    $this->_view->renderizar('password');                    exit;                }                if (!$this->getTexto("password")) {                    $this->_view->assign('_error', 'La nueva contraseña es obligatoria');                    $this->_view->renderizar('password');                    exit;                }                if (!$this->getTexto("confirm")) {                    $this->_view->assign('_error', 'Confirmar la nueva contraseña es obligatorio');                    $this->_view->renderizar('password');                    exit;                }                if ($this->getTexto("password") != $this->getTexto("confirm")) {                    $this->_view->assign('_error', 'Las contraseña no coinciden');                    $this->_view->renderizar('password');                    exit;                }                $condicion = "usu.usu_key='" . Session::get('id_usuario') . "'";                $row = $this->_usuario->consultar($condicion);                foreach ($row as $nombre) {                    if ($nombre['usu_password'] == Hash::getHash('sha1', $this->getTexto('old'), $nombre['usu_key'])) {                        $this->_usuario->actualizarPassword(Hash::getHash('sha1', $this->getTexto("password"), $nombre['usu_key']), $nombre['usu_key']);                        if ($nombre['usu_email']) {                            $body = "Cordial Saludo<br/>                La presente es para informar que su contrase&ntilde;a para el aplicativo " . APP_NAME . " fue cambiada con exito, si no fue por su solicitud, contactenos.<br/><br/>                Podra acceder por medio de la pagina <a href='" . BASE_URL . "'>" . BASE_URL . "</a>";                            $this->getLibrary("xpm" . DS . "MAIL");                            //require_once 'libs/xpm/MAIL.php';                            $m = new MAIL;                            $m->From(EMAIL_REMITENTE, EMAIL_NOMBRE_REMITENTE); // set from address                            $m->AddTo($nombre['usu_email']); // add to address                            $m->Subject('Cambo de Contraseña'); // set subject                            $m->html($body);                            $c = $m->Connect(EMAIL_HOST, (int) EMAIL_SALIDA, EMAIL_USER, EMAIL_PASS) or die(print_r($m->Result));                            $m->Send($c);                            $m->Disconnect();                        }                        break;                    } else {                        $this->_view->assign('_error', 'La contraseña anterior es incorrecta');                        $this->_view->renderizar('password');                        exit;                    }                }               $this->redireccionar('login/cerrar');            }            $this->_view->renderizar('password');            exit;        }        $this->redireccionar('login/cerrar');    }    public function consultaAjax() {                    $consulta = "UPPER(usu.usu_nombre) like UPPER('%" . $this->getTexto('valor') . "%') OR                 UPPER(usu.usu_apellidos) like UPPER('%" . $this->getTexto('valor') . "%') OR                 UPPER(usu.usu_num_documento) like UPPER('%" . $this->getTexto('valor') . "%')";            echo json_encode($this->_usuario->consultar($consulta));            }		 public function consultacorreo() {                    $consulta = " usu.usu_email ='".$this->getTexto('correo') ."' ";            echo json_encode($this->_usuario->consultar($consulta));            }    public function pass($id) {        $this->_acl->acceso('cambiar_password');        $this->_view->assign('titulo', 'Genera una nueva clave de acceso');        $condicion = "usu.usu_key='{$id}'";        $row = $this->_usuario->consultar($condicion);        $pass = Hash::generarPass();        $this->_usuario->actualizarPassword(Hash::getHash('sha1', $pass, $row[0]['usu_key']), $id);        if ($row[0]['usu_email']) {            $body = "Cordial Saludo<br/>                La presente es para informar los datos de conexion al aplicativo " . APP_NAME . ". A continuacion se informan los datos.<br/><br/>                Usuario: " . $row[0]['usu_login'] . "<br/>" . "Password: " . $pass . "<br/><br/>                Podra acceder por medio de la pagina <a href='" . BASE_URL . "'>" . BASE_URL . "</a>";            $this->getLibrary("xpm" . DS . "MAIL");            //require_once 'libs/xpm/MAIL.php';            $m = new MAIL;            $m->From(EMAIL_REMITENTE, EMAIL_NOMBRE_REMITENTE); // set from address            $m->AddTo($row[0]['usu_email']); // add to address            $m->Subject('Reset Contrase&ntilde;a'); // set subject            $m->html($body);            $c = $m->Connect(EMAIL_HOST, (int) EMAIL_SALIDA, EMAIL_USER, EMAIL_PASS) or die(print_r($m->Result));            $m->Send($c);            $m->Disconnect();        }        $this->redireccionar('admin/usuario', 'usuario');    }    */   }?>