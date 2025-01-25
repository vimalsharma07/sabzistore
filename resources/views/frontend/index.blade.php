@extends(getLayout())

@section('content')
    @include('frontend.components.story.index')

    <div class="p-4">
        <h4 class="fw-bold mb-3">Popular Products</h4>
        <div class="row g-3">
            @foreach ($popular_products as $product)
               
                    @include('frontend.components.products.productcard', ['product' => $product])
               
            @endforeach

        </div>
    </div> 

    <div class="p-4">
        <h4 class="fw-bold mb-3">Trending Products</h4>
        <div class="row g-3">
            @foreach ($trending_products as $product)
              
                    @include('frontend.components.products.productcard', ['product' => $product])
                
            @endforeach

        </div>
    </div>
    <div class="pt-4 pb-5"></div>
@endsection
@section('scripts')
    <script>
        const products = @json($products);
    </script>
@endsection
