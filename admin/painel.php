<?php

require_once('actions/classes/Categoria.class.php');
require_once('actions/classes/Produto.class.php');


session_start();
// verificar se a sessão exste, caso nao, redirecionar ao login de volta
if (!isset($_SESSION['usuario'])) {
    // Voltar ao login:
    header('Location: index.php');
    die();
}
// Puxar as categorias:
$c = new Categoria();

$lista_categorias = $c->Listar();

// puxar produtos
$p = new Produto();
$lista_produtos = $p->ListarTudo();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listagem de Produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gerenciamento de Produtos</h1>
        <div class="row mb-3">
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-success mx-1" data-toggle="modal" data-target="#modalCadastro"><i class="bi bi-plus-circle"></i> Cadastrar Produto</button>
                <a class="btn btn-danger mx-1 text-white" href="sair.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
            </div>



        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($lista_produtos as $prod) { ?>
                    <tr>
                        <td><?= $prod['id'] ?></td>
                        <td><img src="fotos/<?= $prod['foto']; ?>" width="150px" alt="<?= $prod['nome']; ?>""></td>

                    <td><?= $prod['nome']; ?></td>
                    <td><?= $prod['descricao']; ?></td>
                    <td><?= $prod['id_categoria']; ?></td>
                    <td><?= $prod['estoque']; ?></td>
                    <td><?= $prod['preco']; ?></td>
                    
                    <td><button type=" button" class="btn btn-warning mx-1 mb-1" data-toggle="modal" data-target="#modaleditar" data-nome="<?= $prod['nome']; ?>" data-descricao="<?= $prod['descricao']; ?>" data-estoque="<?= $prod['estoque']; ?>" data-preco="<?= $prod['preco']; ?>" data-id_categoria="<?= $prod['id_categoria']; ?>" data-id="<?= $prod['id']; ?>">
                            Editar Produto</button>
                            <a class="btn btn-danger mx-1 text-white" href="#" onclick="excluir(<?=$prod['id'];?>)"> Excluir Produto</a>
                        </td>


                    </tr>

                <?php } ?>
            </tbody>
        </table>

    </div>

    <!-- Modal de Cadastro -->
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="actions/cadastrar_produto.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCadastroLabel">Cadastro de Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nomeProduto">Nome</label>
                            <input type="text" class="form-control" id="nomeProduto" name="nome" placeholder="Digite o nome do produto">
                        </div>
                        <div class="form-group">
                            <label for="fotoProduto">Foto</label>
                            <input type="file" class="form-control-file" name="foto" id="fotoProduto">
                        </div>
                        <div class="form-group">
                            <label for="descricaoProduto">Descrição</label>
                            <textarea class="form-control" id="descricaoProduto" name="descricao" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categoriaProduto">Categoria</label>
                            <select class="form-control" name="id_categoria" id="categoriaProduto">

                                <?php foreach ($lista_categorias as $cat) {  ?>
                                    <option value="<?= $cat['id']; ?>"><?= $cat['nome']; ?></option>
                                <?php  } ?>

                            </select> <br>
                            <div class="row">
                                <div class="col d-flex justify-content-end">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalAddCategoria">Adicionar Categoria</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="estoqueProduto">Estoque</label>
                            <input type="number" class="form-control" id="estoqueProduto" name="estoque" placeholder="Digite a quantidade em estoque">
                        </div>
                        <div class="form-group">
                            <label for="precoProduto">Preço</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" class="form-control" id="precoProduto" name="preco" placeholder="Digite o preço">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal para adicionar categoria-->
    <div class="modal fade" id="modalAddCategoria" tabindex="-1" role="dialog" aria-labelledby="modalAddCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="actions/cadastrar_categoria.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddCategoriaLabel">Adicionar Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nomeCategoria">Nome da Categoria</label>
                            <input type="text" class="form-control" id="nomeCategoria" placeholder="Digite o nome da categoria" name="categoria">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal de Editar produto -->
    <div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="modaleditarlabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="actions/editar_produto.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCadastroLabel">Editor de Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="modal-body">
                        <input type="hidden" class="form-control id" id="id" name="id"">
                        <div class=" form-group">
                        <label for="nomeProduto">Nome</label>
                        <input type="text" class="form-control nome" id="nomeProduto" name="nome"">
                        </div>
                        <div class=" form-group">
                        <label for="descricaoProduto">Descrição</label>
                        <textarea class="form-control descricao" id="descricaoProduto" name="descricao" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoriaProduto">Categoria</label>
                        <select class="form-control id_categoria" name="id_categoria" id="categoriaProduto">

                            <?php foreach ($lista_categorias as $cat) {  ?>
                                <option value="<?= $cat['id']; ?>"><?= $cat['nome']; ?></option>
                            <?php  } ?>

                        </select> <br>

                    </div>
                    <div class="form-group">
                        <label for="estoqueProduto">Estoque</label>
                        <input type="number" class="form-control estoque" id="estoqueProduto" name="estoque" placeholder="Digite a quantidade em estoque">
                    </div>
                    <div class="form-group">
                        <label for="precoProduto">Preço</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            <input type="number" class="form-control preco" id="precoProduto" name="preco" placeholder="Digite o preço">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
            </form>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $('#modaleditar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            var id = button.data('id')
            var nome = button.data('nome')
            var descricao = button.data('descricao')
            var id_categoria = button.data('id_categoria')
            var estoque = button.data('estoque')
            var preco = button.data('preco')

            var modal = $(this)

            modal.find('.id').val(id)
            modal.find('.nome').val(nome)
            modal.find('.descricao').val(descricao)
            modal.find('.id_categoria').val(id_categoria)
            modal.find('.estoque').val(estoque)
            modal.find('.preco').val(preco)
        })
    </script>





    <?php

    // É ALGO OPCIONAL UTILIZAR INCLUDE ONCE
    include_once('includes/alertas.include.php');
    ?>

    <script>
        function excluir(id) {
            Swal.fire({
                title: "Tem certeza?",
                text: "Não será possivel desfazer essa ação",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, deleta isso!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirecionar pro apagar_produto.php:
                    window.location.href='actions/apagar_produto.php?id='+id;
                }
                    });

        }
    </script>

</body>

</html>