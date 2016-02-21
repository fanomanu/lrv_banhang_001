@extends('admin.master')
@section('page-header')
    User
    <small>List</small>
@endsection
@section('content')
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>Username</th>
                <th>Level</th>
                <th>Status</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user) 
                <tr class="odd gradeX" align="center">
                    <td>1</td>
                    <td>{!! $user['username'] !!}</td>
                    <td>
                        @if ($user['id'] == 1)
                            Super Admin
                        @elseif ($user['level'] == 1)
                            Admin
                        @else
                            Member
                        @endif
                    </td>
                    <td>Hiện</td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{!! route('admin.user.getDelete',$user['id']) !!}" onclick="return xacnhanxoa('Bạn có chắc muốn xóa user này.');"> Delete</a></td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.user.getEdit',$user['id']) !!}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection