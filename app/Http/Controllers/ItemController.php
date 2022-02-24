<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Contract;
use App\Models\Item;

class ItemController extends Controller
{
    public function create(Request $request){

        $unitary_value = Str::of($request->unitary_value)->replace('.', '');
        $unitary_value = Str::of($unitary_value)->replace(',', '.');

        $total_value = Str::of($request->total_value)->replace('.', '');
        $total_value = Str::of($total_value)->replace(',', '.');

        $item = new Item;

        $item->description = $request->description;
        $item->unitary_value = $unitary_value;
        $item->quantity = $request->quantity;
        $item->total_value = $total_value;
        $item->unity = $request->unity;
        $item->contract_id = $request->contract_id;

        if($item->save()){
            return redirect()->route('manageContract', ['id'=>$item->contract_id])->with('msg', 'Contrato Salva com sucesso!');                
        }else{
            return redirect()->route('contract')->with('msg', 'Não foi possível salvar o contrato!');
        }

    }

    public function delete($id){
        $item = Item::find($id);

        if($item->delete()){
            return redirect()->route('manageContract', ['id'=>$item->contract_id])->with('msg', 'apagado com sucesso!');                
        }else{
            return redirect()->route('contract')->with('msg', 'Não foi possível apagar o item!');
        }
    }
}
