<?php use App\Models\Chamado;?>
@extends('layouts.app')

@section('content')
@if (@auth::check())
<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
}

.table-responsive {
    margin: 30px 0;
}

.table-wrapper {
    background: #fff;
    padding: 20px 25px;
    border-radius: 3px;
    min-width: 1000px;
    a box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}

.table-title {
    padding-bottom: 15px;
    background: #435d7d;
    color: #fff;
    padding: 16px 30px;
    min-width: 100%;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}

.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}

.table-title .btn-group {
    float: right;
}

.table-title .btn {
    color: #fff;
    float: right;
    font-size: 13px;
    border: none;
    min-width: 50px;
    border-radius: 2px;
    border: none;
    outline: none !important;
    margin-left: 10px;
}

.table-title .btn i {
    float: left;
    font-size: 21px;
    margin-right: 5px;
}

.table-title .btn span {
    float: left;
    margin-top: 2px;
}

table.table tr th,
table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}

table.table tr th:first-child {
    width: 60px;
}

table.table tr th:last-child {
    width: 100px;
}

table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}

table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}

table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}

table.table td:last-child i {
    opacity: 0.9;
    font-size: 22px;
    margin: 0 5px;
}

table.table td a {
    font-weight: bold;
    color: #566787;
    display: inline-block;
    text-decoration: none;
    outline: none !important;
}

table.table td a:hover {
    color: #2196F3;
}

table.table td a.edit {
    color: #FFC107;
}

table.table td a.delete {
    color: #F44336;
}

table.table td i {
    font-size: 19px;
}

table.table .avatar {
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 10px;
}

.pagination {
    float: right;
    margin: 0 0 5px;
}

.pagination li a {
    border: none;
    font-size: 13px;
    min-width: 30px;
    min-height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 2px !important;
    text-align: center;
    padding: 0 6px;
}

.pagination li a:hover {
    color: #666;
}

.pagination li.active a,
.pagination li.active a.page-link {
    background: #03A9F4;
}

.pagination li.active a:hover {
    background: #0397d6;
}

.pagination li.disabled i {
    color: #ccc;
}

.pagination li i {
    font-size: 16px;
    padding-top: 6px
}

.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}

/* Custom checkbox */
.custom-checkbox {
    position: relative;
}

.custom-checkbox input[type="checkbox"] {
    opacity: 0;
    position: absolute;
    margin: 5px 0 0 3px;
    z-index: 9;
}

.custom-checkbox label:before {
    width: 18px;
    height: 18px;
}

.custom-checkbox label:before {
    content: '';
    margin-right: 10px;
    display: inline-block;
    vertical-align: text-top;
    background: white;
    border: 1px solid #bbb;
    border-radius: 2px;
    box-sizing: border-box;
    z-index: 2;
}

.custom-checkbox input[type="checkbox"]:checked+label:after {
    content: '';
    position: absolute;
    left: 6px;
    top: 3px;
    width: 6px;
    height: 11px;
    border: solid #000;
    border-width: 0 3px 3px 0;
    transform: inherit;
    z-index: 3;
    transform: rotateZ(45deg);
}

.custom-checkbox input[type="checkbox"]:checked+label:before {
    border-color: #03A9F4;
    background: #03A9F4;
}

.custom-checkbox input[type="checkbox"]:checked+label:after {
    border-color: #fff;
}

.custom-checkbox input[type="checkbox"]:disabled+label:before {
    color: #b8b8b8;
    cursor: auto;
    box-shadow: none;
    background: #ddd;
}

/* Modal styles */
.modal .modal-dialog {
    max-width: 400px;
}

.modal .modal-header,
.modal .modal-body,
.modal .modal-footer {
    padding: 20px 30px;
}

.modal .modal-content {
    border-radius: 3px;
    font-size: 14px;
}

.modal .modal-footer {
    background: #ecf0f1;
    border-radius: 0 0 3px 3px;
}

.modal .modal-title {
    display: inline-block;
}

.modal .form-control {
    border-radius: 2px;
    box-shadow: none;
    border-color: #dddddd;
}

.modal textarea.form-control {
    resize: vertical;
}

.modal .btn {
    border-radius: 2px;
    min-width: 100px;
}

.modal form label {
    font-weight: normal;
}
</style>

<script>
jQuery(document).ready(function() {
    $(document).on('click', '.edit', function() {
        $('#id_form').val($(this).data('id'));
        $('#id_assunto').val($(this).data('assunto'));
        $('#id_descricao').val($(this).data('descricao'));
        $('#id_status').val($(this).data('status'));
        $('#id_created_at').val($(this).data('created_at'));
    });
    $(document).on('click', '.delete', function() {
        $('#id_form_delet').val($(this).data('id'));
        $('.email_user_delet').text($(this).data('email'));
    });


    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function() {
        if (this.checked) {
            checkbox.each(function() {
                this.checked = true;
            });
        } else {
            checkbox.each(function() {
                this.checked = false;
            });
        }
    });
    checkbox.click(function() {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
});
</script>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gerenciar chamados</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addChamadoModal" class="btn btn-success" data-toggle="modal"><i
                                class="material-icons">&#xE147;</i> <span>Novo Chamado</span></a>
                        
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Assunto</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Data de Criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   $chamados = Chamado::all();
                   if (!empty($chamados)){
                       foreach ($chamados as $chamado){
                           echo ("<tr>
                           <td>".$chamado->assunto."</td>
                           <td>".$chamado->descricao."</td>
                           <td>".$chamado->status."</td>
                           <td>".$chamado->created_at."</td>
                           <td>
                            <a href='#editChamadoModal' class='edit' data-toggle='modal'
                                data-id=".$chamado->id."
                                data-assunto=".$chamado->assunto."
                                data-status=".$chamado->status."
                                data-descricao=".$chamado->descricao."
                                data-created_at=".$chamado->created_at."
                            ><i class='material-icons'
                                    data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
                            <a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id=".$chamado->id."><i class='material-icons'
                                    data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
                        </td>");
                       }
                   }
                   ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<div id="addChamadoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/post-chamado" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-header">
                    <h4 class="modal-title">Novo Chamado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Assunto</label>
                        <input type="text" name="assunto" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <input type="text" name="descricao" class="form-control" required>
                    </div>
        </div>
                <div class="modal-footer">
                    <input type="hidden" name="status" value="aberto">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Adicionar">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<div id="editChamadoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/update-chamado" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-header">
                    <h4 class="modal-title">Editar Chamado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hiden" name="id" id="id_form" class="form-control" required>
                        <label>Assunto:</label>
                        <input type="text" name="assunto" id="id_assunto" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Descrição:</label>
                        <input type="text" name="descricao" id="id_descricao"  class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <select  class="form-control" name="status" id="id_status" required>>
                            <option value="Aberto">Aberto</option>
                            <option value="Atrasado">Atrasado</option>
                            <option value="Atendimento">Atendimento</option>
                            <option value="Resolvido">Resolvido</option> 
                            </select>
                    </div>
                    <div class="form-group">
                        <label>Data Criação:</label>
                        <input type="text" name="created_at" id="id_created_at" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/delete-chamado" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Deletar Vendedores</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <input type="hidden" name="id" id="id_form_delet" class="form-control" required>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </div>
                    <p>Tem certeza que quer deletar este Chamados?</p>
                    <p class="text-warning"><small>Esta ação não pode ser desfeita!</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>
@else  <script>window.location = "/login";</script>
@endif
@endsection
