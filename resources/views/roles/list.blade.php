@extends('layout.app')
@section('title', 'Role List')
@section('content')

<style>
 .table thead tr th , .table tbody tr td {
    text-align: center;
    font-size:15px !important;
  }
  </style>
<main class="content-wrapper">
  <div class="mdc-layout-grid">
    <div class="mdc-layout-grid__inner">
    
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
        <div class="mdc-card p-0">
          <h6 class="card-title card-padding pb-0">Role List</h6>
          <div class="table-responsive col-md-8 ">
            @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
            <table class="table table-striped">
              <thead>
                <tr>
                  <th >Sl no</th>
                  <th>Role</th>
                  <th>Action</th>
            
              
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $role)
                <tr>
                  <td >{{$role->id}}</td>
                  <td>{{$role->name}}</td>
                  <td><a  href="{{ route('roles.edit', $role->id) }}" class="mdc-button mdc-button--raised icon-button filled-button--success mdc-ripple-upgraded" style="--mdc-ripple-fg-size: 21px; --mdc-ripple-fg-scale: 2.900556583115782; --mdc-ripple-fg-translate-start: 12.1280517578125px, 2.5699462890625px; --mdc-ripple-fg-translate-end: 7.5px, 7.5px;">
                    <i class="material-icons mdc-button__icon">colorize</i>
                  </a>
                  <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mdc-button mdc-button--raised icon-button filled-button--danger mdc-ripple-upgraded">
                        <i class="material-icons mdc-button__icon">delete</i>
                    </button>
                </form>
                
                
                </td>
              
                </tr>
                @endforeach
              
             
           
            
            
            
         
              
              
         
              </tbody>
            </table>
          </div>
        </div>
      </div>
   
    </div>
  </div>
</main>
       

        @endsection