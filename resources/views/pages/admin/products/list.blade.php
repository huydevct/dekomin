@extends('coreui::layouts.master')
@section('content')
    @php
        $filter = [
            'device_id' =>(int) \Illuminate\Support\Facades\Request::get('device_id',null),
            'product_id' =>(int) \Illuminate\Support\Facades\Request::get('product_id',null),
            'parent_id' =>(int) \Illuminate\Support\Facades\Request::get('parent_id',null),
            'name' => \Illuminate\Support\Facades\Request::get('name',null),
            'sku' => \Illuminate\Support\Facades\Request::get('sku',null),
            'is_hot' =>(int) \Illuminate\Support\Facades\Request::get('is_hot',null),
            'active' => \Illuminate\Support\Facades\Request::get('active'),
            'is_sale' => \Illuminate\Support\Facades\Request::get('is_sale'),
            'popular' => \Illuminate\Support\Facades\Request::get('popular'),
            'order_sort' => \Illuminate\Support\Facades\Request::get('order_sort', null),
            'price_sort' => \Illuminate\Support\Facades\Request::get('price_sort', null),
            'rating_sort' => \Illuminate\Support\Facades\Request::get('rating_sort', null),
            'quantity_sold_sort' => \Illuminate\Support\Facades\Request::get('quantity_sold_sort', null),
            'stock_sort' => \Illuminate\Support\Facades\Request::get('stock_sort', null),
            'order' =>  \Illuminate\Support\Facades\Request::get('order',''),
            'flavour' =>  \Illuminate\Support\Facades\Request::get('flavour',''),
            'brand' =>  \Illuminate\Support\Facades\Request::get('brand',''),
    ];
    @endphp
    <div class="body flex-grow-1 px-3">
        <div class="container-fluid">
            <div class="car"></div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <strong>Products</strong><span class="small ms-1">List</span>
                        <a href="{!! route('admin.products.create') !!}" class="btn btn-sm btn-success">
                            Create
                        </a>
                    </div>
                    {{--                    <form action="{!! route('admin.products.list') !!}" method="GET" class="d-flex gap-2">--}}
                    {{--                        <select name="order" class="form-select" style="min-width: 200px">--}}
                    {{--                            <option {!! $filter['order']==''?'selected':'' !!} value="">Order</option>--}}
                    {{--                            <option {!! $filter['order']=='asc'?'selected':'' !!} value="asc">Asc</option>--}}
                    {{--                            <option {!! $filter['order']=='desc'?'selected':'' !!} value="desc">Desc</option>--}}
                    {{--                        </select>--}}
                    {{--                        <button type="submit" class="btn btn-sm btn-primary">Search</button>--}}
                    {{--                    </form>--}}
                    <form action="{!! route('admin.products.list') !!}" method="get"
                          class="row" style="row-gap: 15px">

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{$filter['name'] != 0 ? $filter['name'] : ""}}"
                                   placeholder="Name Product">
                        </div>

{{--                        <div class="col-sm-4">--}}
{{--                            <input type="number" class="form-control" name="product_id"--}}
{{--                                   value="{{$filter['product_id'] != 0 ? $filter['product_id'] : ""}}"--}}
{{--                                   placeholder="Product ID">--}}
{{--                        </div>--}}

{{--                        <div class="col-sm-4">--}}
{{--                            <input type="number" class="form-control" name="parent_id"--}}
{{--                                   value="{{$filter['parent_id'] != 0 ? $filter['parent_id'] : ""}}"--}}
{{--                                   placeholder="Parent ID">--}}
{{--                        </div>--}}

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name"
                                   value="{{$filter['name'] != "" ? $filter['name'] : ""}}"
                                   placeholder="Name">
                        </div>

