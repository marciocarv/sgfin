@extends('layouts.site')

@section('content')
<div class="w-full px-4 mx-auto md:px-10">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('manageContract', ['id'=>$contract->id])}}" class="p-3 mb-5 text-white bg-gray-800 rounded hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
    <h1 class="mt-5 text-2xl font-bold"><i class="fas fa-file-contract"></i> @if($action == 'update') Edite seu  {{$title_orders}} @else Cadastre o {{$title_orders}} @endif</h1>
  </div>
  @if (session('msg'))
    <p class="p-4 mb-3 font-bold leading-normal text-green-800 bg-green-300 rounded-lg">{{ session('msg') }}</p>
  @endif
  
  <form id="register-form" class="block w-full max-w-2xl p-3 mt-5 border rounded shadow" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$order->id}}" name="id"/>
    @endif
      <input type="hidden" value="{{$contract->id}}" name="contract_id"/>
    <div class="relative w-full mb-3">
      <label
        class="block mb-2 text-xs font-bold text-gray-700 uppercase"
        for="grid-password"
        >Data do Pedido
          @error('date_order')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      ><input
        type="date"
        name="date_order"
        required
        id="date_order"
        @if ($action == 'update')
          value="{{$order->date_order->format('Y-m-d')}}"
        @else
          value="{{old('date_order')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('date_order') border-2 border-pink-600 @enderror"
        placeholder="Data de recebimento do recurso"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block mb-2 text-xs font-bold text-gray-700 uppercase"
        for="grid-password"
        >Descrição
          @error('description')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      ><input
        type="text"
        name="description"
        required
        id="description"
        @if ($action == 'update')
          value="{{$order->description}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('description') border-2 border-pink-600 @enderror"
        placeholder="A que se destina o pedido"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block mb-2 text-xs font-bold text-gray-700 uppercase"
        for="grid-password"
        >Servidor Responsável
          @error('responsible')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      ><input
        type="text"
        name="responsible"
        required
        id="responsible"
        @if ($action == 'update')
          value="{{$order->responsible}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('responsible') border-2 border-pink-600 @enderror"
        placeholder="Informe o responsável pelo pedido e recebimento"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block mb-2 text-xs font-bold text-gray-700 uppercase"
        for="grid-password"
        >Produtos / Serviços
        </label>
        @if($items->isEmpty())
          Não há Produtos / Serviços
        @endif
        @foreach ($items as $item)
          <div class="p-4">
            <input 
              type="checkbox"
              value="{{$item->id}}"
              name="items[]"
              @if($action == 'update' && $items_order->where('id', $item->id)->isNotEmpty())
              checked
              @endif
              id="item{{$item->id}}" />
              {{$item->description}}&nbsp;
              <input type="number"
                id="quantity{{$item->id}}"
                @if($action == 'update' && $items_order->where('id', $item->id)->isNotEmpty())
                value="{{$items_order->where('id', $item->id)->first()->pivot->quantity}}"
                name="quantities[]"
                @else
                readonly
                name="nocounted"
                @endif
                class="px-1 py-1 text-sm text-gray-700 placeholder-gray-400 rounded shadow focus:outline-none focus:shadow-outline " />
              <span id="disponivel{{$item->id}}" class="hidden text-xs text-green-500">Disponível: {{$item->quantity}} |
                 Valor Unitário: {{number_format($item->unitary_value, 2, ',', '.')}}</span>
          </div>
        @endforeach
    </div>
    <div class="mt-6 text-center">
      <button
        class="w-full max-w-xs px-6 py-3 mb-1 mr-1 text-sm font-bold text-white uppercase bg-gray-900 rounded shadow outline-none active:bg-gray-700 hover:shadow-lg focus:outline-none"
        type="submit"
        id="btn-submit"
        style="transition: all 0.15s ease 0s;"
      >
        Salvar
      </button>
      <p id="error-validation" class="absolute hidden text-xs text-red-600"></p>
    </div>
  </form>
</div>
@endsection
            
@section('script')

<script charset="utf-8" type="text/javascript">

@foreach ($items as $item)
  
  document.querySelector('#item{{$item->id}}').addEventListener('click', ()=>{
    if(document.querySelector('#item{{$item->id}}').checked){
      document.querySelector('#quantity{{$item->id}}').removeAttribute('readonly');
      document.querySelector('#disponivel{{$item->id}}').classList.remove('hidden');
      document.querySelector('#quantity{{$item->id}}').classList.add('border-2');
      document.querySelector('#quantity{{$item->id}}').setAttribute('required', 'required');
      document.querySelector('#quantity{{$item->id}}').setAttribute('name', 'quantities[]');
    }else{
      document.querySelector('#quantity{{$item->id}}').setAttribute('readonly', 'readonly');
      document.querySelector('#disponivel{{$item->id}}').classList.add('hidden');
      document.querySelector('#quantity{{$item->id}}').classList.remove('border-2');
      document.querySelector('#quantity{{$item->id}}').removeAttribute('required');
      document.querySelector('#quantity{{$item->id}}').value = "";
      document.querySelector('#quantity{{$item->id}}').setAttribute('name', 'nocounted');
    }
  });

@endforeach

</script>

@endsection


