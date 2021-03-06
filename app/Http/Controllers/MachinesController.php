<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Http\Requests\MachineRequest;
use QRCode;

class MachinesController extends Controller
{
    private $objMachine;

    public function __construct(){
        $this->objMachine = new Machine();
    }

    public function index(Request $request){

        $search =  $request->input('q');

        if($search!=""){
            $machines = Machine::where(function ($query) use ($search){
                $query->where('description', 'like', '%'.$search.'%')
                    ->orWhere('identification_number', 'like', '%'.$search.'%');
            })
            ->paginate(5);
            $machines->appends(['q' => $search]);
        }
        else{
            $machines = Machine::paginate(5);
        }

        return view('machines/index',compact('machines', 'search'));
    }

    public function create(){
      return view('machines/create');
    }

    public function store(MachineRequest $request){
        $cad = $this->objMachine->create([
            'description'           => $request->description,
            'status'                => $request->status,
            'manufacturer'          => $request->manufacturer,
            'identification_number' => $request->identification_number,
            'engine_number'         => $request->engine_number,
            'serial_number'         => $request->serial_number,
            'mounting_number'       => $request->mounting_number,
            'year_manufacture'      => $request->year_manufacture,
            'model'                 => $request->model,
            'hodometro'             => $request->hodometro
        ]);

        if($cad){
            session()->flash('message', 'Máquinario Cadastrado com sucesso');
            return redirect('machines');
        }
    }

    public function edit($id){
        $machine = $this->objMachine->find($id);


        return view('machines/create',compact('machine'));
    }

    public function update(MachineRequest $request, $id){
        $this->objMachine->where(['id'=>$id])->update([
            'description'           => $request->description,
            'status'                => $request->status,
            'manufacturer'          => $request->manufacturer,
            'identification_number' => $request->identification_number,
            'engine_number'         => $request->engine_number,
            'serial_number'         => $request->serial_number,
            'mounting_number'       => $request->mounting_number,
            'year_manufacture'      => $request->year_manufacture,
            'model'                 => $request->model,
            'hodometro'             => $request->hodometro
        ]);
        return redirect('machines');
    }

    public function show($id)
    {
        $machine = $this->objMachine->find($id);
        return view('machines/show', compact('machine'));
    }

    public function destroy($id)
    {
        $del = $this->objMachine->destroy($id);

        if($del){
            session()->flash('message', 'Máquinario deletado com sucesso');
        }else{
            session()->flash('message', 'Erro ao deletar o maquinário');
        }

        return($del)?"sim":"não";
    }

    public function qrcode($machine)
    {   
        $machine = $this->objMachine->find($machine);
        $img = QRCode::url(url('/updateHodometro?q='.$machine->identification_number))
                  ->setSize(8)
                  ->setMargin(2)
                  ->png();
        return response($img)->header('Content-type','image/png');
    }

    public function qrcodePrint($machine)
    {
        $machine = $this->objMachine->find($machine);
        return view('machines/qrcode', compact('machine'));
    }
}
