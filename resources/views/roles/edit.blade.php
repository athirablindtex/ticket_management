@extends('layout.app')
@section('title', 'Edit Role')
@section('content')

<main class="content-wrapper">
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Important for PUT method -->
                    
                    <div class="mdc-card">
                        <h6 class="card-title">Role Manager - Edit</h6>
                        <div class="template-demo">
                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field mdc-text-field--outlined">
                                        <input class="mdc-text-field__input" id="text-field-hero-input" name="name" value="{{ old('name', $role->name) }}">
                                        <div class="mdc-notched-outline">
                                            <div class="mdc-notched-outline__leading"></div>
                                            <div class="mdc-notched-outline__notch">
                                                <label for="text-field-hero-input" class="mdc-floating-label">Name</label>
                                            </div>
                                            <div class="mdc-notched-outline__trailing"></div>
                                        </div>
                                    </div>
                              
                                    @error('name')
                                    <div class="col-sm-12">
                        <button class="mdc-button text-button--secondary mdc-ripple-upgraded" style="--mdc-ripple-fg-size: 65px; --mdc-ripple-fg-scale: 1.9292245467422369; --mdc-ripple-fg-translate-start: 14.367950439453125px, -17.177978515625px; --mdc-ripple-fg-translate-end: 22.3203125px, -14.5px;">{{ $message }}</button>
                    </div>      
                        @enderror
                              
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mdc-card">
                        <h6 class="card-title">Permissions</h6>
                        <div class="template-demo">
                            @if(!empty($permissions))
                            <div class="mdc-form-field">
                                <div class="mdc-checkbox">
                                    <input type="checkbox" id="check-all" class="mdc-checkbox__native-control"/>
                                    <div class="mdc-checkbox__background">
                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                            <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                                        </svg>
                                        <div class="mdc-checkbox__mixedmark"></div>
                                    </div>
                                </div>
                                <label for="check-all">Select All Permissions</label>
                            </div>
                            @foreach($permissions as $permission)
                            <div class="mdc-form-field">
                                <div class="mdc-checkbox">
                                    <input type="checkbox" class="mdc-checkbox__native-control permission-checkbox" 
                                           name="permissions[]" value="{{ $permission->id }}" 
                                           {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}/>
                                    <div class="mdc-checkbox__background">
                                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                            <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                                        </svg>
                                        <div class="mdc-checkbox__mixedmark"></div>
                                    </div>
                                </div>
                                <label>{{ $permission->name }}</label>
                            </div>
                            @endforeach
                            @endif
                            <div class="col-sm-12">

                            <!-- Display validation error if any -->
                            @error('permissions')
                            <button class="mdc-button text-button--secondary mdc-ripple-upgraded" style="--mdc-ripple-fg-size: 65px; --mdc-ripple-fg-scale: 1.9292245467422369; --mdc-ripple-fg-translate-start: 14.367950439453125px, -17.177978515625px; --mdc-ripple-fg-translate-end: 22.3203125px, -14.5px;">{{ $message }}</button>
                            @enderror
                            </div>

                            <!-- Submit button -->
                            <div class="mdc-card">
                                <div class="mdc-form-field">
                                    <button type="submit" class="mdc-button mdc-button--unelevated">Update Role</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('check-all');
    const checkboxes = document.querySelectorAll('.permission-checkbox');

    checkAll.addEventListener('change', function() {
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = checkAll.checked;
        });
    });

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (!checkbox.checked) {
                checkAll.checked = false;
            } else if ([...checkboxes].every(checkbox => checkbox.checked)) {
                checkAll.checked = true;
            }
        });
    });
});
</script>

@endsection