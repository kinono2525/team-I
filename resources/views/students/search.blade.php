<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            👥 {{ __('生徒選択') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="max-w-7xl mx-auto mt-4"
        >
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">成功！</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- 検索フォーム -->
                    <h2 class="text-2xl font-semibold mx-4 mb-6">🔍 生徒検索フォーム</h2>
                    <form method="GET" action="{{ route('students.search') }}" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="name_kanji" :value="__('氏名（漢字）')" />
                                <x-text-input id="name_kanji" name="name_kanji" type="text" class="mt-1 block w-full" value="{{ request('name_kanji') }}" />
                            </div>
                            <div>
                                <x-input-label for="name_kana" :value="__('氏名（カナ）')" />
                                <x-text-input id="name_kana" name="name_kana" type="text" class="mt-1 block w-full" value="{{ request('name_kana') }}" />
                            </div>
                            <div>
                                <x-input-label for="gender" :value="__('性別')" />
                                <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">選択してください</option>
                                    <option value="男" {{ request('gender') == '男' ? 'selected' : '' }}>男</option>
                                    <option value="女" {{ request('gender') == '女' ? 'selected' : '' }}>女</option>
                                </select>
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
                        <h2 class="text-2xl font-semibold m-4">📋 検索結果</h2>
                        @if ($students->count() > 0)
                            <div class="flex flex-nowrap space-x-3 overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">生徒ID</span>
                                            </th>
                                            <th class="px-5 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">氏名</span>
                                            </th>
                                            <th class="px-5 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">性別</span>
                                            </th>
                                            <th class="px-5 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">学年</span>
                                            </th>
                                            <th class="px-5 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">学校名</span>
                                            </th>
                                            <th class="px-5 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">詳細</span>
                                            </th>
                                            <th class="px-5 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">生徒情報編集</span>
                                            </th>
                                            <th class="px-5 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">テスト関連</span>
                                            </th>
                                            <th class="px-5 py-3 bg-gray-50 dark:bg-gray-700 text-left">
                                                <span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">出席関連</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($students as $student)
                                            <tr>
                                                <td class="px-4 py-4 whitespace-no-wrap text-sm">
                                                    <div class="text-gray-900 dark:text-gray-900">
                                                        {{ $student->id }}
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 whitespace-no-wrap text-sm">
                                                    <div class="text-gray-900 dark:text-gray-900">
                                                        <ruby>
                                                            {{ $student->name_kanji }}
                                                            <rt>{{ $student->name_kana }}</rt>
                                                        </ruby>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 whitespace-no-wrap text-sm">
                                                    <div class="text-gray-900 dark:text-gray-900">
                                                        {{ $student->gender }}
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 whitespace-no-wrap text-sm">
                                                    <div class="text-gray-900 dark:text-gray-900">
                                                        {{ $student->grade }}
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 whitespace-no-wrap text-sm">
                                                    <div class="text-gray-900 dark:text-gray-900">
                                                        {{ $student->school }}
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 whitespace-no-wrap text-sm">
                                                    <div class="flex space-x-4">
                                                        <a href="{{ route('students.detail', ['student' => $student->id]) }}">
                                                            <x-primary-button class="whitespace-nowrap">
                                                                📋 {{ __('詳細') }}
                                                            </x-primary-button>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 whitespace-no-wrap text-sm">
                                                    <div class="flex space-x-4">
                                                        <a href="{{ route('students.edit', ['student' => $student->id]) }}">
                                                            <x-primary-button class="whitespace-nowrap">
                                                                ✏️ {{ __('生徒情報編集') }}
                                                            </x-primary-button>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 whitespace-no-wrap text-sm">
                                                    <div class="flex space-x-4">
                                                        <a href="{{ route('tests.index', ['student' => $student->id]) }}">
                                                            <x-primary-button class="whitespace-nowrap">
                                                                📝 {{ __('点数入力') }}
                                                            </x-primary-button>
                                                        </a>
                                                        <a href="{{ route('wrong_questions.index', ['student' => $student->id]) }}" class="ml-3">
                                                            <x-primary-button class="whitespace-nowrap">
                                                                📖 {{ __('単語入力') }}
                                                            </x-primary-button>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 whitespace-no-wrap text-sm">
                                                    <div class="flex space-x-4">
                                                        <a href="{{ route('attendances.index', ['student' => $student->id]) }}">
                                                            <x-primary-button class="whitespace-nowrap">
                                                                📅 {{ __('出席状況確認') }}
                                                            </x-primary-button>
                                                        </a>
                                                        </a>
                                                    
                                                        @php
                                                            $todayAttendance = $student->attendances()
                                                                ->where('date', now()->toDateString())
                                                                ->first();
                                                        @endphp
                                                        @if ($todayAttendance)
                                                            <x-primary-button
                                                                class="ml-3 px-7 !bg-gray-400 !hover:bg-gray-400 cursor-not-allowed whitespace-nowrap"
                                                                disabled
                                                            >
                                                                {{ $todayAttendance->status == '出席' ? '✅' : ($todayAttendance->status == '遅刻' ? '⏰' : '❌') }} {{ $todayAttendance->status }}
                                                            </x-primary-button>
                                                        @else
                                                            <a href="{{ route('attendances.create', ['student' => $student->id, 'date' => now()->toDateString()]) }}" class="ml-3">
                                                                <x-primary-button class="whitespace-nowrap">
                                                                    ➕ {{ __('出席登録') }}
                                                                </x-primary-button>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @else
                            <p class="mt-6 text-gray-500 dark:text-gray-400">該当する生徒が見つかりませんでした。</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>