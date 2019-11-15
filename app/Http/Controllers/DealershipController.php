<?php

namespace App\Http\Controllers;

use Image;
use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DealershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::with('car_model')->get();

        return view('car-dealership.index', compact('cars'));
    }

    public function adminIndex()
    {
        $cars = Car::with('car_model')->get();

        return view('admin-layouts.car-dealership', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_car = new Car();
        $new_car->name = request('name');
        $new_car->price = request('price');
        $new_car->tax = request('tax');
        $new_car->car_model_id = request('car_model_id');
        $new_car->full_price = request('full_price');

        if($request->get('front_view')) {
            $imagefront = $request->get('front_view');
            $namefront = time().'.' . explode('/', explode(':', substr($imagefront, 0, strpos($imagefront, ';')))[1])[1];
            Image::make($imagefront)->resize(1080, 720)->save(public_path('\images\uploaded_cars_front/').$namefront);
            $new_car->front_view = $namefront;

        } else {
            $namefront = 'noimage.jpg';
            $new_car->front_view = $namefront;
        }

        if($request->get('back_view')) {
            $imageback = $request->get('back_view');
            $nameback = time().'.' . explode('/', explode(':', substr($imageback, 0, strpos($imageback, ';')))[1])[1];
            Image::make($imageback)->resize(1080, 720)->save(public_path('\images\uploaded_cars_back/').$nameback);
            $new_car->back_view = $nameback;
        } else {
            $nameback = 'noimage.jpg';
            $new_car->back_view = $nameback;
        }

        $new_car->save();


        return Car::where('id', $new_car->id)->with('car_model')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Car::find($id)->update($request->all());

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        Storage::delete(public_path('\images\uploaded_cars_front/') . $car->front_view);
        Storage::delete(public_path('\images\uploaded_back_front/') . $car->back_view);

        $car->delete();

        return $car;
    }
}
