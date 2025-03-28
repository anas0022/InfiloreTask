<style>
    *{
        color:black;
    }
</style>
@include('bootstrapmodel.admin.model')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<x-app-layout>
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="background-color:white;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="header">
                        <div class="d-flex justify-content-between align-items-center">
                        <h3>Tasks assigned</h3>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTaskModal">Create Task</button>
                        </div>
                        @include('table.admin.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</x-app-layout>
<script src="{{ asset('js/admin/admin.js') }}"></script>



