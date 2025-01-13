<style>
    .product-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        padding: 10px;
        text-align: center;
        max-width: 300px;
        background-color: #fff;
        position: relative;
        font-family: Arial, sans-serif;
        height: 320px; /* Fixed height */
    }

    .product-card img {
        max-height: 150px;
        height: 180px; /* Fixed height for uniform size */
        object-fit: cover;
        display: block;
        margin: 0 auto 10px;
    }

    .badge-discount {
        width: 35px;
        height: 35px;
        position: absolute;
        top: 5px;
        left: 5px;
        background-color:  rgb(49, 134, 22);
        color: #fff;
        font-size: 0.6rem;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .badge-timer {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #f8f9fa;
        color: #28a745;
        font-weight: bold;
        font-size: 0.7rem;
        padding: 3px 8px;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
    }

    .product-title {
        font-size: 1rem;
        font-weight: bold;
        color: #000;
        margin: 8px 0;
        line-height: 1.3;
    }

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
    .card-bottam{
        display: flex;
        justify-content: space-between;
    }
</style>

<div class="container my-4">
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
            @foreach(json_decode($product->attributes) as $key => $value)
                <div class="attribute-box" data-id="{{$product->id}}" data-value="{{ $value }}" data-key="{{$key}}">{{ $key }}</div>
            @endforeach
        </div>

        <!-- Product Price -->
        <div class="card-bottam">
            <div class="product-price">
                ₹<span id="productPrice{{$product->id}}">{{ $product->price }}</span>
                <div>
                <strike id="mrp{{$product->id}}">₹{{ $product->mrp }}</strike>
            </div>
            </div>

            <!-- Quantity Control -->
            <div class="quantity-control quantitycard" id="quantitycart{{$product->id}}">
                <button id="decreaseQty{{$product->id}}" class="decreaseQty" data-id="{{$product->id}}">-</button>
                <span class="quantity-value" id="quantity{{$product->id}}" data-id="{{$product->id}}">0</span>
                <button id="increaseQty{{$product->id}}"  class="increaseQty"  data-id="{{$product->id}}">+</button>
            </div>
            <div class="quantity-control  addbuttoncart"  id="addbutton{{$product->id}}">
                <button id="addToCartButton{{$product->id}}" data-id="{{$product->id}}"  class="addToCartButton">
                <span  data-id="{{$product->id}}">Add</span>
            </button>
                    </div>
        </div>

      
    </div>
</div>



