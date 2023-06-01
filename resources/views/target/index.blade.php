@extends('base.foundation')

@section('title','Projects')

@section('meta')


@endsection


@section('css')
<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">


@endsection

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h2 class="float-start">Target</h2>
                        <a href="{{ url('/target/create') }}" class="btn btn-success float-end" title="Add New Target">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    </div>
                    <div class="card-body">
                        

                        <div>
                            <table class="table table-striped" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
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
              ajax: "{{ route('target.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'description', name: 'description'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          
      });
</script>

@endpush

