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
                <form action="{{route('user.index')}}" method="GET">
                    <div class="row">

                        <div class="col-md-5">
                            <label for="Hobbes">Hobbies</label>
                            <select name="hobbies" class="form-control" id="hobbies">
                                <option value="">Select</option>
                                @if($hobbies)
                                @foreach($hobbies as $hobby)
                                <option value="{{$hobby->id}}">{{$hobby->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="Gender">Gender</label>
                            <select name="gender"  class="form-control" id="gender">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" id="ajax-filter" class="btn btn-primary">Submit</button>
                            <a href="{{route('user.index')}}" class="btn btn-primary">Reset</a>
                        </div>

                    </div>




                </form>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable" id="datatable">
                        <thead>
                            <tr>
                                <th width="5%">Id</th>
                                <th width="14%">Name</th>
                                <th width="10%">Email</th>
                                <th width="3%">Gender</th>
                                <th width="20%">Created Date</th>
                                <th width="25%">Action</th>
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
                                <th width="25%"><a href="{{route('user.send_request', $user['id'])}}"  class="btn btn-primary">Send Request</a>                      
                                    <a href="{{route('user.block_user', $user['id']) }}"    class="btn btn-danger delete-confirm" title="Delete">Block</a></th>
                            </tr>
                        </tbody>
                        @endforeach
                        @endif
                    </table>
                    <?php
                    $data=[];
                    if (request()->has('gender')) {
                        $data['gender'] = request()->gender;
                    }if (request()->has('hobbies')) {
                        $data['hobbies'] = request()->hobbies;
                    }
                    echo $users->appends($data)->links();
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
