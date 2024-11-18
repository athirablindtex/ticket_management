@extends('layout.app')
@section('title', 'User Details')
@section('content')
<style>
    .icon {
    margin-right: 8px;
}

.info-group {
    display: flex;
    align-items: center;
}

.card {
    border-radius: 10px;
    overflow: hidden;
}

.card-header {
    border-bottom: 2px solid #ccc;
}

.btn-light {
    background-color: #f0f0f0;
    color: #333;
}

.btn-light:hover {
    background-color: #e0e0e0;
}

.card-body {
    padding: 20px;
}

.form-label {
    font-weight: 600;
}

    </style>
<main class="content-wrapper">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- User Details Section -->
                <div id="user-details" class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">User Information</h5>
                        <button class="btn btn-sm btn-light" id="edit-button">Edit</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Column: User Photo -->
                            <div class="col-md-4 text-center">
                                <p><strong>Photo:</strong></p>
                                <img src="{{ asset('public/storage/' . $user->photo) }}" alt="User Photo" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                            </div>

                            <!-- Right Column: User Information -->
                            <div class="col-md-8">
                                @foreach(['name' => 'User Name', 'phone' => 'Phone', 'email' => 'Email', 'username' => 'Username', 'date_of_birth' => 'Date of Birth', 'work_joined' => 'Work Joined', 'department' => 'Department', 'designation' => 'Designation'] as $field => $label)
                                    <div class="info-group mb-2">
                                        <i class="fas fa-{{ $field === 'department' ? 'building' : ($field === 'work_joined' || $field === 'date_of_birth' ? 'calendar' : ($field === 'email' ? 'envelope' : ($field === 'phone' ? 'phone' : 'user')) ) }} icon"></i>
                                        <p><strong>{{ $label }}:</strong> <span id="display-{{ $field }}">{{ $field === 'department' ? ($user->department->name ?? 'N/A') : $user->$field }}</span></p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Form (Initially Hidden) -->
                <div id="edit-user-form" class="card d-none mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Edit User Information</h5>
                        <button class="btn btn-sm btn-light" id="edit-button">Edit</button>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h4>Edit User Details</h4>
                                </div>
                                        @foreach(['name' => 'Full Name', 'phone' => 'Phone', 'email' => 'Email', 'username' => 'Username', 'designation' => 'Designation'] as $field => $label)
                                            <div class="col-md-6 mb-3">
                                                
                                                
                                                        <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                                        <input type="{{ $field === 'password' ? 'password' : 'text' }}" class="form-control @error($field) is-invalid @enderror" name="{{ $field }}" id="{{ $field }}" value="{{ $field === 'password' ? '' : $user->$field }}" >
                                                        @error($field)
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                
                                            
                                            </div>
                                        @endforeach
                            <div class="col-md-6 mb-3">
                                <a class="form-label btn btn reset-pass">Reset Password</a>
                                <div id="show_password"  style="display:none">
                                    <label for="Password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error($field) is-invalid @enderror" name="password" id="password" >
                                    @error($field)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                                        <option value="" disabled>Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ $user->role == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" value="{{ $user->date_of_birth }}">
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="work_joined" class="form-label">Work Joined</label>
                                    <input type="date" class="form-control @error('work_joined') is-invalid @enderror" name="work_joined" id="work_joined" value="{{ $user->work_joined }}">
                                    @error('work_joined')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="department" class="form-label">Department</label>
                                    <select name="department" id="department" class="form-select @error('department') is-invalid @enderror" required>
                                        <option value="" disabled>Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="photo" class="form-label">User Photo</label>
                                    
                                    <!-- Display Previous Photo -->
                                    @if($user->photo)
                                        <div class="mb-2">
                                            <img src="{{ asset('public/storage/' . $user->photo) }}" alt="User Photo" class="img-thumbnail" style="max-width: 150px;">
                                        </div>
                                    @endif
                                
                                    <!-- File Input for New Photo -->
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo" accept="image/*">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Update User</button>
                                    <button type="button" class="btn btn-secondary cancel-edit-button">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $('#edit-button').click(function() {
        $('#user-details').hide(); // Hide user details
        $('#edit-user-form').removeClass('d-none').show(); // Show edit form
    });

    $('.cancel-edit-button').click(function() {
        $('#edit-user-form').addClass('d-none').hide(); // Hide edit form
        $('#user-details').show(); // Show user details
    });
    $('.reset-pass').click(function(){
        $('#show_password').show();
        $('.reset-pass').hide();

    });
</script>
@endsection
