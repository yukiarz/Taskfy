@extends('base.foundation')

@section('title','Edit Target '. $target->name)

@section('meta')


@endsection


@section('css')


@endsection

@section('content')
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Edit Target <b>{{ $target->name}}</b></div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/target/' . $target->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('target.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>

        </div>
    </div>
@endsection
