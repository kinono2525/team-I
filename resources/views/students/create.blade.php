<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('生徒情報登録') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="max-w-7xl mx-auto mt-4"
        >
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">成功！</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('students.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="name_kanji" :value="__('氏名（漢字）')" />
                                <x-text-input id="name_kanji" name="name_kanji" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div>
                                <x-input-label for="name_kana" :value="__('氏名（カナ）')" />
                                <x-text-input id="name_kana" name="name_kana" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div>
                                <x-input-label for="gender" :value="__('性別')" />
                                <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">選択してください</option>
                                    <option value="男">男</option>
                                    <option value="女">女</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="grade" :value="__('学年')" />
                                <select id="grade" name="grade" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">選択してください</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="school" :value="__('学校名')" />
                                <x-text-input id="school" name="school" type="text" class="mt-1 block w-full" required />
                            </div>
                        </div>
                        <div class="mt-6 text-right">
                            <x-primary-button class="px-6">{{ __('登録') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>