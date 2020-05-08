<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos com Baixo Estoque</title>
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
        }

        table, th, td {
            border: 1px solid black;
        }

        .header {
            margin: auto;
        }

        .header tr th.name{
            width: 600px;
            height: 10px;
        }

        .header tr td{
            text-align: center;
            height: 40px;
        }

        .content {
            margin-top: 10px;
        }
        
    </style>
    <div id="footer">
        <div class="page-number"></div>
    </div>
    <table class="header">
        <thead>
            <tr>
                <th>Data</th>
                <th class="name">Nome</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ date("d/m/y") }}</td>
                <td>Produtos com estoque abaixo do limite</td>
            </tr>
        </tbody>
    </table>
    <table class="content">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Aplicação</th>
                <th>Quantidade</th>
                <th>Quantidade Limite</th>
                <th>Diferença</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td> {{ $p->title }}</td>
                <td> {{ $p->application }}</td>
                <td> {{ $p->amount }}</td>
                <td> {{ $p->limit_amount }}</td>
                <td> {{ $p->limit_amount - $p->amount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <footer>
    </footer>
</body>
</html>