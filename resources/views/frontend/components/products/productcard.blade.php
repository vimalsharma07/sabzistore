<style>
 

   

    .product-attributes {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-bottom: 10px;
    }

    .attribute-box {
        border: 1px solid #e0e0e0;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .attribute-box:hover,
    .attribute-box.selected {
        background-color: #28a745;
        color: #fff;
        border-color: #28a745;
    }

    .product-price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #000;
        margin: 5px 0;
    }

    .product-price strike {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
        cursor: pointer;
        width: 66px;
        border: 1px solid rgb(49, 134, 22);
        height: 31px;
        font-weight: 600;
        font-size: 13px;
        font-family: Okra;
        border-radius: 0.375rem;
        gap: 0.125rem;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        background-color: rgb(49, 134, 22);
        color: rgb(255, 255, 255);
        -webkit-box-pack: justify;
        justify-content: space-between;
    }


    .quantity-control button {
        background-color: rgb(49, 134, 22);
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;

    }

    .quantity-control button:hover {
        background-color: #75d49d;
    }

    .quantity-value {
        font-size: 1rem;
        font-weight: bold;
    }

    .card-bottam {
        display: flex;
        justify-content: space-between;
    }
</style>

<!-- 1st product -->
<div class="col-6 col-md-4">
    <a href="javascript:void();" class="text-decoration-none link-dark">
        <div class="card rounded-4 shadow border-0 overflow-hidden search-list-item">
            <div class="position-relative">
                <div class="product-back"><img src="{{ asset($product->image) }}" alt=""
                        class="img-fluid rounded-top"></div>
                <!-- product time  -->
                <div class="product-time shadow-sm position-absolute bottom-0 end-0 m-2">
                    <span class="badge bg-light text-dark rounded-pill"><i
                            class="fa-solid fa-stopwatch text-success"></i>&nbsp;37 mins</span>
                </div>
                <!-- product off -->
                <div
                    class="product-off bg-danger px-2 py-1 rounded-pill shadow-sm position-absolute top-0 end-0 m-2 small">
                    <div class="d-flex align-items-start gap-1 fw-bold text-white">
                        <div><i class="fa-solid fa-percent"></i></div>
                        <div>
                            <div>{{ getDiscount($product) }}% OFF</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-1">
                    <div><span class="badge bg-success rounded-pill">4.2&nbsp;<i class="fa-solid fa-star"></i></span>
                    </div>
                    <div class="h4 fw-bold m-0">{{ $product->name }}</div>
                </div>
                <div class="d-flex gap-2 text-muted m-0 fw-normal add-footer">
                    {{-- <div class="add-btn"><i class="bi bi-plus-lg"></i></div> --}}
                    <!-- Quantity Control -->

                    @php
                        $mrp = json_decode($product->attributes_mrp);
                    @endphp
                    @foreach (json_decode($product->attributes) as $key => $value)
                        <div class="attribute-box" data-id="{{ $product->id }}" data-value="{{ $value }}"
                            data-key="{{ $key }}" data-mrp="{{ $mrp[$loop->index] }}">
                            {{ $key }}</div>
                    @endforeach

                </div>
                <div class="product-price">
                    ₹<span id="productPrice{{ $product->id }}">{{ $product->price }}</span>
                    <span>
                        <strike id="mrp{{ $product->id }}">₹{{ $product->mrp }}</strike>
                    </span>
                </div>
                <div class=" quantity-control quantitycard" id="quantitycart{{ $product->id }}">
                    <button id="decreaseQty{{ $product->id }}" class="decreaseQty"
                        data-id="{{ $product->id }}">-</button>
                    <span class="quantity-value" id="quantity{{ $product->id }}"
                        data-id="{{ $product->id }}">0</span>
                    <button id="increaseQty{{ $product->id }}" class="increaseQty"
                        data-id="{{ $product->id }}">+</button>
                </div>
                <div class="add-btn  addbuttoncart" id="addbutton{{ $product->id }}">
                    <button id="addToCartButton{{ $product->id }}" data-id="{{ $product->id }}"
                        class="addToCartButton add-btn">
                        <span data-id="{{ $product->id }}"><i class="bi bi-plus-lg"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </a>
</div>






{{-- <div class="container my-4">
    <div class="product-card">
        <!-- Discount Badge -->
        <span class="badge-discount">{{ getDiscount($product) }}% OFF</span>

        <!-- Timer Badge -->
        <span class="badge-timer">30 MINS</span>

        <!-- Product Image -->
        <img src="{{ asset($product->image) }}" alt="Product Image" class="img-fluid">

        <!-- Product Title -->
        <div class="product-title">{{ $product->name }}</div>

        <!-- Product Attributes -->
        <div class="product-attributes">
            @php
                $mrp = json_decode($product->attributes_mrp);
            @endphp
            @foreach (json_decode($product->attributes) as $key => $value)
                <div class="attribute-box" data-id="{{ $product->id }}" data-value="{{ $value }}"
                    data-key="{{ $key }}" data-mrp="{{ $mrp[$loop->index] }}">{{ $key }}</div>
            @endforeach
        </div>

        <!-- Product Price -->
        <div class="card-bottam">
            <div class="product-price">
                ₹<span id="productPrice{{ $product->id }}">{{ $product->price }}</span>
                <div>
                    <strike id="mrp{{ $product->id }}">₹{{ $product->mrp }}</strike>
                </div>
            </div>

            <!-- Quantity Control -->
            <div class="quantity-control quantitycard" id="quantitycart{{ $product->id }}">
                <button id="decreaseQty{{ $product->id }}" class="decreaseQty"
                    data-id="{{ $product->id }}">-</button>
                <span class="quantity-value" id="quantity{{ $product->id }}"
                    data-id="{{ $product->id }}">0</span>
                <button id="increaseQty{{ $product->id }}" class="increaseQty"
                    data-id="{{ $product->id }}">+</button>
            </div>
            <div class="quantity-control  addbuttoncart" id="addbutton{{ $product->id }}">
                <button id="addToCartButton{{ $product->id }}" data-id="{{ $product->id }}"
                    class="addToCartButton">
                    <span data-id="{{ $product->id }}">Add</span>
                </button>
            </div>
        </div>


    </div>
</div> --}}
