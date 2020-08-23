@extends('layouts.backend')
@section('content')

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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <a href="{{route('car.index')}}" class="btn btn-primary">Cars</a>
                <form id="car-update" novalidate="" enctype="multipart/form-data" action="{{route('car.update',$car->id)}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Car Name</label>
                                <input name="name" value="{{$car->name}}" type="text" class="form-control" id="" >
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Icon</label>
                                        <input type="file" name="icon" id="icon" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Pictures</label>
                                        <input type="file" name="picture[]" id="picture" multiple="multiple" class="form-control" >
                                    </div>
                                </div>
                            </div>
                           

                            
                            
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Color</label>
                                        <select class="form-control" id="color_id" name="color_id">
                                            <option value="">Select</option>
                                            @if($colors)
                                            @foreach($colors as $color)
                                            <option value="{{$color->id}}" <?php if($color->id==$car->color_id){echo "selected";}?>>{{$color->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="">Fuel Type</label>
                                        <select class="form-control" id="fuel_type" name="fuel_type">
                                            <option value="">Select</option>
                                            <option value="patrol" <?php if($car->fuel_type=='patrol'){echo "selected";}?> >Patrol</option>
                                            <option value="diesel" <?php if($car->fuel_type=='diesel'){echo "selected";}?>>Diesel</option>
                                            <option value="cng" <?php if($car->fuel_type=='cng'){echo "selected";}?>>Cng</option>
                                        </select>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <label for="">Date</label>
                                        <select class="form-control" id="date" name="date">
                                            <option value="">Select</option>
                                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                <option value="{{$i}}" <?php if($car->date==$i){echo "selected";}?>>{{$i}}</option>
                                            <?php } ?>


                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Month</label>
                                        <select class="form-control" id="month" name="month">
                                            <option value="">Select</option>
                                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                <option value="{{$i}}" <?php if($car->month==$i){echo "selected";}?>>{{$i}}</option>
                                            <?php } ?>

                                        </select>
                                    </div>  </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Year</label>
                                        <select class="form-control" id="year" name="year">
                                            <option value="">Select</option>
                                            <?php for ($i = 1981; $i <= date('Y'); $i++) { ?>
                                                <option value="{{$i}}" <?php if($car->year==$i){echo "selected";}?>>{{$i}}</option>
                                            <?php } ?>

                                        </select>
                                    </div> </div>

                            </div>

                            
                            
                                     <div class="form-group">
                                        <label for="">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">Select</option>
                                            <option value="active" <?php if($car->status=='Active'){echo "selected";}?>>Active</option>
                                            <option value="inactive" <?php if($car->status=='Inactive'){echo "selected";}?>>Inactive</option>
                                        </select>
                                    </div>
                             
                            <div class="form-group">
                                <label for="">Detail</label>
                                <textarea class="form-control" id="detail" name="detail" rows="3">{{$car->detail}}</textarea>
                            </div>
                            <div class="form-group">
                                <input name="submit" type="submit" value="submit" class="btn btn-primary" >
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


</div>

@endsection
