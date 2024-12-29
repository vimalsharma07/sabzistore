@extends(getLayout())

@section('content')
<div class="row">
    <div class="slider">
        @foreach($products as $product)
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
