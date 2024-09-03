<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('To Do List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" id="create-task-form">
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

            <div id="container-task-list" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-center">
                        <table class="w-full p-6 text-center">
                            <thead>
                                <tr class="h-12">
                                    <th scope="col" class="border text-xl">{{__('User')}}</th>
                                    <th scope="col" class="border text-xl">{{__('Task')}}</th>
                                    <th scope="col" class="border text-xl">{{__('DeadLine')}}</th>
                                    <th scope="col" class="border text-xl">{{__('Status')}}</th>
                                    <th scope="col" colspan="3" class="border text-xl">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody id="task-list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    // Función para ver tareas
    function viewTask() {
        $('#task-list').empty();
        $.ajax({
        url: '/tasks/all',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        }
        }).done(function(res){
        // console.log(res); // Verifica la respuesta completa
        if(Array.isArray(res) && res.length > 0) {
            res.forEach(function(item){
                var deadline = item.deadline;
                var newdeadline = deadline.split('-').reverse().join('-');
                
                // Verifica el estado para mostrar u ocultar el botón de completar
                var completeButton = item.status === 'completed' ? '<td class="px-4 py-2 text-gray-800 dark:text-gray-200"></td>' : 
                    '<td class="px-4 py-2 text-gray-800 dark:text-gray-200">' +
                    '<button id="complete-task" class="bg-emerald-800 hover:bg-green-600 w-24 h-9 rounded-md" data-id="' + item.id +
                    '">{{ __("Completed") }}</button></td>';

                var html = '<tr class="border-b" id="fila-'+item.id+'">' +
                    '<td class="px-4 py-2 text-gray-800 dark:text-gray-200">' + item.user.name + '</td>' +
                    '<td class="px-4 py-2 text-gray-800 dark:text-gray-200 break-words">' + item.task + '</td>' +
                    '<td class="px-4 py-2 text-gray-800 dark:text-gray-200">' + newdeadline + '</td>' +
                    '<td class="px-4 py-2 text-gray-800 dark:text-gray-200" id="status">'+ item.status +'</td>' +
                    completeButton +
                    '<td class="px-4 py-2 text-gray-800 dark:text-gray-200">' +
                    '<button id="delete-task" class="bg-red-900 hover:bg-red-600 w-24 h-9 rounded-md" data-id="' + item.id +
                    '">{{ __("Delete") }}</button></td>'+
                    '<td class="px-4 py-2 text-gray-800 dark:text-gray-200">' +
                    '<button id="update-task" class=" bg-sky-900 hover:bg-sky-500 ... w-24 h-9 rounded-md" data-id="' + item.id +
                    '">{{ __("Update") }}</button></td></tr>';

                $('#task-list').append(html);
            });
        } else {
            console.log("La respuesta no es un array o está vacía.");
        }
        }).fail(function(jqXHR, textStatus, errorThrown){
        console.error("Error: " + textStatus + " - " + errorThrown);
        alert("Hubo un error en la solicitud AJAX.");
        });
    }
    viewTask();


// Función para crear una tarea
$('#create-task-form').on('submit', function(e) {
    e.preventDefault();
        $.ajax({
            url: '{{ route("task.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var deadline = response.deadline;
                var newdeadline = deadline.split('-').reverse().join('-');
                console.log(response);
                $('#task-list').append('<tr class="border-b" id="fila-'+response.id+
                            '"><td class="px-4 py-2 text-gray-800 dark:text-gray-200">'+response.user_name+'</td>'+
                            '<td class="px-4 py-2 text-gray-800 dark:text-gray-200 break-words">'+response.task+'</td>'+
                            '<td class="px-4 py-2 text-gray-800 dark:text-gray-200">'+newdeadline+'</td>'+
                            '<td class="px-4 py-2 text-gray-800 dark:text-gray-200" id="status">'+response.status+'</td>'+
                            '<td class="px-4 py-2 text-gray-800 dark:text-gray-200"><button id="complete-task" class="bg-emerald-800 hover:bg-green-600 ... w-24 h-9 rounded-md" data-id="'+response.id+
                            '">{{__("Completed")}}</button></td>'+
                            '<td class="px-4 py-2 text-gray-800 dark:text-gray-200"><button id="delete-task" class="bg-red-900 hover:bg-red-600 ... w-24 h-9 rounded-md" data-id="'+response.id+
                            '">{{__("Delete")}}</button></td>'+
                            '<td class="px-4 py-2 text-gray-800 dark:text-gray-200"><button id="update-task" class=" bg-sky-900 hover:bg-sky-500 ... w-24 h-9 rounded-md" data-id="'+response.id+
                            '">{{__("Update")}}</button></td></tr></tr>');
                $('#create-task-form')[0].reset();
                alert('Tarea creada exitosamente.');
            },
            error: function(xhr) {
                alert('Ha ocurrido un error al agregar la tarea. Por favor intenta nuevamente.');
            }
    });
});


    // Función para completar una tarea
    function completeTask(taskId, button) {
        $.ajax({
            url: '/tasks/' + taskId + '/complete',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                if (response.success) {
                    $(button).closest('tr').find('#status').text('completed');
                    $(button).remove(); 
                    alert('Tarea completada exitosamente.');
                } else {
                    alert('Error al completar tarea.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', status, error);
                alert('Ha ocurrido un error. Por favor intenta nuevamente.');
            }
        });
    }

    $(document).on('click', '#complete-task', function() {
        var taskId = $(this).data('id');
        completeTask(taskId, this);
    });







}); 

</script>