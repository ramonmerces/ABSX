<?php use App\Models\Vendedor;?>
@extends('layouts.app')

@section('content')
<?php $vendedores = Vendedor::All()->count(); ?>

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
    background: #2368f1;
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

.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}

button.btn {
    background: #2368f1;
    color: #fff;
}
</style>

@if($vendedores == '0')
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Nenhum vendedor encontrado cadastre um vendedor e tente novamente</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else                
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Criar chamado</h2>
                    </div>
                </div>
            </div>
            <form action="/post-chamado" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="status" value="aberto">
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <input class="form-control" type="text" name="assunto" placeholder="Informe o assunto do chamado">
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" placeholder="Descreva o seu problema"
                        rows="5"></textarea>
                </div>
                <button type="submit" class="btn">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
