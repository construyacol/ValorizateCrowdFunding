<form id="form1">	<div class="row" >		<div class="col-md-13">			<div class="col-md-4" >				<font class="brand" style="font-size:22px;" ><b>Usuarios</b></font>											</div>			<div class="col-md-4" >						<div class="col-md-5 pull-right" >					{if $_acl->permiso('crear_usuario')}					<a class="btn btn-blue" href="{$_layoutParams.root}admin/usuario/nuevo"><i class="icon-plus"></i> Nuevo usuario</a>			{/if}			</div>				</div>			<div class="col-md-4 pull-right" >											<div class="input-group" >					<div class="input-group-addon">						<i class="entypo-search"></i>					</div>						<input type="text" class="form-control" name="buscar" id="buscar"  placeholder="Buscar">					</div>			</div>		</div>	</div>		<hr>
    <table class="table table-bordered table-hover" align="center" style="width: 100%;">        <tr>            <th>Usuario de Acceso</th>            <th>Nombre(s)</th>            <th>Apellidos</th>            <th colspan="4"></th>        </tr>        {foreach $datos as $dato}            <tr>                <td>                    {$dato.usu_login}                </td>                <td>                    {$dato.usu_nombre}                </td>                <td>                    {$dato.usu_apellidos}                </td>                <td class="opcion" align="right">                    <a class="btn btn-primary" href="{$_layoutParams.root}admin/usuario/detalles/{$dato.usu_key}">Detalles</a>                {if $_acl->permiso('modificar_usuario')}                    <a class="btn  btn-primary" href="{$_layoutParams.root}admin/usuario/editar/{$dato.usu_key}">Modificar</a>                {/if}                {if $_acl->permiso('eliminar_usuario')}                    <a class="btn btn-danger" href="{$_layoutParams.root}admin/usuario/eliminar/{$dato.usu_key}">Eliminar</a>                {/if}                {if $_acl->permiso('cambiar_password')}                    <a class="btn btn-success" href="{$_layoutParams.root}admin/usuario/pass/{$dato.usu_key}" title="Genera una nueva contrase&ntilde;a">Password</a>                {/if}				 </td>            </tr>        {/foreach}    </table>    <div class="col-md-12 pull-right" >		<div align="right" >		{$paginacion|default:""}	</div>	</div>		
</form>