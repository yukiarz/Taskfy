@extends('base.foundation')

@section('title','Dashboard')

@section('meta')


@endsection


@section('css')
<link rel="stylesheet" href="{{asset('launch/vendor/css/project-show.css')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>

.grid { /* Masonry container */
  -webkit-column-count: 4;
  -moz-column-count:4;
  column-count: 4;
  -webkit-column-gap: 1em 0;
  -moz-column-gap: 1em 0;
  column-gap: 1em 0;
  margin: 1em 0;
  padding: 0;
  -moz-column-gap: 1em 0;
  -webkit-column-gap: 1em 0;
  column-gap: 1em 0;
  font-size: .85em;
}
.grid-item {
  display: inline-block;
  padding: 0.5em 0;
  /* margin: 0 0 1.5em; */
  width: 100%;

}
@media only screen and (max-width: 320px) {
    .grid {
        -moz-column-count: 1;
        -webkit-column-count: 1;
        column-count: 1;
    }
}

@media only screen and (min-width: 321px) and (max-width: 768px){
    .grid {
        -moz-column-count: 1;
        -webkit-column-count: 1;
        column-count: 1;
    }
}
@media only screen and (min-width: 769px) and (max-width: 1200px){
    .grid {
        -moz-column-count: 3;
        -webkit-column-count: 3;
        column-count: 3;
    }
}
@media only screen and (min-width: 1201px) {
    .grid {
        -moz-column-count: 3;
        -webkit-column-count: 3;
        column-count: 3;
    }
}

/* demo */

</style>


@livewireStyles
@endsection

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="float-start">Project {{ $project->name }}</h3>
                      <div class="btn-group float-end">
                          <span class="dropdown-toggle hide-arrow extra-menu" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                          </span>
                  
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a href="{{ url('/project/' . $project->id . '/edit') }}" class="dropdown-item" title="Edit Project"><i class="bx bx-pencil" aria-hidden="true"></i> Edit</a>
                              <form method="POST" action="{{ url('project' . '/' . $project->id) }}" accept-charset="UTF-8" style="display:inline">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                  <button type="submit" class="dropdown-item" title="Delete Project" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class='bx bx-trash'></i> Delete</button>
                              </form>
                            </li>
                           
                          </ul>
                        </div>
                    </div>
                    <div class="card-body">

                        <!-- <a href="{{ url('/project') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/project/' . $project->id . '/edit') }}" title="Edit Project"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('project' . '/' . $project->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Project" onclick="return confirm(&quot;Confirm delete?&quot;)"><box-icon name='trash-alt'></box-icon> Delete</button>
                        </form> -->

                        <!-- <h3>{{ $project->name }}</h3> -->
                        <p>{{ $project->description }} </p>
                        <div>
                        
                        <livewire:activity-create :project_id="$project->id" />
                        </div>
                        

                        <!-- <div class="table-responsive mt-3">
                             <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $project->id }}</td>
                                    </tr>
                                    <tr><th> User Id </th><td> {{ $project->user_id }} </td></tr><tr><th> Name </th><td> {{ $project->name }} </td></tr><tr><th> Description </th><td> {{ $project->description }} </td></tr>
                                </tbody>
                            </table>

                        </div> -->
                      

                    </div>
                </div>
            </div>
        </div>
        <livewire:activity-component :project_id="$project->id" />

@endsection



@push('script')

@livewireScripts

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script> -->
@stack('select2')
<script>



  window.addEventListener('openActivityForm', event => {
    $("#addActivity").modal('show');
  })
  window.addEventListener('closeActivityForm', event => {
    $("#addActivity").modal('hide');
  })
  window.addEventListener('activitySuccess', event => {
    $("#addActivity").modal('hide');
    toastr.success('Success','Success!')
  })

  window.addEventListener('openActivityFormEdit', event => {
    $("#editActivity").modal('show');
  })
  window.addEventListener('closeActivityFormEdit', event => {
    $("#editActivity").modal('hide');
  })
  window.addEventListener('activityEdited', event => {
    $("#editActivity").modal('hide');
    toastr.success('Success edited activity','Success!')
  })

  window.addEventListener('openChecklistForm', event => {
    $("#addChecklist").modal('show');
  })
  window.addEventListener('closeChecklistForm', event => {
    $("#addChecklist").modal('hide');
  })
  window.addEventListener('checklistSuccess', event => {
    $("#addChecklist").modal('hide');
    toastr.success('Add new checklist','Success!')
  })

  window.addEventListener('deleteActivity', event => {
    $("#deleteActivity").modal('show');
  })

  window.addEventListener('closeDeleteActivity', event => {
    $("#deleteActivity").modal('hide');
    // toastr.success('Success deleted','Success!')

  })
</script>


@endpush
