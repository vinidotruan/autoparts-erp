<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Obsoletos</title>
</head>
<body>
<style>
        @font-face {
            font-family: 'Quicksand';
            font-style: normal;
            font-weight: normal;
            src: url(https://fonts.googleapis.com/css2?family=Quicksand&display=swap);
        }
        
        #header,
        #footer {
            position: fixed;
            left: 0;
            right: 0;
            color: #aaa;
            font-size: 0.9em;
        }
        #header {
            top: 0;
            border-bottom: 0.1pt solid #aaa;
        }
        #footer {
            bottom: 0;
            border-top: 0.1pt solid #aaa;
        }
        .page-number:before {
            content: "Página " counter(page);
        }

        body {
            font-family: 'Quicksand', sans-serif;
        }
        
        table {
            border-collapse: collapse;
            margin: auto;
            min-width: 1030px;
        }

        table, th, td {
            border: 1px solid black;
        }

        .content {
            margin-top: 10px;
        }
        
    </style>
    <div id="footer">
        <div class="page-number"></div>
    </div>

    <h1>Produtos obsoletos</h1>
    <hr>
    <div class="header">
        <strong> Data: </strong>
        <span>{{ date("d/m/Y") }}</span>
        <br>
        <strong> Quantidade Mínima: </strong>
        <span>{{ $report['minimun_amount'] }}</span>
        <br>
        <strong> De/Até:</strong>
        <span> {{ date("d/m/Y",strtotime($report['since'])) }} - {{ date("d/m/Y",strtotime($report['at'])) }} </span>
        <br>
    </div>
    <hr>

    <table class="content">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quantidade Vendida</th>
                <th>Total Arrecadado</th>
            </tr>
        </thead>
        <tbody>
        @foreach($report->data as $p)
            <tr>
                <td> {{ $p['name'] }}</td>
                <td> {{ $p['amount_total'] }}</td>
                <td> {{ $p['value'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>