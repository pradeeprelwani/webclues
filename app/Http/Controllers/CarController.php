<?php

namespace App\Http\Controllers;

use App\User;
use App\Car;
use App\Colour;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CarRepository;

class CarController extends Controller {

    protected $base;
    protected $car;

    public function __construct() {
        $this->base = new BaseRepository(new Car());
        $this->car = new CarRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            return datatables($this->car->carListing())
                            ->addColumn('status', function ($cars) {
                                if ($cars->status === 'Active') {
                                    $class = "success";
                                    $lable = "Activate";
                                } else {
                                    $class = "danger";
                                    $lable = "InActive";
                                }
                                return $status = '<span class="badge badge badge-' . $class . '">' . $lable . '</span>';
                            })
                            ->addColumn('colour', function ($cars) {
                                return $cars->colour->name;
                            })
                            ->addColumn('icon', function ($cars) {
                                $profile = $cars->icon_url;
                                return '<img src="' . $profile . '" height="70px" width="70px">';
                            })
                            ->addColumn('action', function ($cars) {
                                return '<a href="' . route('car.edit', $cars->id) . '"    class="btn btn-primary" title="Edit">Edit</a>';
                            })
                            ->rawColumns(['status', 'icon', 'action'])
                            ->make(true);
        }
        return view('car.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $data['colors'] = Colour::where('status', 'Active')->get();
        return view('car.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        dd($request->all());
        $picture = $data = [];
        $this->validate($request, ['name' => 'required',
            'color_id' => 'required',
            'icon' => 'required|image',
            'picture.*' => 'image',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'status'=>'required','in:active,inactive']);
        try {
            $data = $request->except('_token');
            if ($request->icon) {
                $data['icon'] = $this->uploadFile($request->file('icon'));
            }
            if ($request->hasfile('picture')) {
                $picture = $this->uploadMultiple($request->file('picture'));
            }
            
            if ($this->car->createCar($data, $picture)) {
                return ['message' => 'Car create', 'status' => true];
            }
        } catch (\Exception $e) {
            return ['message' => $e->getMessage(), 'status' => false];
        }
    }

    public function edit(Request $request, $id) {
        $data['colors'] = Colour::where('status', 'Active')->get();
        $data['car'] = $this->base->show($id);
        return view('car.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id) {
        
        $picture = $data = [];
        $this->validate($request, [
            'name' => 'required',
            'color_id' => 'required',
            'icon' => 'image',
            'picture.*' => 'image',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required']);
        try {
            $data = $request->except('_token','submit','picture');
            if ($request->icon) {
                $data['icon'] = $this->uploadFile($request->file('icon'));
            }
            if ($request->hasfile('picture')) {
                $picture = $this->uploadMultiple($request->file('picture'));
            }
           
            if ($this->car->updateCar($id,$data, $picture)) {
                return ['message' => 'Car update', 'status' => true];
            }
        } catch (\Exception $e) {
            return ['message' => $e->getMessage(), 'status' => false];
        }
    }

    private function uploadFile($image) {
        $name = 'icon_' . time() . '.' . $image->getClientOriginalName();
        $image->move(public_path() . '/image/', $name);

        return $name;
    }

    private function uploadMultiple($image) {
        $data = [];

        foreach ($image as $file) {
            $name = time() . '.' . $file->getClientOriginalName();
            $file->move(public_path() . '/image/', $name);
            $data[] = $name;
        }
        return $data;
    }

}
