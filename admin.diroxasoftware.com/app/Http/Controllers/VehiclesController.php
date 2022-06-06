<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vehicle;


class VehiclesController extends Controller
{
    public function index()
    {
        $allvehicles = Vehicle::all();

        return view('sections.vehicles.index', compact('allvehicles'));
        
    }


    public function create()
    {
        return view('sections.vehicles.create');

    }

    public function store(Request $request)
    {
        Vehicle::create($request->all());
        return redirect()->route('vehicle.index');
    }

    public function edit($id)
    {
        $allvehicles = Vehicle::find($id);
        return view('sections.vehicles.edit', compact('allvehicles'));
    }


    public function destroy($id)
    {
        $deletevehicle = Vehicle::find($id)->delete();

        if($deletevehicle){
            return redirect()
                        ->route('vehicle.index')
                        ->with('success',  'The Vehicle was successful removed !' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }



    public function update(Request $request, $id)
    {

        // 'plate', 'brand',  'model', 'colour', 'year', 'owner'

        $vehicle = Vehicle::find($id);
            if(isset($vehicle)){
            $vehicle->plate = $request->input('plate');
            $vehicle->brand = $request->input('brand');
            $vehicle->model = $request->input('model');
            $vehicle->colour = $request->input('colour');
            $vehicle->year = $request->input('year');
            $vehicle->owner = $request->input('owner');
            $updatevehicles = $vehicle->save();

            if($updatevehicles){
            return redirect()
                        ->route('vehicle.index')
                        ->with('success',  'The vehicle was successful update' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }

    }
}
