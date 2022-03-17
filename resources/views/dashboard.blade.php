@extends('layouts.site')

@section('content')
          <div class="relative pt-12 pb-32 bg-teal-800 md:pt-32">
          <div class="w-full px-4 mx-auto md:px-10">
            <div>
              <!-- Card stats -->
    @if($pendingFixedExpenditures == 'a')  
      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
          <!--
            Background overlay, show/hide based on modal state.

            Entering: "ease-out duration-300"
              From: "opacity-0"
              To: "opacity-100"
            Leaving: "ease-in duration-200"
              From: "opacity-100"
              To: "opacity-0"
          -->
          <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>

          <!-- This element is to trick the browser into centering the modal contents. -->
          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
          <!--
            Modal panel, show/hide based on modal state.

            Entering: "ease-out duration-300"
              From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              To: "opacity-100 translate-y-0 sm:scale-100"
            Leaving: "ease-in duration-200"
              From: "opacity-100 translate-y-0 sm:scale-100"
              To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          -->
          <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                  <!-- Heroicon name: exclamation -->
                  <svg class="w-6 h-6 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                  </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                    Geração de Despesa Fixa
                  </h3>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">
                      A despesa <strong>{{$result->description}}</strong> chegou na data de emissão, você deve informar o valor e gerar uma nova despesa.<br />
                      <span class="text-xs">(caso a despesa não tenha sido emitida ainda, altere a data de emissão da despesa fixa)</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
              <a href="{{route('gerExpenditure', ['id'=>$result->id])}}" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-teal-700 border border-transparent rounded-md shadow-sm hover:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Gerar
              </a>
              <a href="{{route('fixedExpenditure', ['id'=>$result->account_id])}}" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancelar
              </a>
            </div>
          </div>
        </div>
      </div>
    @endif

              <div class="flex flex-wrap">
                @foreach($accountsSaldo as $accountSaldo)
                <div class="w-full px-3 mt-2 lg:w-6/12 xl:w-4/12">
                  <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                    <div class="flex-auto p-4">
                      <div class="flex flex-wrap">
                        <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                          <h5 class="text-xs font-bold text-gray-500 uppercase">
                            Saldo: <span class="{{$accountSaldo["ballance"] < 0 ? 'text-red-500' : 'text-green-500'}} font-bold">
                                    R$ {{number_format($accountSaldo["ballance"], 2, ',', '.')}}
                                  </span>
                          </h5>
                          <span class="text-xs font-semibold text-gray-800 uppercase">
                            Conta: {{$accountSaldo["account"]->number}} <br /> {{$accountSaldo["account"]->description}}
                          </span>
                        </div>
                        <div class="relative flex-initial w-auto pl-2">
                          <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-teal-800 rounded-full shadow-lg">
                            <i class="fas fa-comment-dollar"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-4 text-xs text-gray-500">
                        <span class="mr-2 text-teal-800">
                          <i class="fas fa-cog"></i></i>
                        </span>
                        <span class="whitespace-no-wrap">
                        <a href="{{route('manageAcount', ['id'=> $accountSaldo["account"]->id])}}" class="font-semibold hover:text-gray-600 hover:font-bold">Gerenciar</a>
                        </span>
                      </p>
                    </div>
                  </div>
                </div>
              @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="w-full px-4 mx-auto -m-24 md:px-10">
          <div class="flex flex-wrap mt-2">
            <div class="w-full px-4 mb-12 xl:w-6/12 xl:mb-0">
              <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
                <div class="px-4 py-3 mb-0 border-0 rounded-t">
                  <div class="flex flex-wrap items-center">
                    <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                      <h3 class="text-base font-semibold text-gray-800">
                        Contas a Vencer
                      </h3>
                    </div>
                    <div class="relative flex-1 flex-grow w-full max-w-full px-4 text-right">
                      <a href="{{route('chooseAccount', ['movimento'=>'out'])}}"
                        class="px-3 py-1 mb-1 mr-1 text-xs font-bold text-white uppercase bg-teal-800 rounded outline-none active:bg-indigo-600 focus:outline-none"
                        type="button"
                        style="transition:all .15s ease"
                      >
                        Ver mais
                      </a>
                    </div>
                  </div>
                </div>
                <div class="block w-full overflow-x-auto">
                  <!-- Projects table -->
                  <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                      <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase whitespace-no-wrap align-middle bg-gray-100 border border-l-0 border-r-0 border-gray-200 border-solid">
                          Vencimento
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase whitespace-no-wrap align-middle bg-gray-100 border border-l-0 border-r-0 border-gray-200 border-solid">
                          Descrição
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase whitespace-no-wrap align-middle bg-gray-100 border border-l-0 border-r-0 border-gray-200 border-solid">
                          valor
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pendingExpenditures as $expendituresPending)
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          {{date('d/m/Y', strtotime($expendituresPending->expiration))}}
                        </th>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          {{$expendituresPending->description}}
                        </th>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          R$ {{number_format($expendituresPending->value, 2, ',', '.')}}
                        </th>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="hidden w-full px-4 mb-12 xl:w-6/12 xl:mb-0">
              <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
                <div class="px-4 py-3 mb-0 border-0 rounded-t">
                  <div class="flex flex-wrap items-center">
                    <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                      <h3 class="text-base font-semibold text-gray-800">
                        Contas a Vencer
                      </h3>
                    </div>
                    <div class="relative flex-1 flex-grow w-full max-w-full px-4 text-right">
                      <button
                        class="px-3 py-1 mb-1 mr-1 text-xs font-bold text-white uppercase bg-indigo-500 rounded outline-none active:bg-indigo-600 focus:outline-none"
                        type="button"
                        style="transition:all .15s ease"
                      >
                        See all
                      </button>
                    </div>
                  </div>
                </div>
                <div class="block w-full overflow-x-auto">
                  <!-- Projects table -->
                  <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                      <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase whitespace-no-wrap align-middle bg-gray-100 border border-l-0 border-r-0 border-gray-200 border-solid">
                          Page name
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase whitespace-no-wrap align-middle bg-gray-100 border border-l-0 border-r-0 border-gray-200 border-solid">
                          Visitors
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase whitespace-no-wrap align-middle bg-gray-100 border border-l-0 border-r-0 border-gray-200 border-solid">
                          Unique users
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase whitespace-no-wrap align-middle bg-gray-100 border border-l-0 border-r-0 border-gray-200 border-solid">
                          Bounce rate
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          /argon/
                        </th>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          4,569
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          340
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          <i class="mr-4 text-green-500 fas fa-arrow-up"></i>
                          46,53%
                        </td>
                      </tr>
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          /argon/index.html
                        </th>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          3,985
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          319
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          <i class="mr-4 text-orange-500 fas fa-arrow-down"></i>
                          46,53%
                        </td>
                      </tr>
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          /argon/charts.html
                        </th>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          3,513
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          294
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          <i class="mr-4 text-orange-500 fas fa-arrow-down"></i>
                          36,49%
                        </td>
                      </tr>
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          /argon/tables.html
                        </th>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          2,050
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          147
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          <i class="mr-4 text-green-500 fas fa-arrow-up"></i>
                          50,87%
                        </td>
                      </tr>
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          /argon/profile.html
                        </th>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          1,795
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          190
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          <i class="mr-4 text-red-500 fas fa-arrow-down"></i>
                          46,53%
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="hidden w-full px-4 xl:w-4/12">
              <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
                <div class="px-4 py-3 mb-0 border-0 rounded-t">
                  <div class="flex flex-wrap items-center">
                    <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                      <h3 class="text-base font-semibold text-gray-800">
                        Social traffic
                      </h3>
                    </div>
                    <div class="relative flex-1 flex-grow w-full max-w-full px-4 text-right">
                      <button
                        class="px-3 py-1 mb-1 mr-1 text-xs font-bold text-white uppercase bg-indigo-500 rounded outline-none active:bg-indigo-600 focus:outline-none"
                        type="button"
                        style="transition:all .15s ease"
                      >
                        See all
                      </button>
                    </div>
                  </div>
                </div>
                <div class="block w-full overflow-x-auto">
                  <!-- Projects table -->
                  <table class="items-center w-full bg-transparent border-collapse">
                    <thead class="thead-light">
                      <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase whitespace-no-wrap align-middle bg-gray-100 border border-l-0 border-r-0 border-gray-200 border-solid">
                          Referral
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase whitespace-no-wrap align-middle bg-gray-100 border border-l-0 border-r-0 border-gray-200 border-solid">
                          Visitors
                        </th>
                        <th
                          class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase whitespace-no-wrap align-middle bg-gray-100 border border-l-0 border-r-0 border-gray-200 border-solid"
                          style="min-width:140px"
                        ></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          Facebook
                        </th>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          1,480
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          <div class="flex items-center">
                            <span class="mr-2">60%</span>
                            <div class="relative w-full">
                              <div class="flex h-2 overflow-hidden text-xs bg-red-200 rounded">
                                <div
                                  style="width:60%"
                                  class="flex flex-col justify-center text-center text-white bg-red-500 shadow-none whitespace-nowrap"
                                ></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          Facebook
                        </th>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          5,480
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          <div class="flex items-center">
                            <span class="mr-2">70%</span>
                            <div class="relative w-full">
                              <div class="flex h-2 overflow-hidden text-xs bg-green-200 rounded">
                                <div
                                  style="width:70%"
                                  class="flex flex-col justify-center text-center text-white bg-green-500 shadow-none whitespace-nowrap"
                                ></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          Google
                        </th>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          4,807
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          <div class="flex items-center">
                            <span class="mr-2">80%</span>
                            <div class="relative w-full">
                              <div class="flex h-2 overflow-hidden text-xs bg-purple-200 rounded">
                                <div
                                  style="width:80%"
                                  class="flex flex-col justify-center text-center text-white bg-purple-500 shadow-none whitespace-nowrap"
                                ></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          Instagram
                        </th>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          3,678
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          <div class="flex items-center">
                            <span class="mr-2">75%</span>
                            <div class="relative w-full">
                              <div class="flex h-2 overflow-hidden text-xs bg-blue-200 rounded">
                                <div
                                  style="width:75%"
                                  class="flex flex-col justify-center text-center text-white bg-blue-500 shadow-none whitespace-nowrap"
                                ></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="p-4 px-6 text-xs text-left whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          twitter
                        </th>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          2,645
                        </td>
                        <td class="p-4 px-6 text-xs whitespace-no-wrap align-middle border-t-0 border-l-0 border-r-0">
                          <div class="flex items-center">
                            <span class="mr-2">30%</span>
                            <div class="relative w-full">
                              <div class="flex h-2 overflow-hidden text-xs bg-orange-200 rounded">
                                <div
                                  style="width:30%"
                                  class="flex flex-col justify-center text-center text-white bg-green-500 shadow-none whitespace-nowrap"
                                ></div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    @endsection
    
