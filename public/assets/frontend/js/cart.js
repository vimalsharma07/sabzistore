$(document).ready(function () {
    // Set CSRF token globally for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    
    
    
    const $addToCartBtn = $('.addToCartButton');
    const $attributeBoxes = $('.attribute-box');
    function checkproduct(){
        $.ajax({
            url: `cart`,
            method: 'GET',
            success: function (response) {

                var cart= response.cart;
                Object.entries(cart).forEach(([key, product]) => {
                    const product_id = product.product_id;

                    if (Object.keys(product.attributes).length) { // Check if attributes exist
                        const [keydata, value] = Object.entries(product.attributes)[0];
                        const element = document.querySelector(`.attribute-box[data-id="${product_id}"][data-key="${keydata}"]`);
                        if (element) {
                            var selectedattr = $attributeBoxes.filter(`[data-id="${product_id}"]`).filter('.selected');
                            selectedattr.removeClass('selected'); 
                            $(element).addClass('selected'); 
                            $('#productPrice'+product_id).text(value);
                        } else {
                            console.log(`No element found with data-key="${keydata}".`);
                        }
                    } else {
                        console.log('No attributes found for this product.');
                    }
                    
                    
                    var quantity= product.quantity;
                    $('#quantitycart'+product_id).show();
                    $('#quantity'+product_id).text(quantity);
                    $('#addbutton'+product_id).hide();
         
                });
                
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    if (typeof products !== 'undefined' && products.length > 0) {
        products.forEach(function(product, index) {
        try {
            const attributes = JSON.parse(product.attributes);
            const productId= product.id;
            var attr = $('.attribute-box').filter(`[data-id="${productId}"]`)[0];
            if (attr) {
                $(attr).addClass('selected');
                $('.quantitycard').hide();
                $('.addbuttoncard').show();

            } else {
                console.log('No attribute box found for the given product ID.');
            }
           
        } catch (error) {
            console.error(`Error parsing attributes for product ${index + 1}:`, product.attributes, error);
        }
    });
}

function cartfesstip() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `cart`,
            method: 'GET',
            success: function (response) {
                resolve(response);  // Resolve with the response data
            },
            error: function (xhr) {
                reject(xhr.responseText);  // Reject on error
            }
        });
    });
}
    var cart= '';
    var fees= '';
    var tip = '';
    cartfesstip()
        .then(response => {
            cart= response.cart;
            fees= response.fees;
            tip= response.tip;

        })
        .catch(error => {
            console.log(error);  
        });

        function updateDesktopCart() {
            cartfesstip()
                .then(response => {
                    cart = response.cart;
                    fees = response.fees;
                    tip = response.tip;
        
                    let cartHtml = `
                    <div class="delivery-time">
                        <i class="fas fa-clock"></i>
                        <span>Delivery in 8 minutes</span>
                        <span id="overlay" class="btn btn-close"></span>
                    </div>`;
        
                    if (cart && typeof cart === 'object' && Object.keys(cart).length > 0) {
                        Object.keys(cart).forEach(key => {
                            const item = cart[key];
                            const product = item.product;
                            const attributeKey = Object.keys(item.attributes)[0];
                            const attributeValue = item.attributes[attributeKey];
        
                            cartHtml += `
                            <div class="product">
                                <div class="product-left">
                                    <img src="${product.image}" alt="${product.name}">
                                    <div class="product-details">
                                        <div class="product-name">${product.name}</div>
                                        <div class="product-attribute">${attributeKey}</div>
                                        <div class="product-price">
                                            <span class="normal-price">₹${attributeValue}</span>
                                            <span class="strike-price">₹${product.mrp}</span>
                                            <span class="delivery-free">Delivery Free</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-right">
                                    <div class="product-quantity">
                                        <span class="decreaseQtyCart" data-id="${item.product_id}" data-key="${attributeKey}" data-value="${attributeValue}">-</span>
                                        <span class="quantity-value">${item.quantity}</span>
                                        <span class="increaseQtyCart selected" data-id="${item.product_id}" data-key="${attributeKey}" data-value="${attributeValue}">+</span>
                                    </div>
                                </div>
                            </div>`;
                        });
                    } else {
                        cartHtml += `<p>Your cart is empty.</p>`;
                    }
        
                    cartHtml += `
                    <div class="bill-details">
                        <h5 class="bold">Bill Details</h5>
                        <ul>
                            <li><span>Item total</span><span>₹${fees.itemTotal}</span></li>
                            <li><span>Delivery Charge</span><span><del>₹${fees.deliveryCharge.fee}</del> ₹${fees.deliveryCharge.discounted_fee}</span></li>
                            <li><span>Handling Charge</span><span><del>₹${fees.handlingCharge.fee}</del> ₹${fees.handlingCharge.discounted_fee}</span></li>
                            <li><span>Small Order Charge</span><span><del>₹${fees.smallOrderCharge.fee}</del> ₹${fees.smallOrderCharge.discounted_fee}</span></li>
                            <li><span>Tip</span><span>₹${tip}</span></li>
                            <li><strong>Grand total</strong><strong><del>₹${fees.grandTotal}</del></strong></li>
                            <li><strong>Payable Amount</strong><strong>₹${fees.discountedGrandTotal}</strong></li>
                        </ul>
                    </div>`;
        
                    cartHtml += `
                    <div class="tip">
                        <h5>Tip Your Delivery Partner</h5>
                        <p>Your kindness means a lot! 100% of your tip will go directly to your delivery partner.</p>
                        <div class="tip-buttons">
                            <button id="tip20" class="tip-btn ${tip=='20'?'selected':''}" onclick="selectTip(20)">₹20</button>
                            <button id="tip30" class="tip-btn ${tip=='30'?'selected':''}" onclick="selectTip(30)">₹30</button>
                            <button id="tip50" class="tip-btn ${tip=='50'?'selected':''}" onclick="selectTip(50)">₹50</button>
                            <button id="customTipBtn" class="tip-btn" onclick="showCustomTipInput()">Custom Tip</button>
                        </div>
                        <div id="customTipBox" style="display:none;">
                            <input type="number" id="customTip" placeholder="Enter Custom Tip" class="tip-input" oninput="updateCustomTip()" />
                            <button id="addCustomTip" class="add-tip-btn" onclick="addCustomTip()">Add</button>
                        </div>
                    </div>`;

                 cartHtml += `
    <div class="address-selection">
        ${userAddress ? `
            <div class="container mt-3">
                <div class="delivery-info">
                    <img alt="House icon" src="https://placehold.co/24x24" />
                    <div class="address">
                        <p>
                            Delivering to
                            <span class="title">
                                Home
                            </span>
                        </p>
                        <p>
                            ${userAddress.houseno} ${userAddress.address}
                        </p>
                    </div>
                    <div class="change">
                        Change
                    </div>
                </div>
                <div class="select-payment">
                    <a href="/order/create">
                        Place Order
                    </a>
                </div>
            </div>
        ` : `
            <div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#otpModal">
                    Log In To Proceed
                </button>
            </div>
        `}
    </div>
`;

        
                    // Update the desktop cart layout with new HTML
                    $('#cart').html(cartHtml);
        
                    // Event delegation for increase and decrease buttons
                    $('#cart').off('click', '.increaseQtyCart');
                    $('#cart').on('click', '.increaseQtyCart', function() {
                        const productId = $(this).data('id');
                        const attributeKey = $(this).data('key');
                        const attributeValue = $(this).data('value');
                        const attribute = { [attributeKey]: attributeValue };
                        addtoCart(productId, attribute);
                    });
        
                    $('#cart').off('click', '.decreaseQtyCart');
                    $('#cart').on('click', '.decreaseQtyCart', function() {
                        const productId = $(this).data('id');
                        const attributeKey = $(this).data('key');
                        const attributeValue = $(this).data('value');
                        const attribute = { [attributeKey]: attributeValue };
                        removetoCart(productId, attribute);
                    });
        
                })
                .catch(error => {
                    console.log(error);  
                });
        }
        

   
function updateMobileCart() {
    cartfesstip()
        .then(response => {
            cart = response.cart;
            fees = response.fees;
            tip = response.tip;

            let cartHtml = `
            <div class="delivery-time">
                <i class="fas fa-clock"></i>
                <span>Delivery in 8 minutes</span>
            </div>`;

            if (cart && typeof cart === 'object' && Object.keys(cart).length > 0) {
                Object.keys(cart).forEach(key => {
                    const item = cart[key];
                    const product = item.product;
                    const attributeKey = Object.keys(item.attributes)[0];
                    const attributeValue = item.attributes[attributeKey];

                    cartHtml += `
                    <div class="product">
                        <div class="product-left">
                            <img src="${product.image}" alt="${product.name}">
                            <div class="product-details">
                                <div class="product-name">${product.name}</div>
                                <div class="product-attribute">${attributeKey}</div>
                                <div class="product-price">
                                    <span class="normal-price">₹${attributeValue}</span>
                                    <span class="strike-price">₹${product.mrp}</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-right">
                            <div class="product-quantity">
                                <span class="decreaseQtyCart" data-id="${item.product_id}" data-key="${attributeKey}" data-value="${attributeValue}">-</span>
                                <span class="quantity-value">${item.quantity}</span>
                                <span class="increaseQtyCart selected" data-id="${item.product_id}" data-key="${attributeKey}" data-value="${attributeValue}">+</span>
                            </div>
                        </div>
                    </div>`;
                });
            } else {
                cartHtml += `<p>Your cart is empty.</p>`;
            }

            cartHtml += `
            <div class="bill-details">
                <h5 class="bold">Bill Details</h5>
                <ul>
                    <li><span>Item total</span><span>₹${fees.itemTotal}</span></li>
                    <li><span>Delivery Charge</span><span><del>₹${fees.deliveryCharge.fee}</del> ₹${fees.deliveryCharge.discounted_fee}</span></li>
                    <li><span>Handling Charge</span><span><del>₹${fees.handlingCharge.fee}</del> ₹${fees.handlingCharge.discounted_fee}</span></li>
                    <li><span>Small Order Charge</span><span><del>₹${fees.smallOrderCharge.fee}</del> ₹${fees.smallOrderCharge.discounted_fee}</span></li>
                    <li><span>Tip</span><span>₹${tip}</span></li>
                    <li><strong>Grand total</strong><strong><del>₹${fees.grandTotal}</del></strong></li>
                    <li><strong>Payable Amount</strong><strong>₹${fees.discountedGrandTotal}</strong></li>
                </ul>
            </div>`;

            cartHtml += `
            <div class="tip">
                <h5>Tip Your Delivery Partner</h5>
                <p>Your kindness means a lot! 100% of your tip will go directly to your delivery partner.</p>
                <div class="tip-buttons">
                    <button id="tip20" class="tip-btn ${tip=='20'?'selected':''}" onclick="selectTip(20)">₹20</button>
                    <button id="tip30" class="tip-btn" onclick="selectTip(30)">₹30</button>
                    <button id="tip50" class="tip-btn" onclick="selectTip(50)">₹50</button>
                    <button id="customTipBtn" class="tip-btn" onclick="showCustomTipInput()">Custom Tip</button>
                </div>
                <div id="customTipBox" style="display:none;">
                    <input type="number" id="customTip" placeholder="Enter Custom Tip" class="tip-input" oninput="updateCustomTip()" />
                    <button id="addCustomTip" class="add-tip-btn" onclick="addCustomTip()">Add</button>
                </div>
            </div>`;

            // Update the cart layout with new HTML
            $('.cart-layout').html(cartHtml);

            // Using jQuery for event delegation
            $('.cart-layout').off('click', '.increaseQtyCart');

            $('.cart-layout').on('click', '.increaseQtyCart', function() {
                console.log("coming");
                const productId = $(this).data('id');
                const attributeKey = $(this).data('key');
                const attributeValue = $(this).data('value');
                 const   attribute = {
                    [attributeKey]: attributeValue
                };
                  addtoCart(productId,attribute);
                
            });
            $('.cart-layout').off('click', '.decreaseQtyCart');

            $('.cart-layout').on('click', '.decreaseQtyCart', function() {

                const productId = $(this).data('id');
                const attributeKey = $(this).data('key');
                const attributeValue = $(this).data('value');
                const   attribute = {
                   [attributeKey]: attributeValue
               };
                removetoCart(productId, attribute);               
            });

        })
        .catch(error => {
            console.log(error);  
        });
}



    // Check if product is in the cart on page load
    function checkproductincart(productId,attributes) {
        $.ajax({
            url: `/getcart/${productId}`,
            method: 'GET',
            data: {attributes },

            success: function (response) {
            if(response.inCart){
            var product = response.product;
            var quantity= product.quantity;
            $('#quantity'+product.product_id).text(quantity);
            $('#quantitycart'+product.product_id).show();
            $('#addbutton'+product.product_id).hide();
            }else{
                $('#quantitycart'+productId).hide();
                $('#addbutton'+productId).show();
            }           
            },
            error: function () {
                alert('Failed to check cart status');
            }
        });
    }

    function addtoCart(productId,attributes){
        $.ajax({
            url: `/cart/add/${productId}`,
            method: 'POST',
            data: {attributes },
            success: function (response) {
                console.log(response);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
         updateDesktopCart();
        updateMobileCart();
    }

    function removetoCart(productId,attributes){
        
        $.ajax({
            url: `/cart/remove/${productId}`,
            method: 'POST',
            data: {attributes },
            success: function (response) {
                console.log(response);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });

        // updateDesktopCart();
        updateMobileCart();
    }
    // Add to Cart
    $addToCartBtn.on('click', function () {
        const productId = $(this).data('id'); 
        var attr = $attributeBoxes.filter(`[data-id="${productId}"]`).filter('.selected');
            var attrKey = $(attr).data('key');
            var attrVal = $(attr).data('value');
            var attribute= {};
            if (attr.length) {
                var attrKey = $(attr).data('key');
                var attrVal = $(attr).data('value');
            
                attribute = {
                    [attrKey]: attrVal
                };
            }
         
            var qele=   $('#quantity'+productId);
            qele.text(1);
            $('#quantitycart'+productId).show();
            $('#addbutton'+productId).hide();

      addtoCart(productId,attribute);
       
    });

    

    // Quantity Control (Increase and Decrease)
    $('.increaseQty').on('click', function () {
       var productId= $(this).data('id');
        var qele=   $('#quantity'+productId);
        const currentQty = parseInt((qele).text());
        const newQty = currentQty + 1;
        qele.text(newQty);
        var currentPath = window.location.pathname;
        if(currentPath=='/cart'){
            var attr= $(this);
        }else{
            var attr = $attributeBoxes.filter(`[data-id="${productId}"]`).filter('.selected');

        }
        
        var attrKey = $(attr).data('key');
        var attrVal = $(attr).data('value');

        var attribute = {
            [attrKey]: attrVal 
        };
        if(currentQty==1){
            $('#addbutton'+productId).hide();
            $('#quantitycart'+productId).show();
        }
           
        
        addtoCart(productId,attribute);  // Update the cart in the session
    });

    $('.decreaseQty').on('click', function () {
        var productId= $(this).data('id');
        var qele=   $('#quantity'+productId);
        const currentQty = parseInt((qele).text());
        const newQty = currentQty -1;
        qele.text(newQty);
        var currentPath = window.location.pathname;
        if(currentPath=='/cart'){
            var attr = $(this);
        }else{
            var attr = $(`.attribute-box[data-id="${productId}"].selected`);
        }
        var attrKey = $(attr).data('key');
        var attrVal = $(attr).data('value');

        var attribute = {
            [attrKey]: attrVal 
        };
        if(currentQty==1){
           $('#addbutton'+productId).show();
           $('#quantitycart'+productId).hide();
        }
        removetoCart(productId,attribute);  // Update the cart in the session
    });

    // Attribute Selection
    $attributeBoxes.on('click', function () {
        var dataid= $(this).data('id');
        $attributeBoxes.filter(`[data-id="${dataid}"]`).removeClass('selected');
        $(this).addClass('selected');
       var attrval=   $(this).data('value');
       var attrkey=   $(this).data('key');
       var attribute = { [attrkey]: attrval }; // Use square brackets for dynamic key
       $('#productPrice'+dataid).text(attrval);
       $('#mrp'+dataid).hide();
       
       checkproductincart(dataid, attribute);

    });

    // Initialize cart status
    checkproduct();


    function openCart() {
        const cart = document.getElementById('cart');
        cart.classList.add('show-cart');
    }
  
    // Function to hide the cart
    function closeCart() {
        const cart = document.getElementById('cart');
        cart.classList.remove('show-cart');
    }


    let selectedTip = 0; // Default selected tip value

    // Save tip to server using AJAX
    function saveTipToServer(tipAmount) {
        $.ajax({
            url: '/save-tip',  // URL to handle tip saving
            type: 'POST',
            data: {
                tip: tipAmount
            },
            success: function(response) {
                console.log('Tip saved successfully:', response.message);
            },
            error: function(xhr) {
                console.log('Error saving tip:', xhr.responseText);
            }
        });
    }
    $('.tip-btn').click(function() {
        
        const tipAmount = parseInt($(this).attr('id').replace('tip', ''));
        alert(tipAmount);
        if (!isNaN(tipAmount)) {
            selectTip(tipAmount);
        } else {
            showCustomTipInput();
        }
    });
     // Event for dynamically added custom tip
     $(document).on('click', '#customTipBtn', function () {
        const customTip = $('#customTip').val();
        addCustomTip(customTip);
    });
    
    function selectTip(amount) {
        selectedTip = amount;
        $('.tip-btn').css('background-color', '');
        $('#tip' + amount).css('background-color', 'green');
        $('#customTipBox').hide();
        $('#customTip').val('');
        saveTipToServer(selectedTip);  
    }

    function showCustomTipInput() {
        $('#customTipBox').removeClass('d-none');
        $('.tip-btn').css('background-color', ''); // Reset button colors
    }

    function addCustomTip() {
        selectedTip = $('#customTip').val();
        $('#customTipBtn').css('background-color', 'green');
        $('#customTipBox').hide();
        saveTipToServer(selectedTip);  // Save tip to server
    }

        // Fetch saved tip amount from the server using AJAX or session
        $.ajax({
            url: '/get-tip',  // URL to retrieve the saved tip
            type: 'GET',
            success: function(response) {
                selectedTip = response.tip;  // Assume the server returns { tip: 20 }
                if (selectedTip > 0) {
                    if (selectedTip == 20 || selectedTip == 30 || selectedTip == 50) {
                        $('#tip' + selectedTip).css('background-color', 'green');
                    } else {
                        $('#customTipBtn').css('background-color', 'green');
                        $('#customTip').val(selectedTip);  // Pre-fill custom tip
                    }
                }
            },
            error: function(xhr) {
                console.log('Error fetching tip:', xhr.responseText);
            }
        });
    
});
