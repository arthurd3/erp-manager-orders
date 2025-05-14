<?php
namespace App\Http\Controllers;
use App\Models\Cupom;

use Illuminate\Http\Request;

class CupomController extends Controller
{
    public function index()
    {
        $cupons = Cupom::all();
        return view('admin.cupons.index', compact('cupons'));
    }

    public function create()
    {
        return view('admin.cupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:cupons',
            'desconto' => 'required|numeric|min:0',
            'tipo_percentual' => 'required|boolean',
            'valor_minimo' => 'nullable|numeric|min:0',
            'validade' => 'required|date',
        ]);

        Cupom::create($request->all());

        return redirect()->back()->with('cupons.index', 'Cupom criado com sucesso.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
