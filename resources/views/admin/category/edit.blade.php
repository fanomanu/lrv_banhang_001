@extends('admin.master')
@section('page-header')
    Category
    <small>Edit</small>
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
@include('admin.block.inform')
<form action="{!! route('admin.category.postEdit',$eCate['id']) !!}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
        <div class="form-group">
            <label>Category Parent</label>
           <select class="form-control" name="slParent">
                <option value="0">Please Choose Category</option>
                <?php cate_parent($parent,0,'--',$eCate['parent_id']); ?>
            </select>
        </div>
        <div class="form-group">
            <label>Category Name</label>
            <input class="form-control" name="txtCateName" placeholder="Please Enter Category Name" value="{!! old('txtCateName',isset($eCate)? $eCate['name']: null) !!}"/>
        </div>
        <div class="form-group">
            <label>Category Order</label>
            <input class="form-control" name="txtOrder" placeholder="Please Enter Category Order" value="{!! old('txtOrder',isset($eCate)? $eCate['order']: null) !!}"/>
        </div>
        <div class="form-group">
            <label>Category Keywords</label>
            <input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" value="{!! old('txtKeywords',isset($eCate)? $eCate['keywords']: null) !!}"/>
        </div>
        <div class="form-group">
            <label>Category Description</label>
            <textarea class="form-control" name="txtDescription" rows="3">{!! old('txtDescription',isset($eCate)? $eCate['description']: null) !!}</textarea>
        </div>
        <button type="submit" class="btn btn-default">Category Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection()