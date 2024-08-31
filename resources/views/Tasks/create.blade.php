<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('task.store')}}" method="post">
                        @csrf
                        <label class="block">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-base font-medium text-gray-900 dark:text-gray-100">
                                {{__('Task')}}
                            </span>
                            <textarea name="task" 
                                class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                placeholder="{{ __('What\'s on your mind?') }}"
                            >{{ old('task') }}</textarea>
                            @error('task')
                                    <x-input-error : messages="{{$message}}"
                                    class="mt-2"/>
                            @enderror
                        </label>

                        <label class="block mt-3">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-base font-medium text-gray-900 dark:text-gray-100">
                                {{__('DeadLine')}}
                            </span>
                            <input type="date" id="deadline" name="deadline" value="" min="2024-08-31" max="2025-12-31" 
                            class="text-gray-900 dark:text-gray-100 bg-transparent rounded-md dark:[color-scheme:dark]"/>
                            @error('deadline')
                                    <x-input-error : messages="{{$message}}"
                                    class="mt-2"/>
                            @enderror
                        </label>

                        <label class="block mt-3">
                            <fieldset>
                                <legend class="text-gray-900 dark:text-gray-100 ">{{__('Task Status')}}</legend>
                                <input id="pending" class="peer/pending m-1" type="radio" value="pending" name="status" checked />
                                <label for="pending" class="peer-checked/pending:text-red-500 mr-4">{{__('Pending')}}</label>

                                <input id="completed" class="peer/completed m-1" type="radio" value="completed" name="status" />
                                <label for="completed" class="peer-checked/completed:text-green-500">{{__('Completed')}}</label>
                            </fieldset>
                        </label>

                        <button class="mt-6 bg-sky-900 hover:bg-sky-500 ... w-24 h-9 rounded-md">
                            {{__('Create')}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>