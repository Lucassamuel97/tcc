<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Machine;
use App\User;
use DB;
use PDF;

class ReportController extends Controller
{

	private $objUser;

	public function __construct(){
        $this->objUser = new User();
    }

    public function filterMaintenance(){
        
        $users = DB::table('users')->orderBy('name', 'asc')->get();
        $machines = DB::table('machines')->orderBy('description', 'asc')->get();

        return view('reports/create',compact('users','machines'));
    }

    public function maintenanceReport(Request $request){

        $filter = "";

        //Manutenções realizadas
        $queryCheks = DB::table('maintenance_checks')
            ->select(DB::raw('maintenance_checks.created_at as data,
            maintenances.description,
            maintenance_checks.note,
            "Realizada" as status,
            machines.identification_number,
            machines.description machine,
            users.name'))
            ->join('users', 'users.id', '=', 'user_id')
            ->join('maintenances', 'maintenance_checks.maintenance_id', '=', 'maintenances.id')
            ->join('machines', 'machine_id', '=', 'machines.id');

        //Manutenções adiadas
        $queryPostpones = DB::table('maintenance_postpones')
            ->select(DB::raw('maintenance_postpones.created_at as data,
            maintenances.description,
            maintenance_postpones.note,
            CONCAT("Adiada em ",postpone_months,"m ",postpone_hodometro,"h" ) as status,
            machines.identification_number,
            machines.description machine,
            users.name'))
            ->join('users', 'users.id', '=', 'user_id')
            ->join('maintenances', 'maintenance_postpones.maintenance_id', '=', 'maintenances.id')
            ->join('machines', 'machine_id', '=', 'machines.id');

        if (!Auth::user()->is_admin) {   
            $request->user = Auth::id(); 
        }

        //Filtra usuario
        if($request->user){
            $queryCheks->where('users.id', '=', $request->user);
            $queryPostpones->where('users.id', '=', $request->user);
            $filter.= " Usuário cod:".$request->user;
        }
        //Filtra maquinario        
        if($request->machine){
            $queryCheks->where('machines.id', '=', $request->machine);
            $queryPostpones->where('machines.id', '=', $request->machine);
            $filter.= " - Maquinário cod:".$request->machine;
        } 

        if($request->initial_date){
            $queryCheks->where('maintenance_checks.created_at', '>=', $request->initial_date);
            $queryPostpones->where('maintenance_postpones.created_at', '>=', $request->initial_date);
            $filter.= " - Data inicial:".date('d/m/Y', strtotime($request->initial_date));
        }
        if($request->final_date){
            $queryCheks->where('maintenance_checks.created_at', '<=', $request->final_date);
            $queryPostpones->where('maintenance_postpones.created_at', '<=', $request->final_date);
            $filter.= " - Data final:".date('d/m/Y', strtotime($request->final_date));
        } 

        //Filtra realizadas ou adiadas
        if($request->status == 1){
            $query = $queryCheks;
            $filter.= " - Status: Realizada";
        }else if($request->status == 2){
            $query = $queryPostpones;
            $filter.= " - Status: Adiada";
        }else{
            $query = $queryCheks->union($queryPostpones);
        }
   
        $maintenances = $query->orderBy('data', 'asc')->get();

        $pdf = PDF::loadView('reports/maintenance', compact('maintenances','filter'));
        
        return $pdf->setPaper('a4')->stream('Relatorio Manutencao');
    }
    
    public function filterMaintenanceExpenses(){
        $users = DB::table('users')->orderBy('name', 'asc')->get();
        $machines = DB::table('machines')->orderBy('description', 'asc')->get();

        return view('reports/expenses', compact('users','machines'));
    }

    public function maintenanceExpenses(Request $request){
        $filter = "";

        //Manutenções realizadas
        $queryCheks = DB::table('maintenance_checks')
            ->select(DB::raw('maintenance_checks.created_at as data,
            maintenances.description,
            maintenance_checks.note,
            maintenance_checks.price,
            machines.identification_number,
            machines.description machine,
            users.name'))
            ->join('users', 'users.id', '=', 'user_id')
            ->join('maintenances', 'maintenance_checks.maintenance_id', '=', 'maintenances.id')
            ->join('machines', 'machine_id', '=', 'machines.id');

        if (!Auth::user()->is_admin) {   
            $request->user = Auth::id(); 
        }
        
        //Filtra usuario
        if($request->user){
            $queryCheks->where('users.id', '=', $request->user);
            $filter.= " Usuário cod:".$request->user;
        }
        //Filtra maquinario        
        if($request->machine){
            $queryCheks->where('machines.id', '=', $request->machine);
            $filter.= " - Maquinário cod:".$request->machine;
        } 
        if($request->initial_date){
            $queryCheks->where('maintenance_checks.created_at', '>=', $request->initial_date);
            $filter.= " - Data inicial:".date('d/m/Y', strtotime($request->initial_date));
        }
        if($request->final_date){
            $queryCheks->where('maintenance_checks.created_at', '<=', $request->final_date);
            $filter.= " - Data final:".date('d/m/Y', strtotime($request->final_date));
        } 

        $maintenances = $queryCheks->orderBy('data', 'asc')->get();
        $pdf = PDF::loadView('reports/maintenance_expenses', compact('maintenances','filter'));
        
        return $pdf->setPaper('a4')->stream('Relatorio Gastos com Manutencões');
    }
}