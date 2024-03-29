<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="{{asset('img/apple-icon.png')}}"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <link
      rel="stylesheet"
      href="{{ asset('css/fontawesome-free/css/all.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('css/app.css') }}"
    />
    <title>Sistema de Gestão Finaceira Escolar</title>
  </head>
  <body class="text-gray-800 antialiased">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
      <nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-no-wrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
      >
        <div
          class="md:flex-col md:items-stretch md:min-h-full md:flex-no-wrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
        >
          <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button"
            onclick="toggleNavbar('example-collapse-sidebar')"
          >
            <i class="fas fa-bars"></i></button
          >
          <a
            class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold p-4 px-0"
            href="{{route('dashboard')}}"
          >
            SGFIN - ESCOLAR
          </a>
          <ul class="md:hidden items-center flex flex-wrap list-none">
            <li class="inline-block relative">
              <a
                class="text-gray-600 block py-1 px-3"
                href="#pablo"
                onclick="openDropdown(event,'notification-dropdown')"
                ><i class="fas fa-bell"></i
              ></a>
              <div
                class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1"
                style="min-width: 12rem;"
                id="notification-dropdown"
              >
                <a
                  href="{{route('profile')}}"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                  >Perfil</a
                ><a
                  href="#pablo"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                  >Cadastrar Novo Usuário</a
                >
                <div class="h-0 my-2 border border-solid border-gray-200"></div>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                                  this.closest('form').submit();"
                    class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800">
                      {{ __('Sair') }}
                  </a>
                </form>
              </div>
            </li>
            <li class="inline-block relative">
              <a
                class="text-gray-600 block"
                href="#pablo"
                onclick="openDropdown(event,'user-responsive-dropdown')"
                ><div class="items-center flex">
                  <span
                    class="uppercase w-12 h-12 text-sm text-white bg-gray-600 inline-flex items-center justify-center rounded-full"
                    >
                    @if(session('school'))
                    {{auth()->user()->name[0]}}
                    @endif
                  </span></div
              ></a>
              <div
                class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1"
                style="min-width: 12rem;"
                id="user-responsive-dropdown"
              >
                <a
                  href="{{route('profile')}}"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                  >Perfil</a
                ><a
                  href="#pablo"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                  >Cadastrar Novo Usuário</a
                >
                <div class="h-0 my-2 border border-solid border-gray-200"></div>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                                  this.closest('form').submit();"
                    class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800">
                      {{ __('Sair') }}
                  </a>
                </form>
              </div>
            </li>
          </ul>
          <div
            class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
            id="example-collapse-sidebar"
          >
            <div
              class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-gray-300"
            >
              <div class="flex flex-wrap">
                <div class="w-6/12">
                  <a
                    class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold p-4 px-0"
                    href="{{route('dashboard')}}"
                  >
                    SEFIN - ESCOLAR
                  </a>
                </div>
                <div class="w-6/12 flex justify-end">
                  <button
                    type="button"
                    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                    onclick="toggleNavbar('example-collapse-sidebar')"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
            <form class="mt-6 mb-4 md:hidden">
              <div class="mb-3 pt-0">
                <input
                  type="text"
                  placeholder="Search"
                  class="px-3 py-2 h-12 border border-solid  border-gray-600 placeholder-gray-400 text-gray-700 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
                />
              </div>
            </form>
            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
              <li class="items-center">
                <a
                  class="text-green-500 hover:text-green-600 text-xs uppercase py-3 font-bold block"
                  href="{{route('dashboard')}}"
                  ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                  Início</a
                >
              </li>
              <li class="items-center">
                <a
                  class="text-gray-800 hover:text-gray-600 text-xs uppercase py-3 font-bold block"
                  href="{{route('ordinance')}}"
                  ><i class="fas fa-file-contract text-gray-500 mr-2 text-sm"></i>
                  Portarias</a
                >
              </li>
              <li class="items-center">
                <a
                  class="text-gray-800 hover:text-gray-600 text-xs uppercase py-3 font-bold block"
                  href="{{route('provider')}}"
                  ><i class="fas fas fa-dolly text-gray-500 mr-2 text-sm"></i>
                  Fornecedores</a
                >
              </li>
              <li class="items-center">
                <a
                  class="text-gray-800 hover:text-gray-600 text-xs uppercase py-3 font-bold block"
                  href="{{route('account')}}"
                  ><i class="fas fa-file-invoice-dollar text-gray-500 mr-2 text-sm"></i>
                  Contas</a
                >
              </li>
              <li class="items-center">
                <a
                  class="text-gray-800 hover:text-gray-600 text-xs uppercase py-3 font-bold block"
                  href="{{route('chooseAccount', ['movimento'=>'in'])}}"
                  ><i class="fas fa-money-bill-alt text-gray-500 mr-2 text-sm"></i>
                  Receitas</a
                >
              </li>
              <li class="items-center">
                <a
                  class="text-gray-800 hover:text-gray-600 text-xs uppercase py-3 font-bold block"
                  href="{{route('chooseAccount', ['movimento'=>'out'])}}"
                  ><i class="far fa-money-bill-alt text-gray-500 mr-2 text-sm"></i>
                  Despesas</a
                >
              </li>
              <li class="items-center">
                <a
                  class="text-gray-800 text-xs uppercase py-3 font-bold block"
                  href="{{route('contract')}}"
                  ><i class="fas fa-file-contract  text-gray-500 mr-2 text-sm"></i>
                  contratos</a
                >
              </li>
              <li class="items-center">
                <a
                  class="text-gray-800 text-xs uppercase py-3 font-bold block"
                  href="{{route('accountability')}}"
                  ><i class="fas fa-fax text-gray-500 mr-2 text-sm"></i>
                  Prestação de contas</a
                >
              </li>
              <li class="items-center">
                <a
                  class="text-gray-800 text-xs uppercase py-3 font-bold block"
                  href="#pablo"
                  ><i class="fas fa-file-signature text-gray-500 mr-2 text-sm"></i>
                  Licitações</a
                >
              </li>
            </ul>
            <hr class="my-4 md:min-w-full" />
            <h6
              class="md:min-w-full text-gray-600 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
            >
              Relatórios
            </h6>
            <ul
              class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
            >
              <li class="inline-flex">
                <a
                  class="text-gray-800 hover:text-gray-600 text-sm block mb-4 no-underline font-semibold"
                  href="#/documentation/styles"
                  ><i
                    class="fas fa-paint-brush mr-2 text-gray-500 text-base"
                  ></i>
                  Styles</a
                >
              </li>
              <li class="inline-flex">
                <a
                  class="text-gray-800 hover:text-gray-600 text-sm block mb-4 no-underline font-semibold"
                  href="#/documentation/alerts"
                  ><i class="fab fa-css3-alt mr-2 text-gray-500 text-base"></i>
                  CSS Components</a
                >
              </li>
              <li class="inline-flex">
                <a
                  class="text-gray-800 hover:text-gray-600 text-sm block mb-4 no-underline font-semibold"
                  href="#/documentation/vue/alerts"
                  ><i class="fab fa-vuejs mr-2 text-gray-500 text-base"></i>
                  VueJS</a
                >
              </li>
              <li class="inline-flex">
                <a
                  class="text-gray-800 hover:text-gray-600  text-sm block mb-4 no-underline font-semibold"
                  href="#/documentation/react/alerts"
                  ><i class="fab fa-react mr-2 text-gray-500 text-base"></i>
                  React</a
                >
              </li>
              <li class="inline-flex">
                <a
                  class="text-gray-800 hover:text-gray-600  text-sm block mb-4 no-underline font-semibold"
                  href="#/documentation/angular/alerts"
                  ><i class="fab fa-angular mr-2 text-gray-500 text-base"></i>
                  Angular</a
                >
              </li>
              <li class="inline-flex">
                <a
                  class="text-gray-800 hover:text-gray-600  text-sm block mb-4 no-underline font-semibold"
                  href="#/documentation/javascript/alerts"
                  ><i class="fab fa-js-square mr-2 text-gray-500 text-base"></i>
                  Javascript</a
                >
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="relative md:ml-64 bg-gray-100">
        <nav
          class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-no-wrap md:justify-start flex items-center bg-teal-800"
        >
          <div
            class="w-full mx-auto items-center flex justify-between md:flex-no-wrap flex-wrap md:px-10 lg:py-4 md:py-0"
          >
            <a
              class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
        href="{{route('dashboard')}}"
              >Início</a
            >
            <form
              class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3"
            >
              <div class="relative flex w-full flex-wrap items-stretch">
                <span
                  class="z-10 h-full leading-snug font-normal text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
                  ></span>
              </div>
            </form>
            <ul
              class="flex-col md:flex-row list-none items-center hidden md:flex"
            >
              <a class="text-white block" href="#pablo" onclick="openDropdown(event,'user-dropdown')">
                <div class="items-center flex">
                  @if(session('school'))
                  {{session('school')->name. ' - ' .auth()->user()->name}}
                  @endif
                </div>
              </a>
              <div
                class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1"
                style="min-width: 12rem;"
                id="user-dropdown"
              >
                <a
                  href="{{route('profile')}}"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                  >Perfil</a
                ><a
                  href="#pablo"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                  >Cadastrar Usuário</a
                >
                <div class="h-0 my-2 border border-solid border-gray-200"></div>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                      class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800">
                        {{ __('Sair') }}
                    </a>
                  </form>
              </div>
            </ul>
          </div>
        </nav>
        <!-- Header -->
            @yield('content')
          </div>
          <footer class="block py-4 m-24">
            <div class="container mx-auto px-4">
              <hr class="mb-4 border-b-1 border-gray-300" />
              <div class="flex flex-wrap items-center md:justify-between justify-center">
                <div class="w-full md:w-4/12 px-4">
                  <div class="text-sm text-gray-600 font-semibold py-1">
                    Copyright © <span id="javascript-date"></span>
                    <a
                      href="https://www.creative-tim.com"
                      class="text-gray-600 hover:text-gray-800 text-sm font-semibold py-1"
                    >
                      Creative Tim
                    </a>
                  </div>
                </div>
                <div class="w-full md:w-8/12 px-4">
                  
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
    @yield('script')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" charset="utf-8"></script>
    <script type="text/javascript">

      /* Sidebar - Side navigation menu on mobile/responsive mode */
      function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("bg-white");
        document.getElementById(collapseID).classList.toggle("m-2");
        document.getElementById(collapseID).classList.toggle("py-3");
        document.getElementById(collapseID).classList.toggle("px-6");
      }
      /* Function for dropdowns */
      function openDropdown(event, dropdownID) {
        let element = event.target;
        while (element.nodeName !== "A") {
          element = element.parentNode;
        }
        var popper = new Popper(element, document.getElementById(dropdownID), {
          placement: "bottom-end"
        });
        document.getElementById(dropdownID).classList.toggle("hidden");
        document.getElementById(dropdownID).classList.toggle("block");
      }      
    </script>
  </body>
</html>
