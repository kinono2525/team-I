<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('生徒詳細') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					<h2 class="text-xl font-semibold mb-4">タスク一覧</h2>
					<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
	
							<tr>
								<th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
									<span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">タスク名</span>
								</th>
								<th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
									<span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">期限</span>
								</th>
								<th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">
									<span class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ステータス</span>
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
													@foreach ($tasks as $task)
													<tr>
														<td class="px-6 py-4 whitespace-no-wrap text-sm">{{ $task['name'] }}</td>
														<td class="px-6 py-4 whitespace-no-wrap text-sm">{{ $task['deadline'] }}</td>
														<td class="px-6 py-4 whitespace-no-wrap text-sm">{{ $task['status'] }}</td>
													</tr>
													@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
