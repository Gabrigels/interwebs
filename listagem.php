<?php
session_start();
error_reporting(0);

if ($_SESSION['usuario']) {
	include_once("connect.php"); 
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Interwebs</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>
	<body>
	<style>
		label {
			color: white;
		}
	</style>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<label>Bem-vindo, <?= $_SESSION['nome'] ?></label>
		<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link"  href="sair.php">Sair</a>
            </li>
        </ul>
    </div>
		</nav>
		<div class="container">
		<h2>Listagem de URL</h2>
		<div class="form-group">
			<label for="exampleInputEmail1">Cadastre a URL abaixo</label>
			<div class="row">
				<div class="col-2">
					<select name="protocolo" id="protocolo" class="form-control">
						<option value="http">http</option>
						<option value="https">https</option>
					</select>
				</div>
				<div class="col-10">
					<input type="text" name="url" id="url" class="form-control" placeholder="Digite a URL">
				</div>
			</div>
			<button type="button" class="btn btn-success" onclick="salvar();" id="salvar">Salvar</button>
			<button type="button" class="btn btn-success" onclick="salvar_edicao();" id="editar">Editar</button>
			<button type="button" class="btn btn-secondary" onclick="voltar();" id="voltar">Voltar</button>
			<input type="hidden" name="url_id" id="url_id">
		</div>
		<table class="table table-bordered">
			<thead>
			<tr>
				<th>URL</th>
				<th>Corpo</th>
				<th>Status</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
			</thead>
			<tbody id="body">
			
			</tbody>
		</table>
		</div>
		<script>
		// carrega as URLs cadastradas via Ajax
		$(document).ready(function(){
			$("#editar").hide();
			$("#voltar").hide();

			$.ajax({
				type: "POST",
				url: "ajax/carregar.php",
				success: function(data) {
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
							url:url,
							usuario:usuario
						}, success: function(data) {
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
							url:url,
							id:id
						}, success: function(data) {
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
							id:id
						}, success: function(data) {
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
 		</script>
	</body>
</html>

<?php
} else {
	header('Location: index.php');
}
?>