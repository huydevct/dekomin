@extends("coreui::layouts.master")
@section('content')
    <div id="create"></div>
@endsection
@push('scripts')
    <script src="{{asset('/tinymce/tinymce.min.js')}}"></script>
    <script>
        window.$VueData = {
            csrf_token: "{{csrf_token()}}",
            categories: {!! json_encode($categories->toArray()) !!},
            errors: {!! json_encode($errors->getMessages()) !!},
            page: {!! $page ?? 0!!},
            product: {!! !empty($product)?json_encode($product->toArray()):"null" !!},
            params: {!! !empty($params) ? base64_decode($params) : "null" !!},
        };
        console.log('window.$VueData')
    </script>
    @vite('resources/js/vuejs/widgets/product_create_update.js')
@endpush
