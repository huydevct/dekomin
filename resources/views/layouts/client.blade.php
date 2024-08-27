<!DOCTYPE html>
<html lang="en">
@php
    $categories = \App\Models\Category::where('active', 1)->orderBy('id')->get();
@endphp

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dekomin - Hàng Nhật nội địa chính hãng, uy tín</title>

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PW4K4WD8');</script>
    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XP6B8Y71PD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-XP6B8Y71PD');
    </script>

    <link rel="shortcut icon" href="/assets/images/logo_only.jpg" type="image/x-icon">

    {{--    <link rel="stylesheet" href="../../css/main.css">--}}
    {{--    <link rel="stylesheet" href="../../css/app.css">--}}
    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    {{--    <link rel="stylesheet" href="../../../node_modules/@fortawesome/fontawesome-free/css/all.min.css">--}}
    @vite('node_modules/@fortawesome/fontawesome-free/css/all.min.css')
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PW4K4WD8"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- header -->
<header class="py-4 shadow-sm bg-white">
    <div class="container flex items-center justify-between">
        <a href="/">
            <img src="/assets/images/logo.jpg" alt="Dekomin" class="w-32">
        </a>

        <div class="w-full max-w-xl relative flex">
                <span class="absolute left-4 top-3 text-lg text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
            <input type="text" name="search" id="search"
                   class="w-full border border-primary border-r-0 pl-12 py-3 pr-3 rounded-l-md focus:outline-none hidden md:flex"
                   placeholder="search">
            <div id="dropdown-search-product"
                 class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
                 style="position: absolute;top: 100%;width: 100%;">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" id="search-ul"
                    aria-labelledby="dropdown-button-2">
                </ul>
            </div>
            <button type="submit" onclick="search()"
                    class="bg-primary items-center border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition hidden md:flex">
                Search
            </button>
        </div>
    </div>
</header>
<!-- ./header -->

<!-- navbar -->
<nav class="bg-gray-800">
    <div class="container flex">
        <div class="px-8 py-4 bg-primary md:flex items-center cursor-pointer relative group hidden">
            <span class="text-white">
                <i class="fa-solid fa-bars"></i>
            </span>
            <span class="capitalize ml-2 text-white">Tất cả Mục</span>

            <!-- dropdown -->
            <div
                class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                @foreach($categories as $category)
                    <a href="/category/{{$category->slug}}"
                       class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="/assets/images/icons/{{$category->slug}}.svg" alt="sofa"
                             class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">{{$category->name}}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="flex items-center justify-between flex-grow md:pl-12 py-5">
            <div class="flex items-center space-x-6 capitalize">
                <a href="/" class="text-gray-200 hover:text-white transition">Home</a>
                <a href="/shop" class="text-gray-200 hover:text-white transition">Shop</a>
                @foreach($categories as $category)
                    <a href="/category/{{$category->slug}}"
                       class="text-gray-200 hover:text-white transition">{{$category->name}}</a>
                @endforeach
                <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                   class="text-gray-200 hover:text-white transition">Về chúng tôi</a>
                <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                   class="text-gray-200 hover:text-white transition">Liên hệ</a>
            </div>
        </div>
    </div>
</nav>
<!-- ./navbar -->

@yield('content')

<!-- footer -->
<footer class="bg-white pt-16 pb-12 border-t border-gray-100">
    <div class="container grid grid-cols-1 ">
        <div class="col-span-1 space-y-4">
            <img src="/assets/images/logo_only.jpg" alt="logo" class="w-12">
            <div class="mr-2">
                <p class="text-gray-500">
                    Dekomin - Hàng Nhật nội địa chính hãng, uy tín, chất lượng
                </p>
            </div>
            <div class="flex space-x-5">
                <a href="https://www.facebook.com/profile.php?id=61550643794060"
                   class="text-gray-400 hover:text-gray-500"><i
                        class="fa-brands fa-facebook-square"></i></a>
                <a href="https://www.facebook.com/profile.php?id=61550643794060"
                   class="text-gray-400 hover:text-gray-500"><i
                        class="fa-brands fa-instagram-square"></i></a>
                {{--                <a href="#" class="text-gray-400 hover:text-gray-500"><i--}}
                {{--                        class="fa-brands fa-twitter-square"></i></a>--}}
                {{--                <a href="#" class="text-gray-400 hover:text-gray-500">--}}
                {{--                    <i class="fa-brands fa-github-square"></i>--}}
                </a>
            </div>
        </div>

        <div class="col-span-2 grid grid-cols-2 gap-4">
            <div class="grid grid-cols-2 gap-4 md:gap-8">
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Về chúng tôi</h3>
                    <div class="mt-4 space-y-4">
                        <a href="https://www.facebook.com/profile.php?id=61550643794060" target="_blank"
                           class="text-base text-gray-500 hover:text-gray-900 block">Hệ thống cửa hàn</a>
                        <a href="/" class="text-base text-gray-500 hover:text-gray-900 block">Sản phẩm</a>
                        <a href="/" class="text-base text-gray-500 hover:text-gray-900 block">Commerce</a>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-12">


                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Support</h3>
                    <div class="mt-4 space-y-4">
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Pricing</a>
                        <!-- <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Documentation</a> -->
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Guides</a>
                        <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">API Status</a>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Hỗ trợ</h3>
                    <div class="mt-4 space-y-4">
                        <a href="https://www.facebook.com/profile.php?id=61550643794060"
                           class="text-base text-gray-500 hover:text-gray-900 block">Liên hệ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ./footer -->

<!-- copyright -->
<div class="bg-gray-800 py-4">
    <div class="container flex items-center justify-between">
        <p class="text-white">&copy; Dekomin - All Right Reserved</p>
        <div>
            <img src="/assets/images/methods.png" alt="methods" class="h-5">
        </div>
    </div>
</div>
<!-- ./copyright -->
</body>

<script>
    function search(e) {
        const value = document.getElementById('search').value;

        fetch('http://localhost:8000/product/search/' + value, {
            method: 'GET', // Hoặc 'GET' nếu cần
            headers: {
                'Content-Type': 'application/json'
            },
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data.data);
                const ulSearch = document.getElementById('search-ul');
                ulSearch.innerHTML = "";
                const response = data.data;

                if(response.length === 0){
                    const html = document.createElement('li');
                    html.innerHTML = `
                        <a type="button" href="{{request()->path()}}"
                                class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">
                            <div class="inline-flex items-center">
                                Không có sản phẩm thỏa mãn.
                            </div>
                        </a>
                    `
                    ulSearch.appendChild(html);

                    const divSearch = document.getElementById('dropdown-search-product');
                    divSearch.classList.remove('hidden')
                }
                response.forEach((element) => {
                    const html = document.createElement('li');
                    html.innerHTML = `
                        <a type="button" href="/product/${element.slug}"
                                class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">
                            <div class="inline-flex items-center">
                                <img src="${element.images && element.images.length > 0 ? element.images[0]?.url : "/assets/images/products/no-image.jpg"}" class="w-10 h-10 px-3">
                                ${element.name}
                            </div>
                        </a>
                    `
                    ulSearch.appendChild(html);

                    const divSearch = document.getElementById('dropdown-search-product');
                    divSearch.classList.remove('hidden')
                })
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

</html>
