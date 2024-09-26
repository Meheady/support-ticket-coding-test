@extends('admin.layout')
@section('content')
    <div>
        <h1>Departments</h1>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
            Add Department
        </button>
        <div class="modal fade" id="addDepartmentModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addDepartmentForm" method="post">
                        <div class="modal-header">
                            <h6 class="modal-title" id="addDepartmentModalLabel">Add Department</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table mt-3">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="departmentTableBody">
            @foreach($departments as $department)
                <tr data-id="{{ $department->id }}">
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->description }}</td>
                    <td><img src="{{ asset($department->image) }}"  width="50px" height="50px" alt=""></td>
                    <td>{{ $department->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-department" data-id="{{ $department->id }}">Edit</button>
                        <button class="btn btn-danger btn-sm delete-department" data-id="{{ $department->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="editDepartmentModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editDepartmentForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="edit_department_id" name="department_id">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_description" class="form-label">Description</label>
                                <textarea class="form-control" id="edit_description" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="edit_image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="edit_image" name="image">
                                <img id="edit_image_preview" src="#" alt="Current Image" class="img-thumbnail" width="50" height="50">

                            </div>
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status</label>
                                <select class="form-select" id="edit_status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#addDepartmentForm').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('admin.departments.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response.success){
                            alert(response.message)
                            $('#addDepartmentForm').modal('hide');
                            location.reload();
                        };

                    },
                    error: function (error) {

                    }
                });
            });

            $('.edit-department').on('click', function () {
                var departmentId = $(this).data('id');
                $.ajax({
                    url: '/admin/departments/' + departmentId,
                    type: 'GET',
                    success: function (data) {
                        $('#edit_department_id').val(data.id);
                        $('#edit_name').val(data.name);
                        $('#edit_description').val(data.description);
                        $('#edit_status').val(data.status);

                        if (data.image) {
                            $('#edit_image_preview').attr('src', data.image);
                        } else {
                            $('#edit_image_preview').attr('src', '');
                        }

                        $('#editDepartmentModal').modal('show');
                    }
                });
            });

            $('#editDepartmentForm').on('submit', function (e) {
                e.preventDefault();
                let departmentId = $('#edit_department_id').val();
                let formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '/admin/departments-update/' + departmentId,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success){
                            alert(response.message);
                            $('#editDepartmentModal').modal('hide');
                            location.reload();
                        }

                    },
                    error: function (error) {

                    }
                });
            });

            $('.delete-department').on('click', function () {
                var departmentId = $(this).data('id');
                if (confirm('Are you sure?')) {
                    $.ajax({
                        url: '/admin/departments-delete/' + departmentId,
                        type: 'get',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.success){
                                alert(response.message);
                                location.reload();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