{{--                        <div class="col-sm-4">--}}
{{--                            <input type="text" class="form-control" name="flavour"--}}
{{--                                   value="{{$filter['flavour'] != "" ? $filter['flavour'] : ""}}"--}}
{{--                                   placeholder="Flavour">--}}
{{--                        </div>--}}

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="brand"
                                   value="{{$filter['brand'] != "" ? $filter['brand'] : ""}}"
                                   placeholder="Brand">
                        </div>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="sku"
                                   value="{{$filter['sku'] != "" ? $filter['sku'] : ""}}"
                                   placeholder="SKU">
                        </div>

                        <div class="col-sm-4">
                            <select class="categories form-select" name="category_id"
                                    style="width: 100%;">
                                <option value="" selected>Chọn 1 Category</option>
                                @foreach ($categories as $cate)
                                    <option
                                        value="{{ $cate->id }}" {{ request('category_id') == $cate->id ? 'selected' : ''}}>{{ $cate->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--                        <div class="col-sm-4">--}}
                        {{--                            <select name="is_hot" class="form-select" aria-label="Default select example"--}}
                        {{--                                    onsubmit="sortHot(this.value)">--}}
                        {{--                                <option value="" selected="">Is Hot</option>--}}
                        {{--                                <option value="1" {!! $filter['is_hot']=='1'?'selected':'' !!}>Yes</option>--}}
                        {{--                                <option value="2" {!! $filter['is_hot']=='2'?'selected':'' !!}>No</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}

                        <div class="col-sm-4">
                            <select name="order_sort" class="form-select" aria-label="Default select example"
                                    onsubmit="sortOrder(this.value)">
                                <option value="" selected="">Order Sort</option>
                                <option value="asc" {!! $filter['order_sort']=='asc'?'selected':'' !!}>ASC</option>
                                <option value="desc" {!! $filter['order_sort']=='desc'?'selected':'' !!}>DESC</option>
                            </select>
                        </div>

{{--                        <div class="col-sm-4">--}}
{{--                            <select name="price_sort" class="form-select" aria-label="Default select example"--}}
{{--                                    onsubmit="sortPrice(this.value)">--}}
{{--                                <option value="" selected="">Price Sort</option>--}}
{{--                                <option value="asc" {!! $filter['price_sort']=='asc'?'selected':'' !!}>ASC</option>--}}
{{--                                <option value="desc" {!! $filter['price_sort']=='desc'?'selected':'' !!}>DESC</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="col-sm-4">--}}
{{--                            <select name="stock_sort" class="form-select" aria-label="Default select example"--}}
{{--                                    onsubmit="sortStock(this.value)">--}}
{{--                                <option value="" selected="">Stock Sort</option>--}}
{{--                                <option value="asc" {!! $filter['stock_sort']=='asc'?'selected':'' !!}>ASC</option>--}}
{{--                                <option value="desc" {!! $filter['stock_sort']=='desc'?'selected':'' !!}>DESC--}}
{{--                                </option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        {{--                        <div class="col-sm-4">--}}
                        {{--                            <select name="quantity_sold_sort" class="form-select" aria-label="Default select example"--}}
                        {{--                                    onsubmit="sortQuantitySold(this.value)">--}}
                        {{--                                <option value="" selected="">Quantity Sold Sort</option>--}}
                        {{--                                <option value="asc" {!! $filter['quantity_sold_sort']=='asc'?'selected':'' !!}>ASC--}}
                        {{--                                </option>--}}
                        {{--                                <option value="desc" {!! $filter['quantity_sold_sort']=='desc'?'selected':'' !!}>DESC--}}
                        {{--                                </option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}


                        {{--                        <div class="col-sm-4">--}}
                        {{--                            <select name="rating_sort" class="form-select" aria-label="Default select example"--}}
                        {{--                                    onsubmit="sortRating(this.value)">--}}
                        {{--                                <option value="" selected="">Rating Sort</option>--}}
                        {{--                                <option value="asc" {!! $filter['rating_sort']=='asc'?'selected':'' !!}>ASC</option>--}}
                        {{--                                <option value="desc" {!! $filter['rating_sort']=='desc'?'selected':'' !!}>DESC</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}

                        <div class="col col-sm-4">
                            <select name="active" class="form-select" aria-label="Default select example">
                                <option value="" selected>Chọn Active</option>
                                <option value="1" {!! $filter['active']==1?'selected':'' !!}>Active</option>
                                <option value="0" {!! $filter['active']==='0'?'selected':'' !!}>InActive</option>
                                <option value="2" {!! $filter['active']==2?'selected':'' !!}>Không xác định</option>
                            </select>
                        </div>
{{--                        <div class="col col-sm-4">--}}
{{--                            <select name="popular" class="form-select" aria-label="Default select example">--}}
{{--                                <option value="" selected>Chọn Popular</option>--}}
{{--                                <option value="1" {!! $filter['popular']==1?'selected':'' !!}>Yes</option>--}}
{{--                                <option value="0" {!! $filter['popular']==='0'?'selected':'' !!}>No</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col col-sm-4">--}}
{{--                            <select name="is_sale" class="form-select" aria-label="Default select example">--}}
{{--                                <option value="" selected>Chọn Sale</option>--}}
{{--                                <option value="1" {!! $filter['is_sale']==1?'selected':'' !!}>Yes</option>--}}
{{--                                <option value="0" {!! $filter['is_sale']==='0'?'selected':'' !!}>No</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="col-sm-12 d-flex justify-content-center gap-2">
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-secondary" onclick="clearParams()">Clear</button>
                            </div>
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="card-body">
                    @if($products->count()==0)
                        Not available product
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">SKU</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Subject of use</th>
                                <th scope="col">Rate</th>
{{--                                <th scope="col">Parent ID</th>--}}
                                <th scope="col">Active</th>
                                <th scope="col">Recommend</th>
{{--                                <th scope="col">Sale</th>--}}
{{--                                <th scope="col">Weight</th>--}}
{{--                                <th scope="col">Weight Unit</th>--}}
                                <th scope="col">Brand</th>
{{--                                <th scope="col">Flavour</th>--}}
{{--                                <th scope="col">Dimension</th>--}}
{{--                                <th scope="col">Tax</th>--}}
                                <th scope="col">Order</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <th scope="row"><a
                                            href="/admin/products?parent_id={!! $product->id !!}">{!! $product->id !!}</a>
                                    </th>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->sku}}</td>
                                    <td>
                                        @if(!empty($product->images))
                                            @foreach($product->images as $image)
                                                <img src="{{ $image['url']['full'] }}"
                                                     style="max-width: 150px; max-height: 150px">
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($product->categories as $category)
                                            <label class="badge badge-sm bg-success">
                                                {{$category->name}}
                                            </label><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($product->subject_of_use==1)
                                            <label class="badge badge-sm bg-success">
                                                Người già
                                            </label>
                                        @elseif($product->subject_of_use == 2)
                                            <label class="badge badge-sm bg-primary">
                                                Trẻ em
                                            </label>
                                        @elseif($product->subject_of_use == 3)
                                            <label class="badge badge-sm bg-primary">
                                                Người lớn
                                            </label>
                                        @endif
                                    </td>
                                    <td>{{$product->rate}}</td>
{{--                                    <td>{{$product->price}}</td>--}}
{{--                                    <td>--}}
{{--                                        <a href="/admin/products?product_id={{$product->parent_id}}">{{$product->parent_id ?? 0}}</a>--}}
{{--                                    </td>--}}
                                    <td>
                                        @if($product->active==1)
                                            <label class="badge badge-sm bg-success">
                                                Active
                                            </label>
                                        @else
                                            <label class="badge badge-sm bg-danger">
                                                Hide
                                            </label>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_recommend==1)
                                            <label class="badge badge-sm bg-success">
                                                Yes
                                            </label>
                                        @else
                                            <label class="badge badge-sm bg-danger">
                                                No
                                            </label>
                                        @endif
                                    </td>
{{--                                    <td>--}}
{{--                                        @if($product->is_sale==1)--}}
{{--                                            <label class="badge badge-sm bg-success">--}}
{{--                                                Yes--}}
{{--                                            </label>--}}
{{--                                        @else--}}
{{--                                            <label class="badge badge-sm bg-danger">--}}
{{--                                                No--}}
{{--                                            </label>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>{{$product->weight}}</td>--}}
{{--                                    <td>{{$product->weight_unit}}</td>--}}
                                    <td>{{$product->brand}}</td>
{{--                                    <td>{{$product->flavour}}</td>--}}
{{--                                    <td>--}}
{{--                                        @if(!empty($product->length) || !empty($product->width) || !empty($product->height))--}}
{{--                                            <button type="button" class="btn btn-primary" data-coreui-toggle="modal"--}}
{{--                                                    data-coreui-target="#dimension_{{ $product->id }}">--}}
{{--                                                Show--}}
{{--                                            </button>--}}

{{--                                            <!-- Modal -->--}}
{{--                                            <div class="modal fade" id="dimension_{{ $product->id }}" tabindex="-1"--}}
{{--                                                 aria-labelledby="dimension_{{ $product->id }}" aria-hidden="true">--}}
{{--                                                <div class="modal-dialog">--}}
{{--                                                    <div class="modal-content">--}}
{{--                                                        <div class="modal-header">--}}
{{--                                                            <h5 class="modal-title" id="dimension_{{ $product->id }}">--}}
{{--                                                                Shipping Address of--}}
{{--                                                                ID: {{ $product->id }}</h5>--}}
{{--                                                            <button type="button" class="btn-close"--}}
{{--                                                                    data-coreui-dismiss="modal"--}}
{{--                                                                    aria-label="Close"></button>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="modal-body">--}}
{{--                                                            @if(!empty($product->length))--}}
{{--                                                                Length: {{$product->length}}<br>--}}
{{--                                                            @endif--}}
{{--                                                            @if(!empty($product->width))--}}
{{--                                                                Width: {{$product->width}}<br>--}}
{{--                                                            @endif--}}
{{--                                                            @if(!empty($product->height))--}}
{{--                                                                Height: {{$product->height}}<br>--}}
{{--                                                            @endif--}}

{{--                                                            @if(!empty($product->box_height))--}}
{{--                                                                Box Height: {{$product->box_height}}<br>--}}
{{--                                                            @endif--}}
{{--                                                            @if(!empty($product->box_length))--}}
{{--                                                                Box Length: {{$product->box_length}}<br>--}}
{{--                                                            @endif--}}
{{--                                                            @if(!empty($product->box_width))--}}
{{--                                                                Box Width: {{$product->box_width}}<br>--}}
{{--                                                            @endif--}}
{{--                                                            @if(!empty($product->box_count))--}}
{{--                                                                Box Count: {{$product->box_width}}<br>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                        <div class="modal-footer">--}}
{{--                                                            <button type="button" class="btn btn-secondary"--}}
{{--                                                                    data-coreui-dismiss="modal">Close--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @else--}}
{{--                                            No Dimension--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        @if(!empty($product->tax_pst) || !empty($product->tax_gst))--}}
{{--                                            <button type="button" class="btn btn-primary" data-coreui-toggle="modal"--}}
{{--                                                    data-coreui-target="#tax_{{ $product->id }}">--}}
{{--                                                Show--}}
{{--                                            </button>--}}

{{--                                            <!-- Modal -->--}}
{{--                                            <div class="modal fade" id="tax_{{ $product->id }}" tabindex="-1"--}}
{{--                                                 aria-labelledby="tax_{{ $product->id }}" aria-hidden="true">--}}
{{--                                                <div class="modal-dialog">--}}
{{--                                                    <div class="modal-content">--}}
{{--                                                        <div class="modal-header">--}}
{{--                                                            <h5 class="modal-title" id="tax_{{ $product->id }}">--}}
{{--                                                                Shipping Address of--}}
{{--                                                                ID: {{ $product->id }}</h5>--}}
{{--                                                            <button type="button" class="btn-close"--}}
{{--                                                                    data-coreui-dismiss="modal"--}}
{{--                                                                    aria-label="Close"></button>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="modal-body">--}}
{{--                                                            @if(!empty($product->tax_gst))--}}
{{--                                                                GST: {{$product->tax_gst}}<br>--}}
{{--                                                            @endif--}}
{{--                                                            @if(!empty($product->tax_pst))--}}
{{--                                                                PST: {{$product->tax_pst}}<br>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                        <div class="modal-footer">--}}
{{--                                                            <button type="button" class="btn btn-secondary"--}}
{{--                                                                    data-coreui-dismiss="modal">Close--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @else--}}
{{--                                            No Tax--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                    <td>
                                        {{$product->order}}
                                    </td>
                                    <td>
                                        <a href="{!! route('admin.products.edit',['id'=>$product->id, 'params' => base64_encode(json_encode(\Illuminate\Support\Facades\Request::all()))]) !!}"
                                           class="btn btn-sm btn-primary mb-1">
                                            Edit
                                        </a>
                                        <button onclick="confirmDelete({!! $product->id !!})"
                                                class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="card-footer">
                    {!! $products->links('vendor.pagination.simple-bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
    @push('scripts')

        <script>
            function clearParams() {
                window.location.href = '<?php echo e(route('admin.products.list')); ?>'
            }

            function sortOrder(sort) {
                window.location.href = removeParam("order_sort")
                insertParam("order_sort", sort)
            }

            function sortPrice(sort) {
                window.location.href = removeParam("price_sort")
                insertParam("price_sort", sort)
            }

            function sortStock(sort) {
                window.location.href = removeParam("stock_sort")
                insertParam("stock_sort", sort)
            }

            function removeParam(parameter) {
                var url = document.location.href;
                var urlparts = url.split('?');

                if (urlparts.length >= 2) {
                    var urlBase = urlparts.shift();
                    var queryString = urlparts.join("?");

                    var prefix = encodeURIComponent(parameter) + '=';
                    var pars = queryString.split(/[&;]/g);
                    for (var i = pars.length; i-- > 0;)
                        if (pars[i].lastIndexOf(prefix, 0) !== -1)
                            pars.splice(i, 1);
                    url = urlBase + '?' + pars.join('&');
                    window.history.pushState('', document.title, url); // added this line to push the new url directly to url bar .

                }
                return url;
            }

            function insertParam(key, value) {
                key = encodeURIComponent(key);
                value = encodeURIComponent(value);

                // kvp looks like ['key1=value1', 'key2=value2', ...]
                var kvp = document.location.search.substr(1).split('&');
                let i = 0;

                for (; i < kvp.length; i++) {
                    if (kvp[i].startsWith(key + '=')) {
                        let pair = kvp[i].split('=');
                        pair[1] = value;
                        kvp[i] = pair.join('=');
                        break;
                    }
                }

                if (i >= kvp.length) {
                    kvp[kvp.length] = [key, value].join('=');
                }

                // can return this or...
                let params = kvp.join('&');

                // reload page with new params
                document.location.search = params;
            }

            function confirmDelete(id) {
                if (confirm("Bạn có chắc muốn xóa product này?")) {
                    fetch("/admin/products/delete/" + id, {
                        method: "DELETE", // *GET, POST, PUT, DELETE, etc.
                        // mode: "cors", // no-cors, *cors, same-origin
                        // cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
                        // credentials: "same-origin", // include, *same-origin, omit
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            // 'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        // redirect: "follow", // manual, *follow, error
                        // referrerPolicy: "no-referrer",
                        body: JSON.stringify({
                            _token: "{!! csrf_token() !!}"
                        })
                    }).then(function (response) {
                        console.error(response);
                        if (response.status !== 200) {
                            throw "";
                        }
                        FuiToast.success('Xóa thành công!')
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000)
                    }).catch(function (e) {
                        console.error(e);
                        FuiToast.error('Xóa không thành công!')
                    })
                    // window.location.href = "/admin/dailies/delete/id";
                }
            }

            @if( Session::has('errors'))
            FuiToast.error('{!! Session::get('errors') !!}')
            @endif
        </script>
    @endpush
@endsection
