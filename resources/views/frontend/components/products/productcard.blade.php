<style>
    .product-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        padding: 10px;
        text-align: center;
        max-width: 300px;
        background-color: #fff;
    }

    .product-card img {
        max-height: 150px;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }

    .badge-earliest {
        background-color: #f8f9fa;
        color: #28a745;
        font-weight: bold;
        border: 1px solid #e0e0e0;
        font-size: 0.7rem;
        padding: 3px 8px;
        border-radius: 10px;
        display: inline-block;
        margin-bottom: 5px;
    }

    .product-title {
        font-size: 0.9rem;
        font-weight: bold;
        color: #000;
        margin: 8px 0;
        line-height: 1.3;
    }

    .product-weight {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .product-price {
        font-size: 1rem;
        font-weight: bold;
        color: #000;
        margin: 10px 0;
    }

    .btn-add {
        background-color: #28a745;
        color: #fff;
        border-radius: 20px;
        font-weight: bold;
        padding: 5px 20px;
        font-size: 0.8rem;
    }
    .btn-add:hover{
        background-color: #75d49d;
        border: 2px solid green;
        border-radius: 20px;
        font-weight: bold;
        padding: 5px 20px;
        font-size: 0.8rem;
    }
</style>
<div class="container my-4">
    <div class="product-card">
        <!-- Badge -->
        <span class="badge-earliest">Earliest</span>

        <!-- Product Image -->
        <img src="{{asset('/asset/products/dummyproduct.png')}}" alt="Product Image" class="img-fluid">

        <!-- Product Title -->
        <div class="product-title">Kettle Studio Potato Chips - Sharp Jalapeno</div>

        <!-- Product Weight -->
        <div class="product-weight">113 g</div>

        <!-- Product Price -->
        <div class="product-price">₹99</div>

        <!-- Add Button -->
        <button class="btn btn-add w-100">ADD</button>
    </div>
</div>
