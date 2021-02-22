<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" lang="pt-br"/>
        <title> Relação de Execução de Receitas e Despesas </title>
        <style>
            table{
                width:100%;
            }
            tr, td{
                border: 1px solid;
            }
            img{
                
            }
            td{
                padding: 2px;
            }
            .center{
                text-align: center;
            }

            .left{
                text-align: left;
            }
            .right{
                text-align: right;
            }
            
            .lessBorderTop{
                border-top: 1px solid white; 
            }

            .lessBorderBottom{
                border-bottom: 1px solid white; 
            }

            .lessBorderRight{
                border-right: 1px solid white;
            }

            .lessBorderLeft{
                border-left: 1px solid white;
            }

            .bolder{
                font-weight:bold;
                font-size: 0.9rem;
            }

            .uppercase {
                text-transform: uppercase;
            }
            .cabecalho{
                font-size: 0.7rem;
            }
            .dados{
                font-size: 0.8rem;
            }
            .back{
                background-color: #BDBDBD;
            }
            .padding-top{
                padding-top: 55px;
            }
            .numero{
                padding:0;
                width: 25px;
            }
            .natureza{
                width: 35px;               
            }
            .cnpj{
                width: 120px;
            }
            .tipo{
                width: 75px;
            }
            .name{
                text-align: left;
                width: 160px;
            }
            .numero2{
                width: 95px;
            }
            .data{
                width: 80px;
            }
            .cheque{
                width: 110px;
            }
            .valor{
                width: 90px;
            }

        </style>
    </head>
    <body>
        <div>
            <table cellspacing="0" class="uppercase">
                <tr>
                    <td class="center uppercase" colspan="3" rowspan="2">
                        <img src="{{asset('img/brasao.jpg')}}">
                    </td>
                    <td colspan="5" rowspan="2" class="center uppercase bolder">
                        PREFEITURA MUNICIPAL DE PALMAS<br>
                        SECRETARIA MUNICIPAL DE EDUCAÇÃO
                    </td>
                    <td colspan="4" class="center uppercase bolder">
                        PRESTAÇÃO DE CONTAS - <br> {{$accFormat->accountability->description}}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="center uppercase bolder">Período: {{$accFormat->mes_inicial}} A {{$accFormat->mes_final}} de {{$accFormat->accountability->year}}</td>
                </tr>
                <tr>
                    <td class="center uppercase bolder" colspan="12">RELAÇÃO DE PAGAMENTOS</td>
                </tr>
                <tr class="cabecalho uppercase lessBorderBottom">
                    <td colspan="4" class="lessBorderBottom">01 - Nome do órgão / Entidade Beneficiada</td>
                    <td colspan="2" class="lessBorderBottom">02 - Município - UF</td>
                    <td colspan="2" class="lessBorderBottom">03 - CNPJ</td>
                    <td colspan="4" class="lessBorderBottom">04 - Nº do processo de concessão</td>
                </tr>
                <tr class="bolder">
                    <td colspan="4" rowspan="3">{{$accFormat->accountability->account->school->ace->name}}</td>
                    <td colspan="2">Palmas - TO</td>
                    <td colspan="2">{{$accFormat->accountability->account->school->cnpj}}</td>
                    <td colspan="4">&nbsp;</td>
                </tr>
                <tr class="cabecalho uppercase">
                    <td colspan="2" class="lessBorderBottom">05 - Nº do convênio</td>
                    <td colspan="2" class="lessBorderBottom">06 - Vigência do convênio</td>
                    <td colspan="4" class="lessBorderBottom">07 - Prestação de contas do Período/Exercício</td>
                </tr>
                <tr class="bolder">
                    <td colspan="2">Lei nº 1256/2003</td>
                    <td colspan="2">Fevereiro a Dezembro de {{$accFormat->accountability->year}}</td>
                    <td colspan="4">{{$accFormat->mes_inicial}} A {{$accFormat->mes_final}} de {{$accFormat->accountability->year}}</td>
                </tr>
                <tr class="cabecalho uppercase bolder back center">
                    <td rowspan="2" class="numero">Nº</td>
                    <td colspan="4">9 - FAVORECIDO</td>
                    <td colspan="3">10 - DOCUMENTO</td>
                    <td colspan="2">11 - PAGAMENTO</td>
                    <td rowspan="2" class="natureza">NAT. DA DESP.</td>
                    <td rowspan="2" class="valor">12 - VALOR</td>
                </tr>
                <tr class="cabecalho uppercase bolder back center">
                    <td colspan="3" id="tt">09.1 - NOME</td>
                    <td class="cnpj">09.02 - CPF OU CNPJ</td>
                    <td class="tipo">10.1 - TIPO</td>
                    <td class="numero2">10.2 - NÚMERO</td>
                    <td class="data">10.3 - DATA</td>
                    <td class="cheque">11.1 - Nº OB/CHEQUE</td>
                    <td class="data">11.2 - DATA</td>
                </tr>
                @foreach($expPaids as $expPaid)
                <tr class="dados center">
                    <td>{{$loop->index + 1}}</td>
                    <td colspan="3" class="name">{{$expPaid->company_name}}</td>
                    @if($expPaid->cpf != '')
                    <td>{{$expPaid->cpf}}</td>
                    @else
                    <td>{{$expPaid->cnpj}}</td>
                    @endif
                    <td>{{$expPaid->document_type}}</td>
                    <td>{{$expPaid->number_invoice}}</td>
                    <td>{{date('d/m/Y', strtotime($expPaid->emission_invoice))}}</td>
                    <td>{{$expPaid->number_cheque}}</td>
                    <td>{{date('d/m/Y', strtotime($expPaid->date_pay))}}</td>
                    @if($expPaid->nature == 'Custeio')
                    <td>C</td>
                    @else
                    <td>C</td>
                    @endif
                    <td>R$ {{number_format($expPaid->value_paid, 2, ',', '.')}}</td>
                </tr>
                @endforeach
                @if($expPaids->isEmpty())
                <tr class="center">
                    <td colspan="12">Não houve Pagamentos no período</td>
                </tr>
                @endif
                <tr class="dados bolder back">
                    <td colspan="11" class="right">Valor:</td>
                    <td>R$ {{number_format($accFormat->fullPays, 2, ',', '.')}}</td>
                </tr>
                <tr class="lessBorderBottom lessBorderLeft lessBorderRight">
                    <td class="cabecalho uppercase lessBorderBottom lessBorderLeft lessBorderRight" colspan="12">13 - AUTENTICAÇÃO</td>
                </tr>
                <tr class="lessBordertop lessBorderLeft lessBorderRight lessBorderBottom">
                    <td colspan="5" class="center lessBorderTop lessBorderRight lessBorderLeft lessBorderBottom padding-top">
                        Palmas, Tocantins, {{now()->format('d/m/Y')}}<br>
                        <span class="cabecalho uppercase">local e data</span>
                    </td>
                    <td colspan="7" class="center lessBorderTop lessBorderLeft lessBorderBottom lessBorderRight padding-top">
                        ___________________________________________________________<br>
                        <span class="cabecalho uppercase">assinatura e carimbo do responsável</span>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>