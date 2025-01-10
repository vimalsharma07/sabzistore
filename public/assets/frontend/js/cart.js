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
                        console.log(element);
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
        var attr = $attributeBoxes.filter(`[data-id="${productId}"]`).filter('.selected');
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
        var attr = $attributeBoxes.filter(`[data-id="${productId}"]`).hasClass('selected');
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
       console.log(attribute);
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
});
