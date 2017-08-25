$(document).ready(function() {

    $("#buscar").autocomplete({
        source: function(request, response) {
            $.ajax({
                type: "POST",
                url: _root_ + "admin/almacen/consultaAjax",
                dataType: "json",
                data: {
                    valor: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            value: item.alm_nombre,
                            label: item.alm_nombre,
                            key: item.alm_key
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            window.location = _root_ + "admin/almacen/detalles/" + ui.item.key;
        },
        open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });

});