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
                        // Assuming `keydata` and `dataId` are variables holding the dynamic values
                        const element = document.querySelector(`.attribute-box[data-id="${product_id}"][data-key="${keydata}"]`);
                        if (element) {
                            var selectedattr = $attributeBoxes.filter(`[data-id="${product_id}"]`).filter('.selected');
                            selectedattr.removeClass('selected'); // Remove 'selected' class from previous elements
                            $(element).addClass('selected'); // Add 'selected' class to the new element
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
        console.log(attributes);
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
        console.log(attr);
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
