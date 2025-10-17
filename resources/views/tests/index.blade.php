<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('テスト点数一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- 指定された生徒の基本情報 -->
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold">生徒情報</h3>
                        <ul>
                            <li>氏名：{{ $student->name_kanji }}（{{ $student->name_kana }}）</li>
                            <li>生徒ID：{{ $student->id }}</li>
                            <li>性別：{{ $student->gender }}</li>
                            <li>学年：{{ $student->grade }}年</li>
                            <li>学校名：{{ $student->school }}</li>
                        </ul>
                    </div>   
                    <!-- 指定された生徒の点数一覧 -->
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold">点数一覧</h3>
                        @foreach($test_types as $test_type)
                            <div class="mt-4 mb-4">
                                <h4 class="text-lg font-medium">{{ $test_type }}</h4>
                                <div class="mt-6 overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left whitespace-nowrap">
                                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">回</span>
                                                </th>
                                                @for ($i = 1; $i <= $columns[$test_type]; $i++)
                                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left whitespace-nowrap">
                                                        <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ $i }}</span>
                                                    </th>
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm whitespace-nowrap">
                                                    <span class="text-gray-900 dark:text-gray-100">点数</span>
                                                </td>
                                                @for ($i = 1; $i <= $columns[$test_type]; $i++)
                                                    @php
                                                        $test = $tests->where('test_name', $test_type)->skip($i - 1)->first();
                                                    @endphp
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm whitespace-nowrap">
                                                        @if ($test)
                                                            <a href="{{ route('tests.edit', ['student' => $student->id, 'test' => $test->id]) }}"
                                                            class="text-gray-900 hover:underline">
                                                                {{ $test->score }}
                                                            </a>
                                                        @else
                                                            <div class="text-gray-400"></div>
                                                        @endif
                                                    </td>
                                                @endfor
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 追加ボタン -->
                            <a href="{{ route('tests.create', ['student' => $student->id, 'type' => $test_type]) }}"
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            追加
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>