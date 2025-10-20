<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>英単語テストの答え</title>
    <style>
        @font-face{
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src:url('{{ storage_path('fonts/ipag.ttf')}}');
        }
        @font-face{
            font-family: ipag;
            font-style: bold;
            font-weight: bold;
            src:url('{{ storage_path('fonts/ipag.ttf')}}');
        }
        body {
            font-family: ipag;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>

</head>
<body>
    <h1>英単語テストの答え</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>英単語</th>
                <th>読み（訳語）</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $i => $q)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $q->word }}</td>
                    <td>{{ $q->translation }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
