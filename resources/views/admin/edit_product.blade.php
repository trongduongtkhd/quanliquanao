  @extends('admin_layout')
  @section('admin_content')

  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                  Cập nhật sản phẩm
              </header>
              <div class="panel-body">

                  @if(session('product_message'))
                  <span style="color:green;">{{ session('product_message') }}</span>
                  @endif
                  <div class="position-center">
                      @foreach($edit_product as $key => $pro)
                      <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post"
                          enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                              <label for="exampleInputEmail1">Tên sản phẩm </label>
                              <input type="text" name="product_name" class="form-control" id="exampleInputEmail1"
                                  value="{{$pro->product_name}}">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Giá sản phẩm </label>
                              <input type="text" value="{{$pro->product_price}}" name="product_price"
                                  class="form-control" id="exampleInputEmail1">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Hình ảnh sản phẩm </label>
                              <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                              <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" alt="" height="100"
                                  width="100">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Mô tả sản phẩm </label>
                              <textarea style=" resize:none " rows="5" class="form-control" name="product_desc"
                                  id="exampleInputPassword1"> {{$pro->product_desc}}</textarea>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Nội dung sản phẩm </label>
                              <textarea style=" resize:none " rows="5" class="form-control" name="product_content"
                                  id="exampleInputPassword1">{{$pro->product_content}}</textarea>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Danh mục sản phẩm </label>
                              <select name="product_cate" class="form-control input-sm m-bot15">
                                  @foreach($cate_product as $key => $cate)
                                  <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>

                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Thương hiệu </label>
                              <select name="product_brand" class="form-control input-sm m-bot15">
                                  @foreach($brand_product as $key => $brand)
                                  <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Hiển thị </label>
                              <select name="product_status" class="form-control input-sm m-bot15">
                                  <option value="0">Ẩn</option>
                                  <option value="1">Hiển thị</option>

                              </select>
                          </div>

                          <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm </button>
                      </form>
                      @endforeach
                  </div>

              </div>
          </section>

      </div>
      @endsection