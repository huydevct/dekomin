@extends('layouts.client')
@section('content')

    <!-- breadcrumb -->
    <div class="container py-4 flex items-center gap-3">
        <a href="../client.blade.php" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">{{explode("/", request()->path())[1] ?? request()->path()}}</p>
    </div>
    <!-- ./breadcrumb -->

    <!-- product-detail -->
    <div class="container grid grid-cols-2 gap-6">
        <div>
            <img id="img-preview"
                 src="{{$product->images[0]['url']['full'] ? $product->images[0]['url']['full'] : '/assets/images/products/no-image.jpg'}}"
                 alt="{{$product->slug . $product->id}}" class="w-full">
            <div class="grid grid-cols-5 gap-4 mt-4">
                @if(!empty($product->images))
                    @foreach($product->images as $image)
                        <img
                            onclick="switchPreview('{{!empty($image['url']['full']) ? $image['url']['full'] : '/assets/images/products/no-image.jpg'}}')"
                            src="{{$image['url']['full'] ? $image['url']['full'] : '/assets/images/products/no-image.jpg'}}"
                            alt="{{$product->slug . $product->id}}"
                            class="w-full cursor-pointer border border-primary">
                    @endforeach
                @else
                    <img src="/assets/images/products/no-image.jpg"
                         alt="{{$product->slug . $product->id}}"
                         class="w-full cursor-pointer border border-primary">
                @endif
            </div>
        </div>

        <div>
            <h2 class="text-3xl font-medium uppercase mb-2">{{$product->name}}</h2>
            <div class="flex items-center mb-4">
            </div>
            <div class="space-y-2">
                <p class="text-gray-800 font-semibold space-x-2">
                    <span>Tình trạng: </span>
                    <span class="text-green-600">Còn Hàng</span>
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Hãng: </span>
                    <span class="text-gray-600">{{$product->brand ?? "Nhật"}}</span>
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Loại: </span>
                    <span class="text-gray-600">{{$product->categories[0]->name}}</span>
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">SKU: </span>
                    <span class="text-gray-600">{{$product->sku}}</span>
                </p>
                <p class="space-x-2">
                    <span class="text-red-700 font-semibold">Đánh giá: </span>
                    <span class="text-red-600">{{$product->rate}}/5</span>
                </p>
                <p class="space-x-2">
                    <span class="text-red-700 font-semibold">Đối tượng sử dụng: </span>
                    <span class="text-gray-600">
                        @if($product->subject_of_use == 1)
                            Người Già
                        @elseif($product->subject_of_use == 2)
                            Trẻ Em
                        @elseif($product->subject_of_use == 3)
                            Người Trưởng Thành
                        @endif
                    </span>
                </p>
            </div>
            <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
                <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"><p
                        class="text-xl text-primary font-semibold">Giá: Liên hệ chúng tôi để biết về giá sản phẩm
                        này.</p></a>
            </div>

            <div class="pt-4">
                <h4>Giới thiệu:</h4>
                <p class="mt-4 text-gray-600">
                    @php
                        echo $product->description
                    @endphp
                </p>
            </div>

            <div class="pt-4">
                <h3 class="text-sm text-gray-800 uppercase mb-1">Cách Dùng:</h3>
                <p class="mt-4 text-gray-600">
                    @php
                        echo $product->uses
                    @endphp
                </p>
            </div>

            <div class="pt-4">
            </div>

            <div class="mt-4">
            </div>

            <div class="mt-6 flex gap-3 border-b border-gray-200 pb-5 pt-5">
                <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                   class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition">
                    <i class="fa-solid fa-bag-shopping"></i> Liên hệ để mua.
                </a>
            </div>

            <div class="flex gap-3 mt-4">
                <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                   class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                   class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- ./product-detail -->

    <!-- description -->
    <div class="container pb-16 pt-3">
        <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-5 p-5 font-medium">Chi Tiết</h3>
        <div class="w-3/5 pt-6">
            <div class="text-gray-600">
                <div class="pt-4">
                    <h4>Giới thiệu:</h4>
                    <p class="mt-4 text-gray-600">
                        @php
                            echo $product->description
                        @endphp
                    </p>
                </div>

                <div class="pt-4">
                    <h3 class="text-sm text-gray-800 uppercase mb-1">Cách Dùng:</h3>
                    <p class="mt-4 text-gray-600">
                        @php
                            echo $product->uses
                        @endphp
                    </p>
                </div>
            </div>

            <table class="table-auto border-collapse w-full text-left text-gray-600 text-sm mt-6">
                <tr>
                    <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Hãng</th>
                    <th class="py-2 px-4 border border-gray-300 "><a href="/shop">{{$product->brand ?? "Nhật"}}</a></th>
                </tr>
                <tr>
                    <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Loại</th>
                    <th class="py-2 px-4 border border-gray-300 "><a
                            href="/category/{{$product->categories[0]->slug}}">{{$product->categories[0]->name}}</a>
                    </th>
                </tr>
            </table>
        </div>
    </div>
    <!-- ./description -->

    <!-- related product -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Sản phẩm liên quan</h2>
        <div class="grid grid-cols-4 gap-6">
            @php
                $products = $products->filter(function ($item) use ($product) {
                        return $item->id != $product->id;
                });
            @endphp
            @if(count($products) > 0)
                @foreach($products as $prod)
                    <div class="bg-white shadow rounded overflow-hidden group">
                        <div class="relative">
                            <img
                                src="{{$prod->images[0]['url']['full'] ?? "/assets/images/products/no-image.jpg"}}"
                                alt="{{$prod->name}}" class="w-full">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center
                    justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                <a href="/product/{{$prod->slug}}"
                                   class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                                   title="view product">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </div>
                        </div>
                        <div class="pt-4 pb-3 px-4">
                            <a href="#">
                                <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
                                    {{$prod->name}}
                                </h4>
                            </a>
                            <div class="flex items-baseline mb-1 space-x-2">
                                <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"><p
                                        class="text-xl text-primary font-semibold">Giá: Liên hệ chúng tôi để biết về giá
                                        sản
                                        phẩm
                                        này.</p></a>
                            </div>
                            <div class="flex items-center">
                            </div>
                        </div>
                        <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                           class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">
                            Liên hệ để mua.</a>
                    </div>
                @endforeach
            @else
                <div class="align-content-center text-center">
                    <p class="mb-2">Không có sản phẩm khả dụng.</p>
                    <a href="/"
                       class="px-5 w-30 py-1 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition">Quay
                        về trang chủ.</a>
                    {{--                    <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"--}}
                    {{--                       class="px-5 w-30 py-1 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition">--}}
                    {{--                        Liên hệ với--}}
                    {{--                        chúng tôi để biết thêm chi tiết.--}}
                    {{--                    </a>--}}
                </div>
            @endif
        </div>
    </div>
    <!-- ./related product -->
@endsection
@push('scripts')
    <script>
        function switchPreview(url) {
            const previewImg = document.getElementById('img-preview')
            previewImg.removeAttribute('src');
            previewImg.setAttribute('src', url)
        }
    </script>
@endpush
