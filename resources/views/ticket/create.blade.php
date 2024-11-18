@extends('layout.app')
@section('title', 'Create Ticket')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <main class="content-wrapper">
        <div class="container">
            <h2 class="mt-4">Create Ticket</h2>
            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">



                            <!-- Support Category -->
                            <div class="col-md-6 mb-3">
                                <label for="support_category" class="form-label">Support Category</label>
                                <input type="text" class="form-control @error('support_category') is-invalid @enderror"
                                    name="support_category" id="support_category" value="{{ old('support_category') }}"
                                    required>
                                @error('support_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Issue -->
                            <div class="col-md-6 mb-3">
                                <label for="issue" class="form-label">Issue</label>
                                <input type="text" class="form-control @error('issue') is-invalid @enderror"
                                    name="issue" id="issue" value="{{ old('issue') }}" required>
                                @error('issue')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-md-6 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Priority -->
                            <div class="col-md-6 mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select name="priority" id="priority"
                                    class="form-select @error('priority') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select Priority</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                                @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deadline -->
                            <div class="col-md-6 mb-3">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                                    name="deadline" id="deadline" value="{{ old('deadline') }}">
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="row">
                                <!-- Existing Inputs -->

                                <!-- Drag and Drop for Photo -->
                                <div class="col-md-12 mb-3">
                                    <label for="photo" class="form-label">Upload Image</label>
                                    <div id="photo-dropzone" class="dropzone border border-dashed p-3">
                                        <div class="dz-message">
                                            Drag and drop an image here or click to upload
                                        </div>
                                    </div>
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- User ID -->
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">Assigned To</label>
                                <select name="user_id" id="user_id"
                                    class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                    </div>

                    <button type="submit" class="btn btn-primary">Create Ticket</button>
                </div>
        </div>
        </form>
        </div>
    </main>

    <script>
        Dropzone.options.photoDropzone = {
            url: "http://162.214.72.98/~developmenttes/ticket_management/tickets/upload", // Your backend route for image upload
            paramName: "photo", // Input name
            maxFilesize: 2, // Maximum file size (in MB)
            acceptedFiles: "image/*", // Allow only image files
            addRemoveLinks: true, // Show a remove button for uploaded files
            dictDefaultMessage: "Drag and drop an image here or click to upload",

            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },

            init: function() {
                let uploadedImages = [];
                this.on("success", function(file, response) {
                    // Store the uploaded image paths
                    uploadedImages.push(response.path);

                    // Append the uploaded image path to a hidden input field
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'images[]';
                    input.value = response.path;
                    document.querySelector('form').appendChild(input);
                });

                this.on("removedfile", function(file) {
                    // Remove the corresponding hidden input field when a file is removed
                    const inputs = document.querySelectorAll('input[name="images[]"]');
                    inputs.forEach((input) => {
                        if (input.value === file.name) {
                            input.remove();
                        }
                    });
                });
            }
        };
    </script>

@endsection
