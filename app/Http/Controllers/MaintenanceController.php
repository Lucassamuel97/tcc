<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Machine;
use App\Http\Requests\MaintenanceRequest;

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

        $cad = $this->objMaintenance->create([
            'description'     => $request->description,
            'range_hodometro' => $request->range_hodometro,
            'range_months'    => $request->range_months,
            'last_hodometro'  => $request->last_hodometro,
            'last_months'     => $request->last_months,
            'machine_id'      => $request->machine_id,
            'user_id'         => $id_user
        ]);

        if($cad){
            session()->flash('message', 'Manutenção Cadastrada com sucesso.');
            return redirect('machines');
        }
    }

    public function edit($id){
        $maintenance = $this->objMaintenance->find($id);
        $machine = $this->objMachine->find($maintenance->machine_id);

        return view('maintenance/create', compact('maintenance','machine'));
    }

    public function update(MaintenanceRequest $request, $id){
        
        $update = $this->objMaintenance->where(['id'=>$id])->update([
            'description'     => $request->description,
            'range_hodometro' => $request->range_hodometro,
            'range_months'    => $request->range_months,
            'last_hodometro'  => $request->last_hodometro,
            'last_months'     => $request->last_months
        ]);
        
        if($update){
            session()->flash('message', 'Manutenção Atualizada com sucesso.');
            return redirect('maintenance/'.$request->machine_id);
        }
    }

    public function destroy($id){
        //
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

}
