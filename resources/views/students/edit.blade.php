<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('生徒情報編集') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('students.update', ['student' => $student->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="name_kanji" :value="__('氏名（漢字）')" />
                                <x-text-input id="name_kanji" name="name_kanji" type="text" class="mt-1 block w-full bg-gray-100 text-gray-700" value="{{ $student->name_kanji }}" readonly />
                            </div>
                            <div>
                                <x-input-label for="name_kana" :value="__('氏名（カナ）')" />
                                <x-text-input id="name_kana" name="name_kana" type="text" class="mt-1 block w-full bg-gray-100 text-gray-700" value="{{ $student->name_kana }}" readonly />
                            </div>
                            <div>
                                <x-input-label for="gender" :value="__('性別')" />
                                <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm bg-gray-100" disabled>
                                    <option value="男" {{ $student->gender == '男' ? 'selected' : '' }}>男</option>
                                    <option value="女" {{ $student->gender == '女' ? 'selected' : '' }}>女</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="grade" :value="__('学年')" />
                                <select id="grade" name="grade" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="1" {{ $student->grade == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $student->grade == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $student->grade == '3' ? 'selected' : '' }}>3</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="school" :value="__('学校名')" />
                                <x-text-input id="school" name="school" type="text" class="mt-1 block w-full" value="{{ $student->school }}" required />
                            </div>
                        </div>
                        <div class="mt-6">
                            <x-primary-button>{{ __('更新') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>