<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Order;
use App\Models\Item;

class OrderController extends Controller
{
    public function setCreate($id){
        $contract = Contract::find($id);
        $items = $contract->items;

        if($contract->category == "M"){
            $title_orders = "Pedido";
        }elseif($contract->category == "A"){
            $title_orders = "Pedido";
        }elseif($contract->category == "P"){
            $title_orders = "Ordem de Serviço";
        }else{
            $title_orders = "Ordem de Serviço";
        }

        return view('order.formOrder', ['route'=>'addOrderPost', 'action'=>'create', 'items'=>$items, 'contract'=>$contract, 'title_orders'=>$title_orders]);

    }

    public function create(Request $request){

        $order = new Order;

        $items_quantity = count($request->items);
        $quantities = $request->quantities;
        $items = $request->items;
        $order_items = array();

        $amount = 0;
        for($i = 0 ; $i<$items_quantity ; $i++){
            $item = Item::find($items[$i]);
            $amount = $amount + ($item->unitary_value * $quantities[$i]);
            $order_items[$items[$i]] = ['quantity'=>$quantities[$i]];
        }
        
        $order->date_order = $request->date_order;
        $order->description = $request->description;
        $order->responsible = $request->responsible;
        $order->contract_id = $request->contract_id;
        $order->amount = $amount;
        $order->status = "aberto";

        if($order->save()){
            $order->items()->sync($order_items);
            return redirect()->route('manageContract', ['id'=>$order->contract_id])->with('msg', 'Pedido ou Ordem de serviço realizada com sucesso!');                
        }else{
            return redirect()->route('contract')->with('msg', 'Não foi possível salvar o pedido / Ordem de serviço!');
        }

    }

    public function detail($id){
        $order = Order::find($id);
        $items = $order->items;

        if($order->contract->school_id == session('school')->id){
            return view('order.detailOrder', ['order'=>$order, 'items'=>$items]);
        }else{
            return redirect()->route('manageContract', ['id'=>$order->contract_id])->with('msg', 'Você não tem acesso a esse pedido / ordem de serviço');
        }

        
    }

    public function delete($id){
        $order = Order::find($id);

        if($order->contract->school_id == session('school')->id){
            $order->delete();
            return redirect()->route('manageContract', ['id'=>$order->contract_id])->with('msg', 'excluído com sucesso');
        }else{
            return redirect()->route('manageContract', ['id'=>$order->contract_id])->with('msg', 'Você não tem acesso a esse pedido / ordem de serviço');
        }
    }

    public function setUpdate($id){
        $order = Order::find($id);

        dd($order);
    }
}
