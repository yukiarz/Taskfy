@extends('base.foundation')

@section('title','Projects')

@section('meta')


@endsection


@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Reminder</div>
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

                        <form method="POST" action="{{ url('/reminder') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">User</label>
                                <select class="form-control user-reminder" name="user_id[]" multiple="multiple">
                                    @forelse($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @empty
                                        <option value="" selected>Tidak ada data</option>
                                    @endforelse
                                </select>
                            </div>


                            @include ('reminder.form', ['formMode' => 'create'])
                           
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>

        </div>
    
    @endsection



@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.user-reminder').select2();
    });
</script>

@endpush