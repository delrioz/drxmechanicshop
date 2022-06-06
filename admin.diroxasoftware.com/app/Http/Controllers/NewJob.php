<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Customer;

class NewJob extends Controller
{
    public function index()
    {
        $allcustomers = Customer::all();
        return view('newjob.create', compact('allcustomers'));
    }

    public function store(Request $request)
    {
        Service::create($request->all());
       return redirect()->route('newjob.list');

    }

    public function list()
    {
        $jobs = Service::all();
        return view('newjob.list', compact('jobs'));
    }

    public function destroy($id)
    {
        $deletejobs = Service::find($id)->delete();

            if($deletejobs){
                return redirect()
                            ->route('newjob.list')
                            ->with('success',  'A ordem de serviço foi deletada com sucesso!' );
                }


                else
                {
                    return redirect()
                                ->back()
                                ->with('error', $response['message']);

                }
    }


    public function edit($id)
    {
        
        $findservice = Service::find($id);
        
        return view('newjob.edit', compact('findservice'));
    }
    

    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if(isset($service))
        {
            // name,type,about,client,machineName
            $service-> name = $request->input('name');
            $service-> type = $request->input('type');
            $service-> about = $request->input('about');
            $service-> client = $request->input('client');
            $service-> machineName = $request->input('machineName');
            $updateservice =  $service->save();

            if($updateservice)
            {
              return redirect()
                       ->route('newjob.list')
                       ->with('success', 'The update was successful');
            }
    
            else 
            {  
               return redirect() 
               ->back()
               ->with('error', 'Was not possible update');
            }

        } 
        
    }

}
