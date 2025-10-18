<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">英単語登録フォーム</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('wrong_questions.store') }}">
            @csrf
            <table class="table-auto w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Word</th>
                        <th class="px-4 py-2">Translation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $i => $q)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" name="word[]" value="{{ $q->word }}" class="w-full border rounded px-2 py-1">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" name="translation[]" value="{{ $q->translation }}" class="w-full border rounded px-2 py-1">
                        </td>
                    </tr>
                @endforeach

                @for ($j = 0; $j < (20 - $questions->count()); $j++)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type="text" name="word[]" value="" class="w-full border rounded px-2 py-1">
                        </td>
                        <td class="border px-4 py-2">
                            <input type="text" name="translation[]" value="" class="w-full border rounded px-2 py-1">
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
            <div class="mt-4 flex justify-end space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">保存</button>
                <a href="{{ route('wrong_questions.pdf') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">テスト出力</a>
            </div>
        </form>
    </div>
</x-app-layout>