@section('script')
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
charset="utf-8"
></script>
<script type="text/javascript">
(function() {
/* Add current date to the footer */
  document.getElementById("javascript-date").innerHTML = new Date().getFullYear();
  /* Chart initialisations */
  /* Line Chart */
  var config = {
    type: "line",
    data: {
      labels: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July"
      ],
      datasets: [
        {
          label: 'Receitas',
          backgroundColor: "#4c51bf",
          borderColor: "#4c51bf",
          data: [65, 78, 66, 44, 56, 67, 75],
          fill: false
        },
        {
          label: 'Despesas',
          fill: false,
          backgroundColor: "#ed64a6",
          borderColor: "#ed64a6",
          data: [40, 68, 86, 74, 56, 60, 87]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      title: {
        display: false,
        text: "Sales Charts",
        fontColor: "white"
      },
      legend: {
        labels: {
          fontColor: "white"
        },
        align: "end",
        position: "bottom"
      },
      tooltips: {
        mode: "index",
        intersect: false
      },
      hover: {
        mode: "nearest",
        intersect: true
      },
      scales: {
        xAxes: [
          {
            ticks: {
              fontColor: "rgba(255,255,255,.7)"
            },
            display: true,
            scaleLabel: {
              display: false,
              labelString: "Month",
              fontColor: "white"
            },
            gridLines: {
              display: false,
              borderDash: [2],
              borderDashOffset: [2],
              color: "rgba(33, 37, 41, 0.3)",
              zeroLineColor: "rgba(0, 0, 0, 0)",
              zeroLineBorderDash: [2],
              zeroLineBorderDashOffset: [2]
            }
          }
        ],
        yAxes: [
          {
            ticks: {
              fontColor: "rgba(255,255,255,.7)"
            },
            display: true,
            scaleLabel: {
              display: false,
              labelString: "Value",
              fontColor: "white"
            },
            gridLines: {
              borderDash: [3],
              borderDashOffset: [3],
              drawBorder: false,
              color: "rgba(255, 255, 255, 0.15)",
              zeroLineColor: "rgba(33, 37, 41, 0)",
              zeroLineBorderDash: [2],
              zeroLineBorderDashOffset: [2]
            }
          }
        ]
      }
    }
  };
  var ctx = document.getElementById("line-chart").getContext("2d");
  window.myLine = new Chart(ctx, config);

  /* Bar Chart */
  config = {
    type: "bar",
    data: {
      labels: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July"
      ],
      datasets: [
        {
          label: new Date().getFullYear(),
          backgroundColor: "#ed64a6",
          borderColor: "#ed64a6",
          data: [30, 78, 56, 34, 100, 45, 13],
          fill: false,
          barThickness: 8
        },
        {
          label: new Date().getFullYear() - 1,
          fill: false,
          backgroundColor: "#4c51bf",
          borderColor: "#4c51bf",
          data: [27, 68, 86, 74, 10, 4, 87],
          barThickness: 8
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      title: {
        display: false,
        text: "Orders Chart"
      },
      tooltips: {
        mode: "index",
        intersect: false
      },
      hover: {
        mode: "nearest",
        intersect: true
      },
      legend: {
        labels: {
          fontColor: "rgba(0,0,0,.4)"
        },
        align: "end",
        position: "bottom"
      },
      scales: {
        xAxes: [
          {
            display: false,
            scaleLabel: {
              display: true,
              labelString: "Month"
            },
            gridLines: {
              borderDash: [2],
              borderDashOffset: [2],
              color: "rgba(33, 37, 41, 0.3)",
              zeroLineColor: "rgba(33, 37, 41, 0.3)",
              zeroLineBorderDash: [2],
              zeroLineBorderDashOffset: [2]
            }
          }
        ],
        yAxes: [
          {
            display: true,
            scaleLabel: {
              display: false,
              labelString: "Value"
            },
            gridLines: {
              borderDash: [2],
              drawBorder: false,
              borderDashOffset: [2],
              color: "rgba(33, 37, 41, 0.2)",
              zeroLineColor: "rgba(33, 37, 41, 0.15)",
              zeroLineBorderDash: [2],
              zeroLineBorderDashOffset: [2]
            }
          }
        ]
      }
    }
  };
  ctx = document.getElementById("bar-chart").getContext("2d");
  window.myBar = new Chart(ctx, config);
})();
</script>
@endsection