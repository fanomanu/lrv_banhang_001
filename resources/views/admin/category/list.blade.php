@extends('admin.master')
@section('page-header')
    Category
    <small>List</small>
@endsection
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Category Parent</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 0; ?>

        @foreach ($data as $item)
        <?php $stt = $stt + 1; ?>
            <tr class="odd gradeX" align="center">
                <td>{!! $stt !!}</td>
                <td>{!! $item['name'] !!}</td>
                <td>
                    @if ($item['parent_id'] == 0)
                        {!! 'none' !!}
                    @else
                        <?php 
                           $parent = DB::table('categories')->select('name')->where('id',$item['parent_id'])->first();
                           echo $parent->name;
                        ?>
                    @endif
                </td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return xacnhanxoa('Bạn có chắc muốn xóa');" href="{!! URL::route('admin.category.getDelete',$item['id']) !!}"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.category.getEdit',$item['id']) !!}">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection()

