<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" lang="pt-br"/>
        <title> Capa </title>
        <link
            rel="stylesheet"
            href="{{ asset('css/app.css') }}"
        />
    </head>
    <body>
        <div class="text-center">
            <img src="{{asset('img/brasao.jpg')}}" /><br>
            <p class="text-sm font-bold">
                PREFEITURA MUNICIPAL DE PALMAS<br>
                SECRETARIA MUNICIPAL DE EDUCAÇÃO<br>
                <span class="text-cp uppercase">
                    {{$accFormat->accountability->account->school->ace->name}}<br>
                    CNPJ: {{$accFormat->accountability->account->school->cnpj}}<br>
                    {{$accFormat->accountability->account->school->adress}} - FONE: {{$accFormat->accountability->account->school->telefone}}
                </span>
            </p>
        </div>
        <div class="my-64">
            <p class="text-center font-bold uppercase">
                PRESTAÇÃO DE CONTAS<br>
                {{$accFormat->accountability->account->school->ace->name}}
            </p>
        </div>
        <div>
            <p class="text-center font-bold uppercase">
                {{$accFormat->accountability->description}}<br>
                {{$accFormat->mes_inicial}} A {{$accFormat->mes_final}} DE {{$accFormat->accountability->year}}
            </p>
        </div>
    </body>
</html>