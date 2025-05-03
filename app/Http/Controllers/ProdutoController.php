<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function __construct(){    
    	$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user_id = auth()->user()->id;

        $produtos = Produto::paginate(8);
        // $produtos = Produto::selectRaw('* from produtos')->get();
        return view('produto.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->all(['name','stock','price',  'description']);
        $produto = Produto::create($dados);
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view('produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        return view('produto.edit', ['produto'=>$produto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}
