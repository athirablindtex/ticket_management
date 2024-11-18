@extends('layout.app')
@section('title', 'User Role List')
@section('content')

    <style>
        .table thead tr th,
        .table tbody tr td {
            text-align: center;
            font-size: 15px !important;
        }
    </style>

    <main class="content-wrapper">
        <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                    <div class="mdc-card p-0">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="card-title card-padding pb-0">User Role List</h6>
                            </div>
                            <div class="col-md-4 card-title card-padding pb-0">
                                <a href="{{ route('users.create') }}"
                                    class="mdc-button mdc-button--raised icon-button filled-button--warning mdc-ripple-upgraded"
                                    style="--mdc-ripple-fg-size: 21px; --mdc-ripple-fg-scale: 2.900556583115782; --mdc-ripple-fg-translate-start: 8.1072998046875px, 12.2181396484375px; --mdc-ripple-fg-translate-end: 7.5px, 7.5px;">
                                    <i class="material-icons mdc-button__icon">add</i>
                            </a>
                            </div>
                        </div>
                        <div class="table-responsive col-md-8">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl no</th>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <img src="{{ $user->photo ? asset('public/storage/' . $user->photo) : asset('public/storage/photos/no_image.png') }}"
                                                    alt="User Photo"
                                                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">

                                                <!-- Use a default image if no photo exists -->
                                            </td>
                                            <td>{{ $user->designation ?? 'N/A' }}</td>
                                            <td>{{ $user->department->name ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y g:i A') }}</td>
                                            <!-- Format to include time -->
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="mdc-button mdc-button--raised icon-button filled-button--success mdc-ripple-upgraded">
                                                    <i class="material-icons mdc-button__icon">colorize</i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="mdc-button mdc-button--raised icon-button filled-button--danger mdc-ripple-upgraded">
                                                        <i class="material-icons mdc-button__icon">delete</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
