@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">

                            <h4><strong>Заявка косплей-шоу</strong></h4>
                            <a class="btn btn-info btn" href="/cosplay">Мои заявки </a>

                            <h4><strong>Заявка ярмарка</strong></h4>
                            <a class="btn btn-info btn" href="/fair">Мои заявки </a>

                            <h4><strong>Заявка пресса</strong></h4>
                            <a class="btn btn-info btn" href="/press">Мои заявки </a>

                            <h4><strong>Заявка волонтер</strong></h4>
                            <a class="btn btn-info btn" href="/volunteer">Мои заявки </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection