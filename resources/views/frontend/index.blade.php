@extends(getLayout())

@section('content')
<div class="row">
    <h4>Popular Products</h4>

    <div class="slider">
        @foreach($popular_products as $product)
        <div>
            @include('frontend.components.products.productcard', ['product' => $product])
        </div>
        @endforeach
    </div>
</div>

<div class="row">
    <h4>Trending Products</h4>

    <div class="slider">
        @foreach($trending_products as $product)
        <div>
            @include('frontend.components.products.productcard', ['product' => $product])
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
<script>
    const products = @json($products);
</script>
@endsection
