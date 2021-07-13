<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelBook;
use App\User;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    private $objBook;
    private $objUser;

    public function __construct(){
        $this->objUser = new User();
        $this->objBook = new ModelBook();
    }

    public function index()
    {
        $books = $this->objBook->paginate(5);
        return view('books/index',compact('books'));
    }

    public function create()
    {
        $users = $this->objUser->all();
        return view('books/create',compact('users'));
    }

    public function store(BookRequest $request)
    {
        $cad = $this->objBook->create([
            'title'=>$request->title,
            'pages'=>$request->pages,
            'price'=>$request->price,
            'id_user'=>$request->id_user
        ]);
        if($cad){
            session()->flash('message', 'Livro Cadastrado com sucesso');
            return redirect('books');
        }

    }

    public function show($id)
    {
        $book = $this->objBook->find($id);
        return view('books/show',compact('book'));
    }

    public function edit($id)
    {
        $book = $this->objBook->find($id);
        $users= $this->objUser->all();
        return view('books/create',compact('book','users'));
    }

    public function update(Request $request, $id)
    {
        $this->objBook->where(['id'=>$id])->update([
            'title'=>$request->title,
            'pages'=>$request->pages,
            'price'=>$request->price,
            'id_user'=>$request->id_user
        ]);
        return redirect('books');
    }

    public function destroy($id)
    {
        $del = $this->objBook->destroy($id);
        return($del)?"sim":"não";
    }
}