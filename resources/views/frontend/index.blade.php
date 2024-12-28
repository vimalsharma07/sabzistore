@extends(getLayout())

@section('content')
<div class="row">
    @for($i = 0; $i < 6; $i++)
    <div class="col-6 col-md-4 col-lg-3 mb-3">
        @include('frontend.components.products.productcard')

    </div>
    @endfor
    >
    
</div>

@endsection
