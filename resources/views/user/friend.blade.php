@extends('layouts.backend')
@section('content')
@section('additional_css')
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@endsection
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Users</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable" id="datatable">
                        <thead>
                            <tr>
                                <th width="5%">Id</th>
                                <th width="14%">Name</th>
                                <th width="10%">Email</th>
                                <th width="3%">Gender</th>
                                <th width="20%">Created Date</th>
                            </tr>
                        </thead>
                        @if($users)
                        @foreach($users as $user)
                        <tbody>
                            <tr>

                                <th width="5%">{{$user['id']}}</th>
                                <th width="14%">{{$user['name']}}</th>
                                <th width="10%">{{$user['email']}}</th>
                                <th width="3%">{{$user['gender']}}</th>
                                <th width="20%">{{$user['created_at']}}</th>
                               </tr>
                        </tbody>
                        @endforeach
                        @endif
                    </table>
                   
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
