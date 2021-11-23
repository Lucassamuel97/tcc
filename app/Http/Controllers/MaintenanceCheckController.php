<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Machine;
use App\Models\MaintenanceCheck;
use App\Models\MaintenancePostpone;
use Carbon\Carbon;
use DB;

class MaintenanceCheckController extends Controller
{
    private $objMaintenance, $objMachine, $objMaintenanceCheck, $objMaintenancePostpone;

    public function __construct(){
        $this->objMaintenance = new Maintenance();
        $this->objMachine = new Machine();
        $this->objMaintenanceCheck = new MaintenanceCheck();
        $this->objMaintenancePostpone = new MaintenancePostpone();
    }
    
    public function index(Request $request, $machine){  

        $machine = $this->objMachine->find($machine);
        $search =  $request->input('q');
        $order =  $request->input('order');
        
        if($machine){
            $query = DB::table('maintenances')
            ->select(DB::raw('maintenances.id,
            maintenances.description,
            maintenances.limit_date,
            TIMESTAMPDIFF( DAY, CURRENT_DATE, limit_date) AS days,
            maintenances.limit_hodometro,
            CAST(limit_hodometro as char) - machines.hodometro AS hodometro_balance'))
            ->join('machines', 'machines.id', '=', 'machine_id')
            ->where('machine_id', '=', $machine->id);

            switch ($order) {
                case '2':
                $query->orderBy('days', 'asc');
                    break;
                case '3':
                    $query->orderBy('maintenances.description', 'asc');
                    break;
                default:
                $query->orderBy('hodometro_balance', 'asc');
                    break;
            }
                       
            if($search!=""){
                $query->where('maintenances.description', 'like', '%'.$search.'%');
            }

            $maintenances = $query->paginate(5);
            
            return view('maintenanceCheck/index',compact('machine', 'maintenances', 'order', 'search'));
        }   
        return redirect('selectMachine');
    }

    public function accomplish(Request $request,  $machine){
        $id_user = Auth::id(); 
        $machine = $this->objMachine->find($machine);

        $cad = $this->objMaintenanceCheck->create([
            'maintenance_id' => $request->id,
            'user_id'        => $id_user,
            'price'          => $request->price,
            'note'           => $request->obs,
            'hodometro'      => $machine->hodometro
        ]);

        if($cad){
            $this->updateLastMaintenance($request->id,$machine->hodometro);
            session()->flash('message', 'Manutenção realizada com sucesso');
            return redirect($machine->id.'/maintenanceCheck');
        }
    }

    public function updateLastMaintenance($id, $hodometro){
        $maintenance = $this->objMaintenance->find($id);
        
        $maintenance->last_months = date('Y-m-d');
        $maintenance->last_hodometro = $hodometro;
        $maintenance->limit_hodometro = $hodometro + $maintenance->range_hodometro;
        $dt = Carbon::parse($maintenance->last_months)->addMonths($maintenance->range_months);
        $maintenance->limit_date = $dt;
        $maintenance->update();
    }


    public function postpone(Request $request,  $machine){
        $id_user = Auth::id(); 
        $maintenance = $this->objMaintenance->find($request->id);

        $cad = $this->objMaintenancePostpone->create([
            'maintenance_id'     => $request->id,
            'user_id'            => $id_user,
            'postpone_months'    => $request->postpone_months,
            'postpone_hodometro' => $request->postpone_hodometro,
            'note'               => $request->note
        ]);

        if($cad){
            $maintenance->limit_hodometro += $request->postpone_hodometro;
            $maintenance->limit_date = Carbon::parse($maintenance->limit_date)->addMonths($request->postpone_months);
            $maintenance->update();

            session()->flash('message', 'Manutenção realizada com sucesso');
            return redirect($machine.'/maintenanceCheck');
        }
    }

}
