<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Relatório de Gastos com Manutenções</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
</head>
<body>
    <div class="report_header">
        <h1>SISTEMA DE APOIO PARA MANUTENÇÕES PREVENTIVAS DE MAQUINÁRIOS AGRÍCOLAS</h1>
        <h3>Relatório de gastos com manutenções</h3>
        
        @if(strlen($filter)> 1)
            Filtros: {{$filter}}
        @endif
    </div>

    <table class="report_table">
        <tr>
            <th>Data</th>
            <th>Descrição</th>
            <th>Observação</th>
            <th>ID</th>
            <th>Maquinário</th>
            <th>Usuário Resp.</th>
            <th>Preço R$</th>
        </tr>
        <!-- Inicia variavel total -->
        @php
        $total = 0
        @endphp

        @foreach($maintenances as $maintenance)
        <tr>
            <td>{{date('d/m/Y', strtotime($maintenance->data))}}</td>
            <td>{{$maintenance->description}}</td>
            <td>{{$maintenance->note}}</td>
            <td>{{$maintenance->identification_number}}</td>
            <td>{{$maintenance->machine}}</td>
            <td>{{$maintenance->name}}</td>
            <td>{{$maintenance->price}}</td>

            {{ $total += $maintenance->price}}
        </tr>
        @endforeach

        <tr>
            <th colspan="5"></th>
            <th colspan="2" >Total geral: {{$total}}</th>
        </tr>

    </table>
</body>
</html>