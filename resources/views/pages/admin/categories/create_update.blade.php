@extends("coreui::layouts.master")
@section('content')
    @php
        $title_card = "Thêm một category mới";
        $url_action = route("admin.categories.store");
        if(!empty($category)){
             $title_card = "Cập nhật category: {$category->name}";
             $url_action = route("admin.categories.update",['id'=>$category->id]);
        }
    @endphp
    <div class="container-lg">
        <form method="POST"
              action="{!! $url_action !!}"
              enctype="multipart/form-data" class="card  col-md-12">
            <div class="card-header d-flex justify-content-between">
                <div class="flex-column">
                    <strong>{{$title_card}}</strong>
                </div>
            </div>
            <div class="card-body">
                <div class="row col-md-12">
                    @csrf
                    @if(isset($category))
                        @method('put')
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-md-6 pb-2">
                        <label class="form-label" for="sr_name">Title</label>
                        <input minlength="1" maxlength="255" class="form-control" id="sr_name" type="text"
                               name="name"
                               value="{{ !empty($category)?$category->name:old('name') }}">
                    </div>
{{--                    @php--}}
{{--                        $app_ids = [];--}}
{{--                        if(!empty($category)){--}}
{{--                            foreach ($category->apps as $app){--}}
{{--                                $app_ids[] = $app->id;--}}
{{--                            }--}}
{{--                        }--}}
{{--                    @endphp--}}
{{--                    <div class="col-md-6 pb-2">--}}
{{--                        <label class="form-label" for="sr_app">Select App</label>--}}
{{--                        <select name="apps[]" class="chosen-select" style="width: 100%" multiple>--}}
{{--                            @foreach($apps as $app)--}}
{{--                                <option--}}
{{--                                    value="{{ $app->id }}" {{ !empty($category->apps) && in_array($app->id, $app_ids) ? 'selected' : '' }}>{{ $app->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <div class="col-md-6 pb-2">
                        <label class="form-label" for="sr_order">Order</label>
                        <input required minlength="2" maxlength="255" class="form-control" id="sr_order" type="number"
                               name="order"
                               value="{{ !empty($category) ? $category->order:old('order') ?? 0}}">
                    </div>
                    <div class="col-md-6 pb-2">
                        <label class="form-label" for="sr_active"></label>
                        <div class="form-check">
                            <input name="active" class="form-check-input" id="sr_active"
                                   type="checkbox" {!! (!empty($category)&&$category->active==1)||old('active')?'checked':'' !!}>
                            <label class="form-check-label" for="sr_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
        </form>
    </div>
    {{--    <script src="https://code.jquery.com/jquery-3.7.1.js"--}}
    {{--            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>--}}
    {{--    <script type="text/javascript" src="/assets/js/chosen.jquery.min.js">--}}
    {{--    </script>--}}
    {{--    <link href="/assets/css/chosen.min.css" ref="stylesheet"/>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>
@endsection
