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
                padding: 5px;
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
            }

            .uppercase {
                text-transform: uppercase;
            }
            .cabecalho{
                font-size: 0.7rem;
            }
            .back{
                background-color: #BDBDBD;
            }
            .padding-top{
                padding-top: 55px;
            }
        </style>
    </head>
    <body>
        <div>
            <table cellspacing="0" class="uppercase">
                <tr>
                    <td class="center uppercase" rowspan="2">
                        <img src="{{asset('img/brasao.jpg')}}">
                    </td>
                    <td colspan="4" rowspan="2" class="center uppercase bolder">
                        PREFEITURA MUNICIPAL DE PALMAS<br>
                        SECRETARIA MUNICIPAL DE EDUCAÇÃO
                    </td>
                    <td colspan="3" class="center uppercase bolder">
                        PRESTAÇÃO DE CONTAS - <br> {{$accFormat->accountability->description}}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="center uppercase bolder">Período: {{$accFormat->mes_inicial}} A {{$accFormat->mes_final}} de {{$accFormat->accountability->year}}</td>
                </tr>
                <tr>
                    <td class="center uppercase bolder" colspan="8">RELAÇÃO DE EXECUÇÃO DE RECEITA E DESPESA</td>
                </tr>
                <tr class="cabecalho uppercase lessBorderBottom">
                    <td colspan="2" class="lessBorderBottom">01 - Nome do órgão / Entidade Beneficiada</td>
                    <td colspan="2" class="lessBorderBottom">02 - Município - UF</td>
                    <td colspan="2" class="lessBorderBottom">03 - CNPJ</td>
                    <td colspan="2" class="lessBorderBottom">04 - Nº do processo de concessão</td>
                </tr>
                <tr class="bolder">
                    <td colspan="2" rowspan="3">{{$accFormat->accountability->account->school->ace->name}}</td>
                    <td colspan="2">Palmas - TO</td>
                    <td colspan="2">{{$accFormat->accountability->account->school->cnpj}}</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr class="cabecalho uppercase">
                    <td colspan="2" class="lessBorderBottom">05 - Nº do convênio</td>
                    <td colspan="2" class="lessBorderBottom">06 - Vigência do convênio</td>
                    <td colspan="2" class="lessBorderBottom">04 - Prestação de contas do Período/Exercício</td>
                </tr>
                <tr class="bolder">
                    <td colspan="2">Lei nº 1256/2003</td>
                    <td colspan="2">Fevereiro a Dezembro de {{$accFormat->accountability->year}}</td>
                    <td colspan="2">{{$accFormat->mes_inicial}} A {{$accFormat->mes_final}} de {{$accFormat->accountability->year}}</td>
                </tr>
                <tr class="cabecalho uppercase center back bolder">
                    <td colspan="3" rowspan="2">08 - Histórico</td>
                    <td colspan="3">09 - receita</td>
                    <td rowspan="2">10 - Despesas</td>
                    <td rowspan="2">11 - Saldo Final</td>
                </tr>
                <tr class="cabecalho uppercase center back bolder">
                    <td>Saldo Anterior</td>
                    <td>Repasses do Período</td>
                    <td>Devolução de Recursos</td>
                </tr>
                <tr class="bolder center">
                    <td colspan="3" class="left">CUSTEIO</td>
                    <td>R$ {{number_format($accFormat->previousBallanceCusteio, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->incomeCusteio, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->devolutionCusteio, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->expenditureCusteio, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->ballanceCusteio, 2, ',', '.')}}</td>
                </tr>
                <tr class="bolder center">
                    <td colspan="3" class="left">CAPITAL</td>
                    <td>R$ {{number_format($accFormat->previousBallanceCapital, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->incomeCapital, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->devolutionCapital, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->expenditureCapital, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->ballanceCapital, 2, ',', '.')}}</td>
                </tr>
                <tr class="bolder center">
                    <td colspan="3" class="left">RENDIMENTO</td>
                    <td></td>
                    <td>R$ {{number_format($accFormat->bankIncome, 2, ',', '.')}}</td>
                    <td></td>
                    <td></td>
                    <td>R$ {{number_format($accFormat->bankIncome, 2, ',', '.')}}</td>
                </tr>
                <tr class="uppercase bolder back center">
                    <td colspan="3" class="right">Total</td>
                    <td>R$ {{number_format($accFormat->previousBallance, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->fullIncomes, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->totalDevolution, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->fullExpenditures, 2, ',', '.')}}</td>
                    <td>R$ {{number_format($accFormat->saldoFinal, 2, ',', '.')}}</td>
                </tr>
                <tr class="lessBorderBottom lessBorderLeft lessBorderRight">
                    <td class="cabecalho uppercase lessBorderBottom lessBorderLeft lessBorderRight" colspan="8">12 - AUTENTICAÇÃO</td>
                </tr>
                <tr class="lessBordertop lessBorderLeft lessBorderRight lessBorderBottom">
                    <td colspan="3" class="center lessBorderTop lessBorderRight lessBorderLeft lessBorderBottom padding-top">
                        Palmas, Tocantins, {{now()->format('d/m/Y')}}<br>
                        <span class="cabecalho uppercase">local e data</span>
                    </td>
                    <td colspan="5" class="center lessBorderTop lessBorderLeft lessBorderBottom lessBorderRight padding-top">
                        ___________________________________________________________<br>
                        <span class="cabecalho uppercase">assinatura e carimbo do responsável</span>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>