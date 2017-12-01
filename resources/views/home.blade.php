@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                            <h4><strong>Добро пожаловать. Вы успешно зареестрировались.</strong></h4>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
