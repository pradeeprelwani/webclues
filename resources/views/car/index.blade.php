@extends('layouts.backend')
@section('content')

@section('additional_css')
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@endsection
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Cars</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <a href="{{route('car.create')}}" class="btn btn-primary">Create</a>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable" id="datatable">
                        <thead>
                            <tr>
                                <th width="5%">Id</th>
                                <th width="15%">Car Name</th>
                                 <th width="15%">Colour</th>
                                <th width="15%">Picture</th>
                                <th width="15%">Date</th>
                                <th width="10%">Status</th>
                                <th width="10%">Created Date</th>
                                <th width="25%">Action</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@section('additional_js')

<script>
$(document).ready(function () {
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [[ 0, "desc" ]],
        ajax: {
            url: "{{route('car.index')}}",
            dataSrc: "data",
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
             {data: 'colour', name: 'colour'},
            {data: 'icon', name: 'icon'},
            {data: 'date', name: 'date'},
             {data: 'status', name: 'status'},
           
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false}
        ]
    });
});
</script>
@endsection
@endsection