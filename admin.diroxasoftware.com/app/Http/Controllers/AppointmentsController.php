<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Appointment;
use  App\Customer;
use App\allappointmentinformation;
use DB;

class AppointmentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id = null)
    {
        $start = date('d/m/Y');
        $end = date('d/m/Y');


        if($id == null){
            $allAppointment = allappointmentinformation::all();
            $searchingAlertSection = null;
            $foundCustomer = null;
        }
        else{
            $allAppointment = allappointmentinformation::where('customerId', 'LIKE', $id)->get();
            $foundCustomer = Customer::find($id);
            $searchingAlertSection = null;
       }


        return view('sections.appointments.index', compact('foundCustomer','allAppointment','searchingAlertSection', 'start', 'end'));
    }

    public function create()
    {
        $allAppointment = Appointment::all();
        $allcustomers = Customer::all();

        return view('sections.appointments.create', compact('allcustomers', 'allAppointment'));
    }

    public function store(Request $request)
    {

        $name = $request->name;
        $about = $request->about;
        $appointmentDate = $request->appointmentDate;

        $name == null ? $name =  'Appointment Title' : $name = $name;
        $about == null ? $about =  'About Title' : $about = $about;

        if($appointmentDate == null)
        {
            return redirect()
            ->back();
        }


        $addAppointment = new Appointment();
        $addAppointment->name = $name;
        $addAppointment->customerId = $request->customerId;
        $addAppointment->about = $about;
        $addAppointment->appointmentDate = $request->appointmentDate;
        $addAppointment->appointmentHoursDate = $request->appointmentDate;
        $addedAppointment = $addAppointment->save();

        if($addedAppointment)
        {
            return redirect()
            ->route('appointments.index')
            ->with('success',  'The Appointment was successful added!' );
        }

    }


    public function edit($id)
    {
         $allAppointment = Appointment::find($id);
        return view('sections.appointments.edit', compact('allAppointment'));
    }


    public function update(Request $request)
    {
        $name = $request->name;
        $about = $request->about;

        $name == null ? $name =  'Appointment Title' : $name = $name;
        $about == null ? $about =  'About Title' : $about = $about;


        $appointment = Appointment::find($request->appointmentId);
        if(isset($appointment)){

        $appointment->name = $name;
        $appointment->about = $about;
        $updateappointment = $appointment->save();

        if($updateappointment){
            return redirect()
            ->route('appointments.index')
            ->with('success',  'The Appointment was successfull edited!' );
        }

        else
                return redirect()
                ->back();
        }
    }

    public function destroy($id)
    {
        $deleteAppointment = Appointment::find($id)->delete();
        // $deleteproducts2 = products_machines::where('product_id', 'LIKE', $id)->delete();
        // {$deleteproducts = products_machines::where('product_id', 'LIKE', $id)->delete();}


        if($deleteAppointment){
            return redirect()
                    ->route('appointments.index')
                    ->with('success',  'The Appointment was successful removed' );
            }

            else
            {
                $response='';
                return redirect()
                            ->back()
                            ->with('error');
             }

    }

    public function appointmentsajax (Request $request)
    {
        $start = $request->dataComecoPadraoDateTime;
        $end = $request->dataFimPadraoDateTime;

        // return $a = [$start, $end];

        if($start == null || $end == null)
        {
            $allAppointment = Appointment::all();
            $searchingAlertSection = null;
        }

        else{
            $searchingAlertSection = "searching";
            // general balance value
            $allAppointment  =  DB::table('appointments')
            ->select(DB::raw('*'))
            ->whereBetween('appointmentDate', [$start, $end])
            ->get();
        }

        return view('sections.appointments.index', compact('allAppointment', 'start', 'end', 'searchingAlertSection'));

    }

}
