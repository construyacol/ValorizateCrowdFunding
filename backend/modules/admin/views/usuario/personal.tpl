<form id="form1" method="POST" enctype="multipart/form-data" action="{$_layoutParams.root}admin/usuario/personal">
    <input class="form-control"  type="hidden" name="guardar" value="1" />
    <table class="" style="width: 100%;">
        <tr>
            <th class="etiqueta">Nombre: &nbsp;</th>
            <td>
                <input class="form-control"  type="text" id="nombre" name="nombre" value="{$datos.usu_nombre|default:""}" required="true" />
            </td>
        </tr>
        <tr>
            <th class="etiqueta">Apellidos: &nbsp;</th>
            <td>
                <input class="form-control"  type="text" id="apellidos" name="apellidos" value="{$datos.usu_apellidos|default:""}" />
            </td>
        </tr>
        <tr>
            <th class="etiqueta">Tipo de Documento</th>
            <td>
                <input class="form-control"  type="text" id="tipoCedula" name="tipoCedula" value="{$tdocumento.tdo_nombre|default:""}" readonly="true"/>
            </td>
        </tr>
        <tr>
            <th class="etiqueta">Numero de Documento: &nbsp;</th>
            <td>
                <input class="form-control"  id="numDocumento" type="text" name="numDocumento" value="{$datos.usu_num_documento|default:""}" required="true" readonly />
            </td>
        </tr>
        <tr>
            <th class="etiqueta">E-mail: &nbsp;</th>
            <td>
                <input class="form-control"  id="email" type="email" name="email" value="{$datos.usu_email|default:""}" />
            </td>
        </tr>
        <tr>
            <th class="etiqueta">Imagen: &nbsp;</th>
            <td>
                <input class="form-control"  id="imagen" type="file" name="imagen" />
                <input class="form-control"  type="hidden" name="old_imagen" value="{$datos.usu_foto}" />
            </td>
        </tr>
    </table>
    <br/>
    <p>
      
    </p>
</form>