<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Maintenance;
use App\Models\Machine;
use App\Models\MaintenanceCheck;
use App\Models\MaintenancePostpone;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->objMaintenance = new Maintenance();
        $this->objMachine = new Machine();
        $this->objMaintenanceCheck = new MaintenanceCheck();
        $this->objMaintenancePostpone = new MaintenancePostpone();
    }

    /**
     * Show the application dashboard.
     * @covers
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 

        $month = date('m');
        $year = date('Y');

        $total_maintenance = $this->objMaintenanceCheck->whereMonth('created_at',$month)->whereYear('created_at', $year)->count();
        $maintenance_expenses = $this->objMaintenanceCheck->whereMonth('created_at',$month)->whereYear('created_at', $year)->sum('price');
        $maintenance_postpones = $this->objMaintenancePostpone->whereMonth('created_at',$month)->whereYear('created_at', $year)->count();

        $expired_maintenance = DB::table('maintenances')
        ->select(DB::raw('machine_id,
        machines.description,
        machines.identification_number as id_number,
        count(*) as quant,
        "1" as status'))
        ->join('machines', 'machines.id', '=', 'machine_id')
        ->whereRaw('TIMESTAMPDIFF(DAY, CURRENT_DATE(), limit_date) <= ?', ['0'])
        ->orWhereRaw('CAST(limit_hodometro as char)  - machines.hodometro <= ?', ['0'])
        ->groupBy('machine_id','description','id_number');

        $data1 = Carbon::now();
        $data2 = Carbon::parse($data1)->addMonths(1);

        $maintenance_to_expire = DB::table('maintenances')
        ->select(DB::raw('machine_id,
        machines.description,
        machines.identification_number as id_number,
        count(*) as quant,
        "2" as status'))
        ->join('machines', 'machines.id', '=', 'machine_id')
        ->whereBetween('limit_date', [$data1, $data2])
        ->orWhere(function($query) {
            $query->whereRaw('CAST(limit_hodometro as char)  - machines.hodometro < ?', ['50'])
                  ->whereRaw('CAST(limit_hodometro as char)  - machines.hodometro > ?', ['0']);
        })
        ->groupBy('machine_id','description','id_number');

        $query = $expired_maintenance->union($maintenance_to_expire);

        $noticeMaintenance = $query->orderBy('status', 'asc')->orderBy('quant', 'desc')->get();
  
        return view('home',compact('total_maintenance', 'maintenance_expenses','maintenance_postpones', 'noticeMaintenance','year','month'));
    }
}
