<form id="form1" method="POST" enctype="multipart/form-data" action="{$_layoutParams.root}admin/usuario/nuevo" autocomplete="off"><input class="form-control"  type="hidden" name="guardar" value="1" /><div class="row" >		<div class="col-md-13">			<div class="col-md-6" >				<font class="brand" style="font-size:22px;" ><b>Crear usuario</b></font>											</div>			<div class="col-md-6" align="right">							<button class="btn btn-blue">Crear usuario</button>				<a class="btn btn-primary" href="{$_layoutParams.root}admin/usuario">Cancelar</a>			</div>				</div>				</div>	<hr>    <table class="" style="width: 100%;" cellpadding="8" >
        <tr align="left">            <th class=""><b>Nombre: </b></th>            <td>                <input class="form-control"  type="text" id="nombre" name="nombre" value="" required="true" />            </td>			<th class=""><b>Apellidos: </b></th>            <td>                <input class="form-control"  type="text" id="apellidos" name="apellidos" value="" />            </td>        </tr>
        <tr  align="left">            <th class=""><b>Tipo de documento: </b></th>            <td>                <select  class="form-control"  name='tipoDocumento' id="tipoDocumento" required="true">                    <option value="">Elija el tipo de documento</option>                    {foreach $tDocumento as $nombre}                        <option value="{$nombre.tdo_key}">{$nombre.tdo_nombre}</option>                    {/foreach}                </select>            </td>            <th class=""><b>Numero de documento: </b></th>            <td>                <input class="form-control"  id="numDocumento" type="text" name="numDocumento" value="" required="true" />            </td>        </tr>
        <tr align="left">            <th class=""><b>E-mail: </b></th>            <td>                <input class="form-control"  id="email" type="email" name="email" value="" required="true" />            </td>            <th class=""><b>Rol:</b> </th>            <td>                <select  class="form-control"  id="rol" name='rol' required="true">                    <option value="">Elija un rol</option>                    {foreach $roles as $nombre}                        <option value="{$nombre.rol_key}">{$nombre.rol_nombre}</option>                    {/foreach}                </select>            </td>        </tr>        <tr align="left">            <th class=""><b>Imagen: </b></th>            <td colspan="">                <input class="form-control"  id="imagen" type="file" name="imagen" style="width:200px;" />            </td>                    <th class=""><b>Login: </b></th>            <td>                <input class="form-control"  id="login" type="texto" name="login" value="" required="true"/>            </td>        </tr>        <tr align="left">            <th class=""><b>Observaciones: </b></th>                   </tr>		  <tr align="left">            <td colspan="5">                <textarea class="form-control" id="observaciones" name="observaciones" style="width:100%;height:70px;"></textarea>            </td>        </tr>    </table>
</form>