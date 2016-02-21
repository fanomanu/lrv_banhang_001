<div id="categorymenu">
  <nav class="subnav">
    <ul class="nav-pills categorymenu">
      <li><a href="{!! url('/') !!}">Trang chủ</a>
      <?php 
        $cate_level_1 = DB::table('categories')->where('parent_id',0)->get();
      ?>
      @foreach ($cate_level_1 as $cate_level_1_item)
         <li><a href="">{!! $cate_level_1_item->name !!}</a>
        <div>
          <ul>
            <?php 
              $cate_level_2 = DB::table('categories')->where('parent_id',$cate_level_1_item->id)->get();
            ?>
            @foreach($cate_level_2 as $cate_level_2_item)
            <li><a href="{!! URL('loai-san-pham',[$cate_level_2_item->id,$cate_level_2_item->alias]) !!}">{!! $cate_level_2_item->name !!}</a></li>
            @endforeach
          </ul>
        </div>
      </li>
      @endforeach
      <li><a href="product.html">Products</a>
        <div>
          <ul>
            <li><a href="product.html">Product style 1</a>
            </li>
            <li><a href="product2.html">Product style 2</a>
            </li>
            <li><a href="#"> Women's Accessories</a>
            </li>
            <li><a href="#">Men's Accessories <span class="label label-success">Sale</span>
              </a>
            </li>
            <li><a href="#">Dresses </a>
            </li>
            <li><a href="#">Shoes <span class="label label-warning">(25)</span>
              </a>
            </li>
            <li><a href="#">Bags <span class="label label-info">(new)</span>
              </a>
            </li>
            <li><a href="#">Sunglasses </a>
            </li>
          </ul>
          <ul>
            <li><img style="display:block" src="img/proudctbanner.jpg" alt="" title="" >
            </li>
          </ul>
        </div>
      </li>
      <li><a href="{!!  url('/lien-he') !!}">Liên hệ</a>
      </li>         
    </ul>
  </nav>
</div>