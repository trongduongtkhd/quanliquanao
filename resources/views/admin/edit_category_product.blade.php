  @extends('admin_layout')
  @section('admin_content')

  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                  Cập nhật danh mục sản phẩm
              </header>
              <div class="panel-body">

                  @foreach($edit_category_product as $key => $edit_value)
                  <div class="position-center">
                      <form role="form" action="{{URL::to('/update-category-product'.$edit_value-> category_id)}}"
                          method="post">
                          @csrf
                          <div class="form-group">
                              <label for="exampleInputEmail1">Tên danh mục </label>
                              <input type="text" value="{{$edit_value ->category_name}}" name="category_product_name"
                                  class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục sản phẩm">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Mô tả danh mục</label>
                              <textarea style=" resize:none " rows="5" class="form-control" name="category_product_desc"
                                  id="exampleInputPassword1">{{$edit_value ->category_desc}} </textarea>
                          </div>


                          <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh mục
                          </button>
                      </form>
                  </div>
                  @endforeach
              </div>
          </section>

      </div>
      @endsection