@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
    <a href="{{route('accountability')}}" class="p-3 bg-gray-800 text-white rounded"><i class="fas fa-undo-alt"></i> Voltar</a>
    <div class="">
        <h1 class="mt-5 text-2xl font-bold text-center"><i class="fas fa-file-contract"></i> Prestação de Contas - {{$accountability->description}}</h1>
    </div>
    <div class="flex flex-wrap justify-center mt-5">
        @foreach($accFormats as $accFormat)
        <div class="lg:w-auto m-3 p-3"><button
            class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg hover:bg-gray-600 outline-none focus:outline-none mx-3 w-full max-w-xs"
            type="submit"
            id="btn-submit"
            onclick="mostrar({{$loop->index}})"
            style="transition: all 0.15s ease 0s;"
            >{{$accFormat->description}}
        </button>
        </div>
        @endforeach
    </div>
    @foreach($accFormats as $accFormat)
    <div class="w-full border border-teal-700 shadow p-3 hidden" id="div{{$loop->index}}">
        <div class="text-center font-bold text-2xl uppercase">
            <h1>{{$accFormat->description}} - {{$accFormat->mes_inicial}} a {{$accFormat->mes_final}}</h1>
        </div>
        <div class="flex flex-wrap justify-between rounded border shadow mt-5 mb-2">
            <p class="font-semibold text-1xl m-5">Saldo Anterior: <span class="font-bold">R$ {{number_format($accFormat->previous_ballance, 2, ',', '.')}}</span></p>
            <p class="font-semibold text-1xl m-5">Entradas: <span class="font-bold text-green-600">R$ + {{number_format($accFormat->income, 2, ',', '.')}}</span></p>
            <p class="font-semibold text-1xl m-5">Saídas: <span class="font-bold text-red-600">R$ - {{number_format($accFormat->expenditure, 2, ',', '.')}}</span></p>
            <p class="font-semibold text-1xl m-5">Saldo Final: <span class="font-bold">R$ {{number_format($accFormat->ballance, 2, ',', '.')}}</span></p>
        </div>
        <div class="mt-5 mb-2">
            <h1 class="text-center font-bold uppercase">Arquivos</h1>
            <table class="border-collapse w-full mt-5">
                <tbody>
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-left block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"></span>
                            <ul class="text-lg font-bold">
                                <li>
                                    <i class="fas fa-file-invoice-dollar"></i> 
                                    <a href="{{route('capa', ['id'=>$accFormat->id])}}" target="_blank" class="hover:text-gray-700">Capa Prestação de Contas</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-invoice-dollar"></i> 
                                    <a href="{{route('rerd', ['id'=>$accFormat->id])}}" target="_blank" class="hover:text-gray-700">Relação de Execução de Receitas e despesas</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-invoice-dollar"></i> 
                                    <a href="">Resumo Financeiro - PNAE</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-invoice-dollar"></i> 
                                    <a href="">Demonstrativo de Execução de Receitas e despesas - PDDE</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-invoice-dollar"></i> 
                                    <a href="">Relação de Alimentos - PNAE</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-invoice-dollar"></i> 
                                    <a href="{{route('relPagamento', ['id'=>$accFormat->id])}}" target="_blank" class="hover:text-gray-700">Relação de Pagamentos</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-invoice-dollar"></i> 
                                    <a href="">Relação de Béns</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-invoice-dollar"></i> 
                                    <a href="">Termo de doação</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-invoice-dollar"></i> 
                                    <a href="">Reprogramação de Saldo</a>
                                </li>
                                <li>
                                    <i class="fas fa-file-invoice-dollar"></i> 
                                    <a href="">Parecer do Conselho Fiscal</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-left block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Gestão / Reforma</span>
                            <ul>
                                <li><i class="fas fa-file-invoice-dollar"></i> <a href="">Pesquisa de preço</a></li>
                                <li><i class="fas fa-file-invoice-dollar"></i> <a href="">Verificação de Menor Preço</a></li>
                                <li><i class="fas fa-file-invoice-dollar"></i> <a href="">Órdem de Compra/serviço</a></li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
        @endforeach
</div>
@endsection

@section('script')
<script charset="utf-8" type="text/javascript">
    function mostrar(id){
        @foreach($accFormats as $accFormat)
            if({{$loop->index}}!= id){
                document.querySelector('#div{{$loop->index}}').setAttribute('class', 'hidden');
            }else{
                document.querySelector('#div{{$loop->index}}').removeAttribute('class', 'hidden');
            }
        @endforeach
        
    }

</script>

@endsection



