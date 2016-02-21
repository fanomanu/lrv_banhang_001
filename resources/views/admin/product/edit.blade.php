@extends('admin.master')
@section('page-header')
    Product
    <small>Add</small>
@endsection
@section('content')
    <style type="text/css">
        .img_current{
            width: 200px;
        }
        .img_detail{
            width: 200px;
            margin-bottom: 20px;
        }
        .icon-del{
            position: relative;
            top: -55px;
            left: -20px;
        }
        #insert{
            margin-top: 20px;
        }
    </style>
    <form action="{!! route('admin.product.getEdit',$product['id']) !!}" method="POST" name="frmEditProduct" enctype="multipart/form-data">
        <div class="col-lg-7" style="padding-bottom:120px">
            <input type="hidden" name="_token" value="{!!  csrf_token() !!}" />
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="slParent">
                    <option value="">Please Choose Category</option>
                    <?php cate_parent($cate,0,'--',$product['category_id']); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="txtName" placeholder="Please Enter Username" value="{!! old('txtName', isset($product)?$product['name']:null) !!}" />
            </div>
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" name="txtPrice" placeholder="Please Enter Password" value="{!! old('txtPrice', isset($product)?$product['price']:null) !!}" />
            </div>
            <div class="form-group">
                <label>Intro</label>
                <textarea class="form-control" rows="3" name="txtIntro">{!! old('txtIntro', isset($product)?$product['intro']:null) !!}</textarea>
                <script type="text/javascript">ckeditor('txtIntro')</script>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent', isset($product)?$product['content']:null) !!}</textarea>
                <script type="text/javascript">ckeditor('txtContent')</script>
            </div>
            <div class="form-group">
                <label>Current Image</label>
                <img src="{!! asset('resources/upload/'.$product['image']) !!}" class="img_current" />
            </div>
            <div class="form-group">
                <label>Images</label>
                <input type="file" name="fImage">
            </div>
            <div class="form-group">
                <label>Product Keywords</label>
                <input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" value="{!! old('txtKeywords', isset($product)?$product['keywords']:null) !!}" />
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" rows="3" name="txtDescription">{!! old('txtDescription', isset($product)?$product['description']:null) !!}</textarea>
            </div>
            <button type="submit" class="btn btn-default">Product Edit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-4">
            @foreach ($product_image as $key => $item)
                <div class="form_group" id="hinh{!! $item['id'] !!}"> 
                    <img src="{!! asset('resources/upload/detail/'.$item['image']) !!}" class="img_detail" idHinh="hinh{!! $item['id'] !!}" id="{!! $item['id'] !!}" />
                    <a id="del_img_demo" class="btn btn-danger btn-circle icon-del" href="javascript:void(0)" type="button" ><i class="fa fa-time"></i></a>
                    <input type="file" name="fProductDetail[]" />
                </div>
            @endforeach
            <button type="button" class="btn btn-primary" id="addImages">Add Images</button>
            <div id="insert"></div>
        </div>
    </form>
@endsection()