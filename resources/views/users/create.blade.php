@extends('layout.app')
@section('title', 'Create User')
@section('content')

<main class="content-wrapper">
    <div class="container">
        <h2 class="mt-4">Create User</h2>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">

                        <!-- Full Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') }}" required>
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group" style="margin-bottom:20px">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                                <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
                                    <i class="fas fa-eye"></i> <!-- Initial eye icon -->
                                </span>
                            </div>
                            <button type="button" class="btn btn-outline-secondary btn-info" id="generate-password">Generate</button>
                            <button type="button" class="btn btn-outline-secondary btn-info" id="copy-password">Copy</button>
                            <span id="copy-message" class="text-success d-none">Copied!</span> <!-- Hidden copy message -->
                            @error('password')  
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <!-- Role Selection -->
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="" disabled selected>Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6 mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Work Joined -->
                        <div class="col-md-6 mb-3">
                            <label for="work_joined" class="form-label">Work Joined</label>
                            <input type="date" class="form-control @error('work_joined') is-invalid @enderror" name="work_joined" id="work_joined" value="{{ old('work_joined') }}">
                            @error('work_joined')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <select name="department" id="department" class="form-select @error('department') is-invalid @enderror" required>
                                <option value="" disabled selected>Select Departments</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Designation -->
                        <div class="col-md-6 mb-3">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation" value="{{ old('designation') }}">
                            @error('designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photo -->
                        <div class="col-md-6 mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo">
                            @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
$('#generate-password').click(function(e){
    e.preventDefault();

    const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
    const length = 12; // Define the desired password length
    let password = "";

    // Loop to generate password based on the length
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * charset.length);
        password += charset[randomIndex];
    }

    // Display the generated password in an alert and set it to the input field
    alert(password);
    $('#password').val(password);

});

$('#toggle-password').on('click', function() {
        const passwordInput = $('#password');
        const icon = $(this).find('i');

        // Check the current type of the password input field
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text'); // Show password
            icon.removeClass('fa-eye').addClass('fa-eye-slash'); // Switch to eye-slash icon
        } else {
            passwordInput.attr('type', 'password'); // Hide password
            icon.removeClass('fa-eye-slash').addClass('fa-eye'); // Switch back to eye icon
        }
    });

$('#copy-password').on('click', function() {
        const passwordInput = $('#password');
        passwordInput.select();
        document.execCommand('copy');
        $('#copy-message').removeClass('d-none');

        
    
    });


  </script>

@endsection
