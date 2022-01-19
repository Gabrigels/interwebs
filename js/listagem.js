// carrega as URLs cadastradas via Ajax
$(document).ready(function () {
    $("#editar").hide();
    $("#voltar").hide();

    $.ajax({
        type: "POST",
        url: "ajax/carregar.php",
        success: function (data) {
            $("#body").html(data);
        }
    });
});

function salvar() {
    // alert(operacao);
    var url = $("#protocolo").val() + "://" + $("#url").val();
    var id = $("#url_id").val();
    var usuario = '<?= $_SESSION['usuario'] ?>';

    // realiza a validação da URL
    if (!validaUrl(url)) {
        alert("URL inválida");
        return false;
    } else {
        if (confirm("Deseja finalizar o cadastro?")) {
            $.ajax({
                type: "POST",
                url: "ajax/salvar.php",
                data: {
                    url: url,
                    usuario: usuario
                }, success: function (data) {
                    $("#body").html(data);
                    if (data == 1) {
                        alert("Erro ao inserir URL");
                    }
                }
            });
        }
    }
}

function salvar_edicao() {
    // alert(operacao);
    var url = $("#protocolo").val() + "://" + $("#url").val();
    var id = $("#url_id").val();

    // realiza a validação da URL
    if (!validaUrl(url)) {
        alert("URL inválida");
        return false;
    } else {
        if (confirm("Deseja atualizar  a URL?")) {
            $.ajax({
                type: "POST",
                url: "ajax/editar.php",
                data: {
                    url: url,
                    id: id
                }, success: function (data) {
                    $("#body").html(data);
                    if (data == 1) {
                        alert("Erro ao inserir URL");
                    }
                }
            });
        }
    }
}


function excluir(id) {
    if (confirm("Deseja confirmar a exclusão?")) {
        $.ajax({
            type: "POST",
            url: "ajax/excluir.php",
            data: {
                id: id
            }, success: function (data) {
                $("#body").html(data);
                if (data == 1) {
                    alert("Erro ao excluir URL");
                } else {
                    alert("URL excluída com sucesso!");
                }
            }
        });
    }
}

function editar(id, url) {
    $("#url").val(url);

    $("#editar").show();
    $("#salvar").hide();
    $("#voltar").show();

    $("#url_id").val(id);
}

function voltar() {
    $("#url").val('');

    $("#editar").hide();
    $("#salvar").show();
    $("#voltar").hide();

    $("#url_id").val(0);
}

function validaUrl(url) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}
