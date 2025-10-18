<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>テスト解答</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            font-size: 14px;
        }
        h1 {
            text-align: center;
        }
        .question {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>テスト解答</h1>

    @if($questions->isNotEmpty())
        @foreach($questions as $question)
            <div class="question">
                <strong>質問:</strong> {{ $question->text }}<br>
                <strong>選択肢:</strong> {{ $question->options }}
            </div>
        @endforeach
    @else
        <p>質問がありません。</p>
    @endif
</body>
</html>
