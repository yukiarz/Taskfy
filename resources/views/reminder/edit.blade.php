@extends('base.foundation')

@section('title','Projects')

@section('meta')


@endsection


@section('css')


@endsection

@section('content')
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Edit Reminder #{{ $reminder->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/reminder') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/reminder/' . $reminder->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('reminder.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>

        </div>
    @endsection



@push('script')



@endpush
