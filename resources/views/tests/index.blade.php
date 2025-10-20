<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('点数一覧') }}：{{ $student->name_kanji }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- 指定された生徒の点数一覧 -->
                        @foreach($test_types as $test_type)
                            <div class="mb-10 p-4 shadow-sm dark:shadow-gray-800 dark:bg-gray-800 rounded-lg">
                                <h4 class="text-lg font-medium mx-4">{{ $test_type }}</h4>
                                <div class="my-4 overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left whitespace-nowrap">
                                                    <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">回</span>
                                                </th>
                                                @for ($i = 1; $i <= $columns[$test_type]; $i++)
                                                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left whitespace-nowrap">
                                                        <span class="text-sm leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ $i }}</span>
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
                                                    <td class="px-6 py-4 whitespace-no-wrap text-md whitespace-nowrap">
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
                                
                            
                                <!-- 追加ボタン -->
                                <a href="{{ route('tests.create', ['student' => $student->id, 'type' => $test_type]) }}"
                                    class="bg-blue-500 text-white px-6 py-2 ml-4 rounded-md hover:bg-blue-600">
                                    追加
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>