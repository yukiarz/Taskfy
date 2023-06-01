@extends('base.foundation')

@section('title','Dashboard')

@section('meta')


@endsection


@section('css')


@endsection

@section('content')
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <h3 class="card-header">Create New Target</h3>
                    <div class="card-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/target') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('target.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>

        </div>
    </div>
@endsection
