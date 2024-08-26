@extends('layouts.client')
@section('content')

    <!-- banner -->
    <div class="bg-cover bg-no-repeat bg-center py-36" style="background-image: url('images/banner-bg.jpg');">
        <div class="container">
            <h1 class="text-6xl text-gray-800 font-medium mb-4 capitalize">
                Hàng Nội Địa Nhật<br> Uy Tín Chất Lượng
            </h1>
            <p>Chúng tôi đã có uy tín nhiều năm trong ngành hàng Mỹ phẩm, Thực phảm chức năng, Đồ ăn nội địa Nhật
                Bản<br>
                Luôn cam kết về chất lượng, chúng tôi tự hào là đại lý hàng đầu cung cấp các mặt hàng nội địa Nhật
                Bản.<br>
                Uy tín, chất lượng là tiêu chí hàng đầu của chúng tôi.</p>
            <div class="mt-12">
                <a href="#" class="bg-primary border border-primary text-white px-8 py-3 font-medium
                    rounded-md hover:bg-transparent hover:text-primary">Mua Ngay</a>
            </div>
        </div>
    </div>
    <!-- ./banner -->

    <!-- features -->
    <div class="container py-16">
        <div class="w-10/12 grid grid-cols-1 md:grid-cols-3 gap-6 mx-auto justify-center">
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="/assets/images/icons/delivery-van.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Free Phí Ship</h4>
                    <p class="text-gray-500 text-sm">Hóa đơn trên 2tr</p>
                </div>
            </div>
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="/assets/images/icons/office.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Chât Lượng Hàng Đầu</h4>
                    <p class="text-gray-500 text-sm">Chất lượng luôn được đảm bảo</p>
                </div>
            </div>
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="/assets/images/icons/service-hours.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Tư Vấn 24/7</h4>
                    <p class="text-gray-500 text-sm">Tận Tình Tư Vấn</p>
                </div>
            </div>
        </div>
    </div>
    <!-- ./features -->

    <!-- categories -->
    <div class="container py-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Mua Theo Các Mục</h2>
        <div class="grid grid-cols-3 gap-3">
            @foreach($categories as $category)
                <div class="relative rounded-sm overflow-hidden group">
                    <img src="/assets/images/category/{{$category->slug}}.jpg" alt="{{$category->name}}" class="w-full">
                    <a href="/category/{{$category->slug}}"
                       class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">{{$category->name}}</a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ./categories -->

    <!-- new arrival -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Sản phẩm mới</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white shadow rounded overflow-hidden group">
                    <div class="relative">
                        <img src="{{$product->images[0]['url'] ?? '/assets/images/products/no-image.jpg'}}"
                             alt="{{$product->name}}" class="w-full">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center
                    justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="/product/{{$product->slug}}"
                               class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                               title="view product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </div>
                    </div>
                    <div class="pt-4 pb-3 px-4">
                        <a href="#">
                            <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
                                {{$product->name}}
                            </h4>
                        </a>
                        <div class="flex items-baseline mb-1 space-x-2">
                            <a target="_blank" href="https://www.facebook.com/profile.php?id=61550643794060"><p
                                    class="text-xl text-primary font-semibold">Giá: Liên hệ với chúng tôi để biết giá của sản phẩm.</p>
                            </a>
                        </div>
                        <div class="flex items-center">
                            <div class="flex gap-1 text-sm text-yellow-400">
                            </div>
                        </div>
                        <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                           class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition"> Liên hệ để mua.</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ./new arrival -->

    <!-- ads -->
    <div class="container pb-16">
        <a href="#">
            <img src="/assets/images/offer.jpg" alt="ads" class="w-full">
        </a>
    </div>
    <!-- ./ads -->

    <!-- product -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Sản phẩm đề xuất</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($products as $product)
                @if($product->is_recommend == 1)
                    <div class="bg-white shadow rounded overflow-hidden group">
                        <div class="relative">
                            <img src="{{$product->images[0]['url'] ?? '/assets/images/products/no-image.jpg'}}"
                                 alt="{{$product->name}}" class="w-full">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center
                    justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                <a href="/product/{{$product->slug}}"
                                   class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                                   title="view product">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </div>
                        </div>
                        <div class="pt-4 pb-3 px-4">
                            <a href="#">
                                <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
                                {{$product->name}}
                                </h4>
                            </a>
                            <div class="flex items-baseline mb-1 space-x-2">
                                <a target="_blank" href="https://www.facebook.com/profile.php?id=61550643794060"><p
                                        class="text-xl text-primary font-semibold">Giá: Liên hệ với chúng tôi để biết giá của sản phẩm.</p>
                                </a>
                            </div>
                        </div>
                        <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                           class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition"> Liên hệ để mua.</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <!-- ./product -->
@endsection
