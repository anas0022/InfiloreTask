
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<table id="example" class="display" style="width:100%;" class="methodTable">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Title</th>
            <th class="text-center">Priority</th>
            <th class="text-center">Due Date</th>
       
            <th class="text-center">Status</th>
            <th class="text-center">Created on</th>                                                                          
           
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
    var TaskList = "{{ route('user.tasks.list') }}"
</script>
<script src="{{ asset('js/user/user.js') }}"></script>