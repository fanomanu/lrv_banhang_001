@extends('admin.master')
@section('page-header')
    Product
    <small>List</small>
@endsection
@section('content')
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Date</th>
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
                <td>{!! number_format($item['price'],0,",",".") !!} VND</td>
                <td>
                    {!!
                         \Carbon\Carbon::createFromTimeStamp(strtotime($item['created_at']))->diffForHumans();
                    !!}
                </td>
                <td>
                    <?php
                        $cate = DB::table('categories')->where('id',$item['category_id'])->first();
                        echo $cate->name;
                    ?>
                </td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{!! route('admin.product.getDelete',$item['id']) !!}" onclick="return xacnhanxoa('Bạn có chắc muốn xóa sản phảm này.');"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.product.getEdit',$item['id']) !!}">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection