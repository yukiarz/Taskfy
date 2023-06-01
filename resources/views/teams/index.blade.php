@extends('base.foundation')

@section('title','Projects')

@section('meta')


@endsection


@section('css')


@endsection

@section('content')
    <div class="row">
        <div>
            <h2 class="float-start">Team</h2>
            @if(checkPermission(['superuser']))
            <a href="{{url('teams/create')}}" class="btn btn-success float-end">Add Team</a>
            @endif
        </div>
        @forelse($teams as $team)
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$team->name}}</h5>
                    <h6 class="card-subtitle text-muted">{{$team->userSetting->position}}</h6>
                    @if($team->userSetting->profile)
                        <img class="img-fluid d-flex mx-auto my-4" src="{{$team->userSetting->profile}}" alt="profile">
                    @else
                        <img class="img-fluid d-flex mx-auto my-4" src="{{asset('launch/img/avatar/cat.png')}}" alt="avatar">
                    @endif
                    <p class="card-text">{{$team->userSetting->phone}}<br>{{$team->email}}</p>
                    <a href="javascript:void(0);" class="card-link">Card link</a>
                    <a href="javascript:void(0);" class="card-link">Another link</a>
                </div>
            </div>
        </div>
        @empty
            Belum ada data
        @endforelse
    </div>
</div>
@endsection



@push('script')



@endpush
