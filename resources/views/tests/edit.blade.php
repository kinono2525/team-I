<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('点数編集') }}：{{ $student->name_kanji }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold mb-6"> {{ $test->test_name }} 第{{$index}}回</h2>

                    <form method="POST" action="{{ route('tests.update', ['student' => $student->id, 'test' => $test->id]) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            更新
                        </button>
                        <label class='mr-3 ml-6'>点数</label>
                        <input type="number" name="score" value="{{ $test->score }}" required>
                    </form>

                    @if ($test->id === $latestTest->id)
                    <div class="mt-6">
                        <form method="POST" action="{{ route('tests.destroy', ['student' => $student->id, 'test' => $test->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                onclick="return confirm('本当にこのテスト点数を削除しますか？');">
                                削除
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>