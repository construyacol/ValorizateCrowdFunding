<form id="form1">
  
    <table class="table table-bordered table-hover" align="center">
        <tr>
            <th>ID</th>
            <th>Nombre(s)</th>
            <th>Tel&eacute;fono</th>
            <th>Email</th>
            <th colspan=""></th>
        </tr>

        {foreach $clientes as $cliente}
            <tr>
                <td style="text-align: center">
                    {$cliente.con_key}
                </td>
                <td>
                    {$cliente.con_nombre}
                </td>
                <td>
                    {$cliente.con_telefono}
                </td>
                <td>
                    {$cliente.con_email}
                </td>
                <td class="opcion" align="right">
                    <a class="btn btn-primary" href="{$_layoutParams.root}admin/contacto/detalles/{$cliente.con_key}"><i class="icon-eye-open"></i> Detalles</a>
                
                {if $_acl->permiso('modificar_contacto')}
                
                        <a class="btn btn-primary" href="{$_layoutParams.root}admin/contacto/editar/{$cliente.con_key}"><i class="icon-pencil"></i> Modificar</a>
                
                {/if}
                {if $_acl->permiso('eliminar_contacto')}
                
                        <a class="btn btn-danger" href="{$_layoutParams.root}admin/contacto/eliminar/{$cliente.con_key}"><i class="icon-trash"></i> Eliminar</a>
                
                {/if}
            </tr>
        {/foreach}
    </table>
   <div class="col-md-12 pull-right" >	
</form>