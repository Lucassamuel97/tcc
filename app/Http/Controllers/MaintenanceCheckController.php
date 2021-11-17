<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Machine;
use App\Models\MaintenanceCheck;
use DB;

class MaintenanceCheckController extends Controller
{
    private $objMaintenance, $objMachine;

    public function __construct(){
        $this->objMaintenance = new Maintenance();
        $this->objMachine = new Machine();
        $this->objMaintenanceCheck = new MaintenanceCheck();
    }
    
    public function index(Request $request, $machine){  

        $machine = $this->objMachine->find($machine);
        $search =  $request->input('q');
        $order =  $request->input('order');
        
        if($machine){
            $query = DB::table('maintenances')
            ->select(DB::raw('maintenances.id, maintenances.description, date_add( last_months, INTERVAL range_months MONTH ) AS limit_date, 
            TIMESTAMPDIFF( DAY, CURRENT_DATE, ( date_add( last_months, INTERVAL range_months MONTH ) ) ) AS days, 
            last_hodometro + range_hodometro AS limit_hodometro,
            CAST((last_hodometro + range_hodometro )AS CHAR) - machines.hodometro AS hodometro_balance '))
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
        $update = $this->objMaintenance->where(['id'=>$id])->update([
            'last_hodometro'  => $hodometro,
            'last_months'     => date('Y-m-d')
        ]);
    }

    public function edit($id){
        
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
