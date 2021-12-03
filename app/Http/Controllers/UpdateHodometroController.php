<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\UpdateHodometro;

class UpdateHodometroController extends Controller
{
    private $objMachine, $objUpdateHodometro;

    public function __construct(){
        $this->objMachine = new Machine();
        $this->objUpdateHodometro = new UpdateHodometro();
    }

    public function index(Request $request){

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

        return view('updateHodometro/selectMachine',compact('machines', 'search'));
    }

    public function store(Request $request){
        $id_user = Auth::id(); 
        
        $cad = $this->objUpdateHodometro->create([
            'maintenance_id' => $request->id,
            'user_id'        => $id_user,
            'hodometro'      => $request->hodometro
        ]);
        
        if($cad){
            
            $this->objMachine->where(['id'=>$request->id])->update([
                'hodometro' => $request->hodometro
            ]);
            
            $machine = $this->objMachine->find($request->id);
            //Retorna quantidade de manutenções expiradas
            $maintenances = $machine->relMaintenances()->whereRaw("(CAST(limit_hodometro as char) - $request->hodometro) <= 0")->count();
                            
            session()->flash('message', 'Hodômetro atualizado com sucesso.');
            session()->flash('maintenance', [$machine->id, $machine->description, $maintenances]);
            return redirect('updateHodometro/');
        }
    }
}
