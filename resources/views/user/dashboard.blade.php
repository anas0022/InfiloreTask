
<x-app-layout  >
  
<style>
    *{
        color: black;
      
    }
  
</style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="header">
                        <h3>Tasks</h3>

                    </div>
                    @include('table.user.table')

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    var TaskList = "{{ route('user.tasks.list') }}";
</script>

@endpush