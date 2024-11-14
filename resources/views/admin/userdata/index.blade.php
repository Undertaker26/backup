@extends('admin.dashboard')
<title>Student Records</title>
@section('content')
<div class="col-md-9 offset-md-3 main-content">
<div class="card mt-4"> 
<br>
<br>
               <center><h4 style="background-color:#007bff ;color:white">Student Records</h4>
                <div class="card-body">
            <table class="table table-bordered table-striped">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Student ID</th>
                        <th>Username</th>
                        <th>Course</th>
                        <th>City</th>
                        <th>Barangay</th>
                        <th>Birthday</th>


                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <!-- <td>{{ $user->id }}</td> -->
                            <td>{{ $user->student_id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->course }}</td>
                            <td>{{ $user->city }}</td>
                            <td>{{ $user->barangay }}</td>
                            <td>{{ $user->bday }}</td>


                    
                            <!-- <td>{{ $user->usertype }}</td> -->
                            
                                                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
   
   .main-content {
       margin-left: 290px;
       /* padding: 10px; */
   }
   .btn-primary {
       margin-top: 5px;
       margin-bottom: 15px;
   }
   .card {
       margin-top: 20px;
   }
   .table {
       margin-top: 10px;
       font-size: 12px;
   }
   .btn-sm {
       margin-right: 5px;
   }
</style>
@endsection