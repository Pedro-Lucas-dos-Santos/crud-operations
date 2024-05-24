<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{

    //CRUD

    //READ - LER
    public function index() {
        $produtos = Produto::where('ativo', 1)->get();

        return response()->json([
            "produtos" => $produtos
        ]);
    }

    //READ - LER
    public function getProduto($id) {
        $produto = Produto::where("id", $id)->get();

        if(!$produto) {
            return response()->json([
                "message" => "Produto não encontrado"
            ], 404);
        }

        return response()->json([
            "produto" => $produto
        ]);
    }

    //CREATE - CRIAR
    public function store(Request $request) {

        $produto = new Produto();
        $produto->name = $request->name;
        $produto->category = $request->category;
        $produto->price = $request->price;
        
        $produto->save();

        return response()->json([
            "mensagem" => "Produto criado com sucesso!",
            "produto" => $produto
        ]);
    }

    //UPDATE - ATUALIZAR
    public function update(Request $request, $id) {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        $produto = Produto::where("id", $id)->first();

        $produto->name = $validatedData['name'];
        $produto->category = $validatedData['category'];
        $produto->price = $validatedData['price'];


        $produto->save();

        return response()->json([
            "message" => "produto atualizado com sucesso!",
            "produto" => $produto
        ]);
    }

    //DELETE - DELETAR
    public function delete($id) {
        $produto = Produto::where("id", $id)->first();

        if(!$produto) {
            return response()->json([
                "message" => "produto não encontrado"
            ], 404);
        }

        $produto->ativo = 0;
        $produto->save();

        return response()->json([
            "message" => "produto deletado com sucesso!",
        ]);
    }
}
