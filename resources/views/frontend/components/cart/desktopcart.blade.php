<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }
    
    /* Animation for cart sliding in from the right */
    @keyframes slideInFromRight {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }
  
    .cart-container {
        overflow: scroll;
        max-width: 400px;
        height: 90vh;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        position: fixed;
        top: 10px;
        right: -450px; /* Initially hidden off-screen */
        animation: slideInFromRight 0.5s ease-out forwards; /* Applying animation */
    }
    
    .cart-container.show-cart {
        right: 20px; /* Final position when animation completes */
    }
  
    .cart-header {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .cart-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 10px;
        background-color: #f1f3f5;
        border-radius: 8px;
    }
    .cart-item img {
        width: 60px;
        height: 40px;
        margin-right: 10px;
    }
    .cart-item-details {
        flex-grow: 1;
    }
    .cart-item-price {
        font-weight: bold;
    }
    .cart-item-quantity {
        display: flex;
        align-items: center;
    }
    .cart-item-quantity button {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
    }
    .bill-details {
        margin-bottom: 20px;
    }
    .bill-details .row {
        margin-bottom: 10px;
    }
    .bill-details .row:last-child {
        font-weight: bold;
    }
    .cancellation-policy {
        margin-bottom: 20px;
    }
    .total-container {
        position: fixed;
        bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #28a745;
        color: #fff;
        padding: 10px;
        border-radius: 8px;
    }
    .total-container button {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
    }
  </style>
  
  <div class="cart-container" id="cart">
    <div class="cart-header">
      My Cart
      <button aria-label="Close" class="btn-close float-end" type="button" onclick="closeCart()"></button>
    </div>
  
    <!-- Cart Item 1 -->
    <div class="cart-item">
      <div class="me-3">
        <i class="fas fa-clock fa-2x"></i>
      </div>
      <div class="cart-item-details">
        <div class="fw-bold">
          Delivery in 9 minutes
        </div>
        <div>
          Shipment of 1 item
        </div>
      </div>
    </div>
  
    <!-- Cart Item 2 -->
    <div class="cart-item">
      <img alt="Image of Ultimate Rolling Paper with Filter" height="40" src="https://storage.googleapis.com/a1aa/image/V0g5ytrwbCIrNNpaZP71kH8TVFesNrPDujtU8cfbdo6Vgf8nA.jpg" width="60"/>
      <div class="cart-item-details">
        <div>
          Ultimate Rolling Paper with Filter...
        </div>
        <div>
          1 pack (32 Leaves + 32 Filters)
        </div>
        <div class="cart-item-price">
          ₹80
        </div>
      </div>
      <div class="cart-item-quantity">
        <button>-</button>
        <span class="mx-2">1</span>
        <button>+</button>
      </div>
    </div>
  
    <!-- Bill Details -->
    <div class="bill-details">
      <div class="row">
        <div class="col">
          Items total
        </div>
        <div class="col text-end">
          ₹80
        </div>
      </div>
      <div class="row">
        <div class="col">
          Delivery charge
          <i class="fas fa-info-circle"></i>
        </div>
        <div class="col text-end">
          ₹25
        </div>
      </div>
      <div class="row">
        <div class="col">
          Handling charge
          <i class="fas fa-info-circle"></i>
        </div>
        <div class="col text-end">
          ₹5
        </div>
      </div>
      <div class="row">
        <div class="col">
          Grand total
        </div>
        <div class="col text-end">
          ₹110
        </div>
      </div>
    </div>
  
    <!-- Cancellation Policy -->
    <div class="cancellation-policy">
      <div class="fw-bold">
        Cancellation Policy
      </div>
      <div>
        Orders cannot be cancelled once packed for delivery. In case of unexpected delays, a refund will be provided, if applicable.
      </div>
    </div>
  
    <!-- Total Container -->
    <div class="total-container">
      <div>₹110 TOTAL</div>
      <button>
        Login to Proceed <i class="fas fa-arrow-right"></i>
      </button>
    </div>
  </div>
  