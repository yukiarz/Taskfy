@extends('base.foundation')

@section('title','Projects')

@section('meta')


@endsection


@section('css')
<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    #hide-element{
        display:none;
    }
</style>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-start">Projects</h2>

                    <a href="{{ url('/project/create') }}" class="btn btn-success float-end" title="Add New Project">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>
                </div>
                <div class="card-body">
                    <br/>
                    <div >
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Created By</th>
                                    <th>Progress</th>
                                    <th>Deadline</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
   
@endsection



@push('script')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function () {
          var table = $('#datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('project.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'by', name: 'by'},
                  {data: 'progress', name: 'progress'},
                  {data: 'deadline', name: 'deadline', orderable: false, searchable: false},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ], 
            initComplete: function () {
                setInterval(function () {
                    doCountdowns();
                }, 1000);
            }
          });

    });

    function doCountdowns() {
  $('[class^="deadline"]').each(function(index) {
    var indexNumber = $(this).attr('class').match(/\d+/)[0];
    var countdownElement = $('.countDown' + indexNumber);
    doCountdown($(this), countdownElement);
  });
}

function doCountdown(deadlineElement, countdownElement) {
  let endTime = Date.parse(deadlineElement.html()) / 1000;
  let now = Date.now() / 1000;
  let timeLeft = endTime - now;
  let days = Math.floor(timeLeft / 86400);
  let hours = Math.floor((timeLeft - days * 86400) / 3600);
  let minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
  let seconds = Math.floor(timeLeft - days * 86400 - hours * 3600 - minutes * 60);
  if (hours < 10) hours = "0" + hours;
  if (minutes < 10) minutes = "0" + minutes;
  if (seconds < 10) seconds = "0" + seconds;
  countdownElement.html(`${days} Days ${hours}:${minutes}:${seconds}`);
}



</script>
@endpush
