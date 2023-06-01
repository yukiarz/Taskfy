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
                        <h2 class="float-start">Reminder</h2>

                        <a href="{{ url('/reminder/create') }}" class="btn btn-success float-end" title="Add New Reminder">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                    </div>
                    <div class="card-body">
                        <br/>
                        
                            <table class="table table-striped" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Description</th>
                                        <th>Actions</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
          $(function () {
          var table = $('#datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('reminder.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'user', name: 'user'},
                  {data: 'description', name: 'description'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          
      });
function deleteConfirmation(id){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Are you sure you want to delete this data?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        form.submit();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: "{{ route('reminder.destroy', '') }}/"+id,
            data: {_token: CSRF_TOKEN, id: id, _method: 'DELETE'},
            dataType: 'JSON',
            success: function(results) {
                toastr.success('deleted data','Success!');
                window.location.reload();
                
            }
        });
    }
    });
}
</script>


@endpush
