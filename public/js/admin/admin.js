$(document).ready(function () {
    // Clear all error messages when modal is opened
    $('#createTaskModal').on('show.bs.modal', function () {
        $('.error-message').text('');
        $('.form-control').removeClass('is-invalid');
    });

    $('#createTaskForm').on('submit', function(e) {
        e.preventDefault();
        
        // Clear previous error messages
        $('.error-message').text('');
        $('.form-control').removeClass('is-invalid');
        
        let formData = new FormData(this);
        
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#createTaskForm')[0].reset();
                    $('#createTaskModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then((result) => {
                        window.location.reload();
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    
                    // Display errors for each field
                    Object.keys(errors).forEach(function(field) {
                        let errorMessage = errors[field][0];
                        $(`#${field}-error`).text(errorMessage);
                        $(`#${field}`).addClass('is-invalid');
                    });

                    // Show all errors in SweetAlert
                    let errorHtml = '<div class="text-left">';
                    Object.keys(errors).forEach(function(field) {
                        errorHtml += `<p class="mb-0"><strong>${field}:</strong> ${errors[field][0]}</p>`;
                    });
                    errorHtml += '</div>';

                   
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong! Please try again.'
                    });
                }
            }
        });
    });
}); 


$(document).ready(function () {
    const table = $('#example').DataTable({
        ajax: {
            url: TaskList,
            type: "GET",
            dataSrc: 'data'
        },
        columns: [
            { 
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'title' },
            { data: 'priority' },
            { 
                data: 'due_date',
                render: function(data, type, row) {
                    if (data) {
                        return data.split('T')[0];  // This will show only '2025-03-26'
                    }
                    return '';
                }
            },
            { data: 'user.name' },
            { data: 'status' },
            { data: 'created_at',
                render: function(data, type, row) {
                    if (data) {
                        return data.split('T')[0];  // This will show only '2025-03-26'
                    }
                    return '';
                }
                
             },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-info btn-sm" onclick="editTask('${row.id}','${row.title}','${row.priority}','${row.due_date}','${row.user_id}','${row.status}','${row.description}')">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteTask(${row.id})">
                            <i class="fa fa-trash"></i>
                        </button>
                    `;
                }
            }
        ],
        processing: true,
        serverSide: false
    });
});

function editTask(id, title, priority, due_date, user_id, status, description) {
    $('#id').val(id);
    $('#title').val(title);
    $('#priority').val(priority);
    $('#due_date').val(due_date ? due_date.split('T')[0] : '');
    $('#user_id').val(user_id);
    $('#status').val(status);
    $('#description').val(description);


    $('#createTaskModalLabel').text('Edit Task');
    $('#createTaskModal').modal('show');
}

function deleteTask(id){

Swal.fire({
    title: 'Are you sure?',
    text: 'You will not be able to recover this task!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel',
    reverseButtons: true
}).then((result) => {
    if (result.isConfirmed) {
        $.ajax({    
            url: '/tasks/delete/' + id,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                if(response.success){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then((result) => {
                        window.location.reload();
                    });
                    }
            }
            
        });
    }
});
}
