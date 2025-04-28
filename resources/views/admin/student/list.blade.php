@extends('admin.master')
@section('body')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center fw-bolder">
                    <h1 class="fw-bold">Student Information</h1>

                </div>
                <div class="card-body">

                    <div class="table-responsive-sm">
                        <table class="table table-striped mb-0">
                            <thead>
                            <p class="text-end text-danger">{{session('message')}}</p>
                            <form action="{{route('student.list')}}" method="GET">
                                @csrf
                                <div class="mb-3 d-flex">

                                    <input type="text" id="example-email" name="name" class="form-control mb-2"  style="width:500px !important;" placeholder="search by name or email">
                                    <input type="submit" value="search" class="btn btn-success" style="margin-left:20px !important; " >
                                    <a href="{{route('student.list')}}" class="btn btn-primary" style="margin-left:20px !important;">Clear</a>
                                </div>

                            </form>
                            <tr>
                                <th>Sl</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date of Birth</th>
                                <th>Action</th>
                                <th>Created_at</th>
                                <th>updated_at</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                   {{$student->name}}
                                </td>
                                <td>  {{$student->email}}</td>
                                <td>  {{$student->phone}}</td>
                                <td>  {{$student->date_of_birth}}</td>
                                <td class="text-muted">
                                    <a href="{{route('student.edit',['id'=>$student->id])}}" class="link-reset fs-20 p-1"> <i
                                            class="ri-pencil-line"></i></a>
                                    <a href="{{route('student.delete',['id'=>$student->id])}}" class="link-reset fs-20 p-1"> <i
                                            class="ri-delete-bin-line" onclick="return confirm('Are You Sure?')"></i></a>
                                </td>
                                <td>{{$student->created_at}}</td>
                                <td>{{$student->updated_at}}</td>


                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->


    </div>
@endsection
