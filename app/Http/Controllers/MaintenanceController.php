<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Machine;
use App\Http\Requests\MaintenanceRequest;
use Carbon\Carbon;
use DB;

class MaintenanceController extends Controller
{
    private $objMaintenance, $objMachine;

    public function __construct(){
        $this->objMaintenance = new Maintenance();
        $this->objMachine = new Machine();
    }

    public function index(Request $request, $machine){

        $machine = $this->objMachine->find($machine);
        $search =  $request->input('q');

        if($search!=""){
            $maintenances = Maintenance::where(function ($query) use ($machine, $search){
                $query->where('description', 'like', '%'.$search.'%');
                $query->where('machine_id', '=', $machine->id);
            })->paginate(5);
        }
        else{
            $maintenances = Maintenance::where('machine_id', '=', $machine->id)->paginate(5);
        }

        return view('maintenance/index',compact('machine','maintenances','search'));
    }

    public function create($machine){
        $machine = $this->objMachine->find($machine);

        return view('maintenance/create',compact('machine'));
    }

    public function store(MaintenanceRequest $request){
        $id_user = Auth::id(); 
        $dt = Carbon::parse($request->last_months)->addMonths($request->range_months);

        $cad = $this->objMaintenance->create([
            'description'     => $request->description,
            'range_hodometro' => $request->range_hodometro,
            'range_months'    => $request->range_months,
            'last_hodometro'  => $request->last_hodometro,
            'last_months'     => $request->last_months,
            'limit_hodometro' => ($request->last_hodometro + $request->range_hodometro),
            'limit_date'      => $dt,
            'machine_id'      => $request->machine_id,
            'user_id'         => $id_user
        ]);
        
        if($cad){
            session()->flash('message', 'Manutenção Cadastrada com sucesso.');
            return redirect('maintenance/'.$request->machine_id);
        }
    }

    public function edit($id){
        $maintenance = $this->objMaintenance->find($id);
        $machine = $this->objMachine->find($maintenance->machine_id);

        return view('maintenance/create', compact('maintenance','machine'));
    }

    public function update(MaintenanceRequest $request, $id){

        $dt = Carbon::parse($request->last_months)->addMonths($request->range_months);
        
        $update = $this->objMaintenance->where(['id'=>$id])->update([
            'description'     => $request->description,
            'range_hodometro' => $request->range_hodometro,
            'range_months'    => $request->range_months,
            'last_hodometro'  => $request->last_hodometro,
            'last_months'     => $request->last_months,
            'limit_hodometro' => ($request->last_hodometro + $request->range_hodometro),
            'limit_date'      => $dt
        ]);
        
        if($update){
            session()->flash('message', 'Manutenção Atualizada com sucesso.');
            return redirect('maintenance/'.$request->machine_id);
        }
    }

    public function destroy($id){
        $del = $this->objMaintenance->destroy($id);

        if($del){
            session()->flash('message', 'Manutenção deletada com sucesso');
        }

        return($del)?"sim":"não";
    }

    public function selectMachine(Request $request){

        $search =  $request->input('q');

        if($search!=""){
            $machines = Machine::where(function ($query) use ($search){
                $query->where('description', 'like', '%'.$search.'%')
                    ->orWhere('identification_number', 'like', '%'.$search.'%');
            })
            ->paginate(5);
        }else{
            $machines = Machine::paginate(5);
        }

        return view('machines/selectMachine',compact('machines', 'search'));
    }
 
    public function historic(Request $request,  $maintenance){
        
        $maintenance = DB::table('maintenances')
        ->select(DB::raw('maintenances.*,
        TIMESTAMPDIFF( DAY, CURRENT_DATE, limit_date) AS days,
        CAST(limit_hodometro as char) - machines.hodometro AS hodometro_balance'))
        ->join('machines', 'machines.id', '=', 'machine_id')
        ->where('maintenances.id', '=', $maintenance)->first();

        $machine = $this->objMachine->find($maintenance->machine_id);
        
        //Manutenções realizadas
        $queryCheks = DB::table('maintenance_checks')
            ->select(DB::raw('"Realização" as operation,
            maintenance_checks.created_at as data,
            hodometro,
            price as price,
            "" as mes, 
            note,
            name as user'))
            ->join('users', 'users.id', '=', 'user_id')
            ->where('maintenance_id', '=', $maintenance->id);
        
        //Manutenções adiadas
        $queryPostpones = DB::table('maintenance_postpones')
            ->select(DB::raw('"Adiamento" as operation,
            maintenance_postpones.created_at,
            postpone_hodometro,
            "" as price,
            postpone_months,
            note,
            name as user'))
            ->join('users', 'users.id', '=', 'user_id')
            ->where('maintenance_id', '=', $maintenance->id);

        $maintenances = $queryCheks->union($queryPostpones)->orderBy('data', 'desc')->get();

        return view('maintenance/show',compact('machine','maintenance','maintenances'));
    } 
}
