@extends('layout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>



<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div>
        <div class="mx-auto pull-right">
            <div class="">
                <form action="{{ route('employees.index') }}" method="GET" role="search">

                    <div class="input-group">
                        <span class="input-group-btn mr-5 mt-1">
                            <button class="btn btn-info" type="submit" title="Search Employees">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Search Employees" id="term">
                        <a href="{{ route('employees.index') }}" class=" mt-1">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Name</td>
          <td>Email</td>
          <td>Phone</td>
          <td>Date of Birth</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($employee as $employees)
        <tr>
            <td>{{$employees->id}}</td>
            <td>{{$employees->name}}</td>
            <td>{{$employees->email}}</td>
            <td>{{$employees->phone}}</td>
            <td>{{$employees->dob}}</td>
            <td class="text-center">
                <a href="{{ route('employees.edit', $employees->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                <form action="{{ route('employees.destroy', $employees->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $employee->links() !!}
        </div>
<div>
@endsection