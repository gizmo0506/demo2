@extends('layouts.app')

@section('content')

<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
 
<div class="container">
  <div class="card push-top">
    <div class="card-header">
      Add Employee
    </div>

    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif
        <form method="post" action="{{ route('employees.store') }}">
            <div class="form-group">
                @csrf
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name"/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email"/>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" name="phone"/>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="text" class="date form-control" name="dob" />
            </div>
            <button type="submit" class="btn btn-block btn-danger">Create User</button>
        </form>
    </div>
  </div>
</div>

<script type="text/javascript">

    $('.date').datepicker({  

       format: 'dd-mm-yyyy'

     });  

</script> 
@endsection