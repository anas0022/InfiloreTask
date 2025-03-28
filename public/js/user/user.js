$(document).ready(function () {

    
    const table = $('#example').DataTable({
        ajax: {
            url: TaskList,
            type: "GET",
            dataSrc: 'data',
            error: function (xhr, error, code) {
                console.error('DataTables AJAX error:', {
                    xhr: xhr,
                    error: error,
                    code: code,
                    url: this.url // Log the actual URL being called
                });
                toastr.error('Failed to load tasks data');
            }
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
           
            { 
                data: 'status',
                render: function(data, type, row) {
                    if (type === 'display') {
                        const statuses = ['pending', 'in progress', 'completed'];
                        let select = `<select class="status-select" data-task-id="${row.id}">`;
                        statuses.forEach(status => {
                            // Convert both strings to lowercase for comparison
                            const selected = status.toLowerCase() === String(data).toLowerCase() ? 'selected' : '';
                            select += `<option value="${status}" ${selected}>${status}</option>`;
                        });
                        select += '</select>';
                        return select;
                    }
                    return data;
                }
            },
            { data: 'created_at',
                render: function(data, type, row) {
                    if (data) {
                        return data.split('T')[0];  // This will show only '2025-03-26'
                    }
                    return '';
                }
                
             },
            
        ],
        processing: true,
        serverSide: false
    });

    // Add table event handlers for debugging
    table.on('xhr', function (e, settings, json) {
        console.log('DataTable XHR response:', json);
    });

    // Handle status change with improved error handling
    $('#example').on('change', '.status-select', function() {
        const taskId = $(this).data('task-id');
        const newStatus = $(this).val();
        const $select = $(this);
    
        console.log('Updating task:', taskId, 'to status:', newStatus);
    
        $.ajax({
            url: `/tasks/${taskId}/status`,
            type: 'PUT',
            data: { 
                status: newStatus,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Update successful:', response);
                toastr.success('Status updated successfully');
            },
            error: function(xhr, status, error) {
                console.error('Update failed:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
                // More detailed error message
                const errorMessage = xhr.responseJSON?.message || `Error updating status: ${error}`;
                toastr.error(errorMessage);
                
                // Revert the select to previous value if there's an error
                $select.val(xhr.responseJSON?.status || '');
            }
        });
        
    });
});    