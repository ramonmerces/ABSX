@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="row">
                    <div class="col-md-4 card-body d-flex justify-content-center text-center">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <a href="/crud-chamado"><img style="max-width:50px" src="{{URL::asset('/img/warning.png')}}" />
                            <h2>CHAMADOS</h2>
                        </a>
                    </div>
                    <div class="col-md-4 card-body d-flex justify-content-center text-center">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <a href="/cadastro-vendedor"><img style="max-width:50px"
                                src="{{URL::asset('/img/vendedor.png')}}" />
                            <h2>VENDEDORES</h2>
                        </a>
                    </div>
                    <div class="col-md-4 card-body d-flex justify-content-center text-center">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <a href="/cadastro-chamado"><img style="max-width:50px"
                                src="{{URL::asset('/img/anotation.png')}}" />
                            <h2>CRIAR CHAMADOS</h2>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
