<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('生徒選択') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- 検索フォーム -->
                    <h2 class="text-xl font-semibold mx-4 mb-4">生徒検索フォーム</h2>
                    <form method="GET" action="{{ route('students.search') }}" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="name" :value="__('氏名')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ request('name') }}" />
                            </div>
                            <div>
                                <x-input-label for="grade" :value="__('学年')" />
                                <select id="grade" name="grade" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">選択してください</option>
                                    <option value="1" {{ request('grade') == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ request('grade') == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ request('grade') == '3' ? 'selected' : '' }}>3</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="school" :value="__('学校名')" />
                                <x-text-input id="school" name="school" type="text" class="mt-1 block w-full" value="{{ request('school') }}" />
                            </div>
                        </div>
                        <div class="mt-4 text-right">
                            <x-primary-button class="px-8 mr-3">{{ __('検索') }}</x-primary-button>
                        </div>
                    </form>

                    <!-- 検索結果テーブル -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold m-4">検索結果</h2>
                        @if ($students->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">生徒ID</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">氏名</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">学年</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">学校名</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">生徒情報編集</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">テスト関連</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">出席関連</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($students as $student)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                                <div class="text-gray-900 dark:text-gray-100">
                                                    {{ $student->id }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                                <div class="text-gray-900 dark:text-gray-100">
                                                    {{ $student->name_kanji }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                                <div class="text-gray-900 dark:text-gray-100">
                                                    {{ $student->grade }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                                <div class="text-gray-900 dark:text-gray-100">
                                                    {{ $student->school }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                                <a href="{{ route('students.edit', ['student' => $student->id]) }}">
                                                    <x-primary-button>
                                                        {{ __('生徒情報編集') }}
                                                    </x-primary-button>
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                                <a href="{{ route('tests.index', ['student' => $student->id]) }}">
                                                    <x-primary-button>
                                                        {{ __('点数入力') }}
                                                    </x-primary-button>
                                                </a>
                                                <a href="{{ route('wrong_questions.index', ['student' => $student->id]) }}" class="ml-4">
                                                    <x-primary-button>
                                                        {{ __('単語入力') }}
                                                    </x-primary-button>
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                                <a href="{{ route('attendances.index', ['student' => $student->id]) }}">
                                                    <x-primary-button>
                                                        {{ __('出席状況確認') }}
                                                    </x-primary-button>
                                                </a>
                                                
                                                @php
                                                    $todayAttendance = $student->attendances()
                                                        ->where('date', now()->toDateString())
                                                        ->first();
                                                @endphp
                                                @if ($todayAttendance)
                                                    <x-primary-button
                                                        class="ml-4 px-7 bg-gray-400 hover:bg-gray-400 cursor-not-allowed"
                                                        disabled
                                                    >
                                                        {{ $todayAttendance->status }}
                                                    </x-primary-button>
                                                @else
                                                    <a href="{{ route('attendances.create', ['student' => $student->id, 'date' => now()->toDateString()]) }}" class="ml-4">
                                                        <x-primary-button>
                                                            {{ __('出席登録') }}
                                                        </x-primary-button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="mt-6 text-gray-500 dark:text-gray-400">該当する生徒が見つかりませんでした。</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>