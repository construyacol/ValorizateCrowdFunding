<div class="row" >		<div class="col-md-13">			 <div class="col-md-6" >				<font class="brand"style="font-size:22px;" ><b>Vista detallada</b></font>			 </div>	<div class="col-md-6 pull-right" align="right">						<div class="col-md-10 pull-right"  align="right">					<a class="btn btn-primary" href="{$_layoutParams.root}admin/contacto"><i class="icon-backward"></i> Regresar</a>				{if $_acl->permiso('modificar_contacto')}                 <a class="btn btn-primary" href="{$_layoutParams.root}admin/contacto/editar/{$cliente.con_key}"><i class="icon-pencil"></i> Modificar</a>				{/if}				{if $_acl->permiso('eliminar_contacto')}                <a class="btn btn-danger" href="{$_layoutParams.root}admin/contacto/eliminar/{$cliente.con_key}"><i class="icon-trash"></i> Eliminar</a>				{/if}			</div>	</div>		</div> </div>  <hr/>	<table class="" style="">		<tr>			<th class="etiqueta"><b>Nombre: </b></th>			<td>{$cliente.con_nombre}</td>		</tr>		<tr>			<th class="etiqueta"><b>Fecha de nacimiento: </b></th>			<td>{$cliente.con_fecha_nacimiento} </td>		</tr>		<tr>			<th class="etiqueta"><b>Estado:</b> </th>			<td>{$estado.eci_nombre}</td>		</tr>		<tr>			<th class="etiqueta"><b>Numero de hijos: </b></th>			<td>{$cliente.con_hijos}</td>		</tr>		<tr>			<th class="etiqueta"><b>Genero:</b> </th>			<td>{$genero.gen_nombre}</td>		</tr>		<tr>			<th class="etiqueta"><b>Direcci&oacute;n: </b></th>			<td>{$cliente.con_direccion}</td>		</tr>		<tr>			<th class="etiqueta"><b>Departamentode residencia: </b></th>			<td>{$departamentoRes.dep_nombre}</td>		</tr>		<tr>			<th class="etiqueta"><b>Ciudad de residencia:</b> </th>			<td>        {$ciudadRes.ciu_nombre} </td>		</tr>		<tr>			<th class="etiqueta"><b>Tel&eacute;fono: </b></th>			<td> {$cliente.con_telefono} </td>		</tr>		<tr>			<th class="etiqueta"><b>E-mail: </b></th>			<td>{$cliente.con_email}</td>		</tr>		<tr>			<th class="etiqueta"><b>Observaciones: </b></th>			<td>{$cliente.con_observaciones}</td>		</tr>
	</table>
