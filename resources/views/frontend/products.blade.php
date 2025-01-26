@extends(getLayout())

@section('content')
  
    <div class="p-4">
        <h4 class="fw-bold mb-3">{{$heading}}</h4>
        <div class="row g-3">
            @if($products->count()>0)
            @foreach ($products as $product)
               
                    @include('frontend.components.products.productcard', ['product' => $product])
               
            @endforeach
@else
 <h6> No Products Found in {{$heading}}</h6>
@endif
        </div>
    </div> 

   
 
    <div class="pt-4 pb-5"></div>
 
</div>

 
@endsection
@section('scripts')
    <script>
        const products = @json($products);
    </script>
@endsection
