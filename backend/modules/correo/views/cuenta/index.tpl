	<div class="row" >		<div class="col-md-13">			<div class="col-md-4" >				<font class="brand" style="font-size:22px;" ><b>Cuentas</b></font>											</div>			<div class="col-md-4" >						<div class="col-md-5 pull-right" >							<a href="javascript:$('#modal-3').modal('show');" class="btn btn-blue" >Nueva Cuenta</a>			</div>				</div>			<div class="col-md-4 pull-right" >											<div class="input-group" >					<div class="input-group-addon">						<i class="entypo-search"></i>					</div>						<input type="text" class="form-control" name="buscar" id="buscar"  placeholder="Buscar">					</div>			</div>		</div>	</div>		<hr>					 <table class="table table-bordered table-hover" align="center">        <tr>            <th>Nombre</th>			<th colspan="3"></th>        </tr>        {foreach $datos as $dato}            <tr align="">                <td style ="">                    {$dato.cut_nombre}                </td>                <td class="" align="right">                    <a class="btn btn-primary" href="{$_layoutParams.root}wf/cuenta/detalles/{$dato.cut_key}">Asignar/Eliminar</a>                    <a href="javascript:$('#modal-2').modal('show');" class="btn btn-primary" onclick="datos('{$dato.cut_key}','{$dato.cut_nombre}','{$dato.cli_key}')" >Modificar</a>				    <a class="btn  btn-danger" href="{$_layoutParams.root}wf/cuenta/eliminar/{$dato.cut_key}">Eliminar</a>				</td>            </tr>        {/foreach}    </table>								<div class="modal fade custom-width" id="modal-3" style="">	<div class="trans" style="">	<div class="modal-dialog " style="width: 60%;">		<div class="modal-content" style="">						<div class="modal-header">				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>				<h4 ><b>Crear cuenta</b></h4>			</div>	<form id="formcrear" enctype="multipart/form-data" method="POST" action="{$_layoutParams.root}wf/cuenta/nuevo" autocomplete="off">			<div class="modal-body">				<input type="hidden" name="guardar" value="1" />					<br>						<div align="">								<b>Nombre de la cuenta:</b>								<input class="form-control"type="text" name="nombre"  value="" required="true" />								<b>Cliente:</b>								<!--input class="form-control"type="text" name="cliente"  value="1" required="true" /-->								<select  class="form-control"  id="rol" name='cliente' required="true">									<option value="">Elija un cliente</option>										{foreach $clientes as $cli}											<option value="{$cli.cli_key}">{$cli.cli_nombre}</option>										{/foreach}								</select>														</div>			</div>			<div class="modal-footer">				<button class="btn btn-blue">Crear cuenta</button>				<a class="btn btn-primary" href="{$_layoutParams.root}wf/cuenta">Cancelar</a>			  </form>			</div>		</div>	</div>	</div></div>		<div class="modal fade custom-width" id="modal-2" >	<div class="trans" style="">	<div class="modal-dialog" style="width: 60%;">		<div class="modal-content">						<div class="modal-header">				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>				<h3 ><b>Editar cuenta</b></h3>			</div>			<form id="modificar" method="POST" enctype="multipart/form-data" action="{$_layoutParams.root}wf/cuenta/editar/" autocomplete="off">			<div class="modal-body">			    	<input type="hidden" name="guardar" value="1" />					<input type="hidden" id="key" name="key" value="" />					<br>					<div align="">							<b>Nombre de la cuenta:</b>							<input class="form-control"type="text" name="nombre" id="nombreedit" value="" required="true" />							<b>Cliente:</b>							<input class="form-control"type="hidden" name="cliente" id="clienteedit" value="" required="true" />							<select  class="form-control"  id="rol" name='cliente' required="true">									<option value="">Elija un cliente</option>										{foreach $clientes as $cli}											<option value="{$cli.cli_key}" >{$cli.cli_nombre}</option>										{/foreach}								</select>													</div>					<br>			</div>						<div class="modal-footer">   			<button class="btn btn-blue"> Guardar cambios</button>			  <a class="btn btn-primary" href="{$_layoutParams.root}wf/cuenta">Cancelar</a>			  </form>			</div>		</div>	</div>	</div></div>