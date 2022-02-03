<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Relatório Manutenções</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .report_header{
            text-align: center;
            font-size: 11px;
        }
        .report_header h1{
            font-size: 15px;
            margin-bottom: -10px;
        }
        .report_header h3{
            font-size: 14px;
        } 
        .report_table{
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }
        .report_table th, .report_table td{
            border: 1px solid black;
            padding: 3px;
        } 

        .report_table tr:nth-child(even) {background: #FFF}
        .report_table tr:nth-child(odd) {background: #EEE}
    </style>
</head>
<body>
    <div class="report_header">
        <h1>SISTEMA DE APOIO PARA MANUTENÇÕES PREVENTIVAS DE MAQUINÁRIOS AGRÍCOLAS</h1>
        <h3>Relatório geral de Manutenções</h3>
        
        @if(strlen($filter)> 1)
            Filtros: {{$filter}}
        @endif
    </div>

    <table class="report_table">
        <tr>
            <th>Data</th>
            <th>Descrição</th>
            <th>Observação</th>
            <th>Status</th>
            <th>ID</th>
            <th>Maquinário</th>
            <th>Usuário Resp.</th>
        </tr>

        @foreach($maintenances as $maintenance)
        <tr>
            <td>{{date('d/m/Y', strtotime($maintenance->data))}}</td>
            <td>{{$maintenance->description}}</td>
            <td>{{$maintenance->note}}</td>
            <td>{{$maintenance->status}}</td>
            <td>{{$maintenance->identification_number}}</td>
            <td>{{$maintenance->machine}}</td>
            <td>{{$maintenance->name}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>