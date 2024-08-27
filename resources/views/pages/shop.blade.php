@extends('layouts.client')
@section('content')
    <!-- breadcrumb -->
    <div class="container py-4 flex items-center gap-3">
        <a href="/" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">{{explode("/", request()->path())[1] ?? request()->path()}}</p>
    </div>
    <!-- ./breadcrumb -->

    <!-- shop wrapper -->
    <div class="container grid md:grid-cols-4 grid-cols-2 gap-6 pt-4 pb-16 items-start">
        <!-- sidebar -->
        <!-- drawer init and toggle -->
        <div class="text-center md:hidden">
            <button
                class="text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block md:hidden"
                type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example"
                aria-controls="drawer-example">
                <ion-icon name="grid-outline"></ion-icon>
            </button>
        </div>

        <!-- drawer component -->
        <div id="drawer-example"
             class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
             tabindex="-1" aria-labelledby="drawer-label">
            <h5 id="drawer-label"
                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                          clip-rule="evenodd"></path>
                </svg>
                Info
            </h5>
            <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
        </div>
        <!-- products -->
        <div class="col-span-4">
            <div class="flex items-center mb-4">

                <div class="flex gap-2 ml-auto">
                </div>
            </div>
            @if(count($products) > 0)

                <div class="grid md:grid-cols-3 grid-cols-2 gap-6">
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
                                    <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"><p
                                            class="text-xl text-primary font-semibold">Giá: Liên hệ chúng tôi để biết về
                                            giá
                                            sản phẩm này.</p></a>
                                </div>
                                <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                                   class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">
                                    Liên hệ để mua.</a>
                            </div>
                        </div>
                </div>

                @endforeach
            @else
                <div class="align-content-center text-center">
                    <p class="mb-2">Không có sản phẩm khả dụng.</p>
                    <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                       class="px-5 w-30 py-1 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition">
                        Liên hệ với
                        chúng tôi để biết thêm chi tiết.
                    </a>
                </div>
        @endif
        <!-- ./products -->
            <!-- ./shop wrapper -->

@endsection
