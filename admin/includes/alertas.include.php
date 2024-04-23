<?php
$alertas_sucesso = [
    "cadastrousuario" => "Cadastro realizado com sucesso!",
    "cadastroproduto" => "Produto cadastrado com sucesso!",
    "editarproduto" => "Produto modificado com sucesso!",
    "removerproduto" => "Produto removido com sucesso!",
    "cadastrocategoria" => "Categoria cadastrada!"
];
$alertas_falha = [
    "cadastrousuario" => "Falha ao cadastrar! Verifique as informações.",
    "cadastroproduto" => "Falha ao cadastrar produto! Verifique as informações.",
    "editarproduto" => "falha ao editar produto! Verifique as informações.",
    "removerproduto" => "falha ao remover produto!",
    "cadastrocategoria" => "Falha ao cadastrar categoria!"
]


?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php
    if (isset($_GET['sucesso'])) { ?>

Swal.fire({
  title: "Show!",
  text: "<?=$alertas_sucesso[$_GET['sucesso']] ?>",
  icon: "success"
});

// remover parametros da URL (?sucesso...)
window.history.replaceState(null, '', window.location.pathname);
<?php } ?>

<?php
    if (isset($_GET['falha'])) { ?>

Swal.fire({
  title: "ERROR!",
  text: "<?=$alertas_falha[$_GET['falha']] ?>",
  icon: "error"
});

// remover parametros da URL (?falha...)
window.history.replaceState(null, '', window.location.pathname);
<?php } ?>



</script>