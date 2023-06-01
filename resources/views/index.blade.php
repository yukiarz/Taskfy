@extends('base.foundation')

@section('title','Dashboard')

@section('meta')


@endsection

@section('css')

@livewireStyles

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 mb-6 order-0 mb-4">
            <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <div class="card-title mb-5">
                            <h4 class="text-primary float-start m-0">🎯 Target</h4>
                            <a href="{{route('target.create')}}" class="btn btn-sm btn-outline-primary float-end">Add Target</a>

                        </div>
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Target</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($targets as $target)
                            <tr>
                                <td>{{$target->name}}</td>
                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                        </table>
                      

                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-6 mb-6 order-0 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="card-title mb-5">
                                <h4 class="text-primary float-start m-0">📌 Reminder</h4>
                                @if(checkPermission(['superuser']))
                                    <a href="{{route('reminder.create')}}" class="btn btn-sm btn-outline-primary float-end">Add Reminder</a>
                                @endif
                            </div>
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Reminders</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($reminders as $remind)
                                <tr>
                                    <td>{{ Str::limit($remind->description, 35, '...') }}</td>
                                </tr>
                            @empty

                            @endforelse
                            </tbody>
                            </table>
                        

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-6 col-lg-6 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                    <livewire:log-task-user />


                    </div>
                </div>  
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="card-title mb-5">
                                <h4 class="text-primary float-start m-0">🍀 Project</h4>
                                <a href="{{route('reminder.create')}}" class="btn btn-sm btn-outline-primary float-end">Add Project</a>
                                
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection



@push('script')
@livewireScripts

<script>
    window.addEventListener('openModal', event => {
    $("#modalDaily").modal('show');
  })
  window.addEventListener('closeModal', event => {
    $("#modalDaily").modal('hide');
  })
</script>


@endpush