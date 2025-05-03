import { showToast } from '../utils/toast';

$(document).ready(function() {
    'use strict';

    // initialize cart count
    updateCartCount();

    // helper function to get CSRF token
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').content;
    }

    // add to cart
    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();
        const $button = $(this);
        const productId = $button.data('product-id');

        $button.addClass('disabled');
        $button.find('.cart-text').text('Adding...');

        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: {
                product_id: productId,
                _token: getCsrfToken()
            },
            success: function(response) {
                if (response.success) {
                    // Update cart count
                    updateCartCount(response.count, response.total);
                    // Show success message
                    showToast('Product added to cart successfully', 'success');
                }
            },
            error: function(xhr) {
                showToast('Error adding product to cart', 'error');
            },
            complete: function() {
               $button.removeClass('disabled');
               $button.find('.cart-text').text('Add to Cart');
            }
        });
    });

    // increment quantity
    $('.cart-items').on('click', '.increment-qty', function(e) {
        e.preventDefault();
        let input = $(this).siblings('.quantity-input');
        let currentVal = parseInt(input.val());
        let max = parseInt(input.attr('max'));
        
        if (currentVal < max) {
            input.val(currentVal + 1).trigger('change');
        }
    });

    // decrement quantity
    $('.cart-items').on('click', '.decrement-qty', function(e) {
        e.preventDefault();
        let input = $(this).siblings('.quantity-input');
        let currentVal = parseInt(input.val());
        let min = parseInt(input.attr('min'));
        
        if (currentVal > min) {
            input.val(currentVal - 1).trigger('change');
        }
    });

    // update quantity
    $('.cart-items').on('change', '.quantity-input', function() {
        let productId = $(this).data('product-id');
        let newQuantity = $(this).val();
        let cartItem = $(this).closest('.cart-item');
        
        $.ajax({
            url: `/cart/update`,
            method: 'POST',
            data: {
                product_id: productId,
                quantity: newQuantity,
                _token: getCsrfToken()
            },
            success: function(response) {
                cartItem.find('.subtotal').text(response.subtotal);
                $('.cart-total').text('Rs. ' + response.total);
                // Update cart count
                updateCartCount(response.count, response.total);
                showToast(response.message, 'success');
            },
            error: function(xhr) {
                showToast('Error updating quantity', 'error');
            }
        });
    });

    // remove item from cart
    $('.cart-items').on('click', '.remove-cart-item', function(e) {
        e.preventDefault();
        const productId = $(this).data('product-id');
        let cartItem = $(this).closest('.cart-item');
      //  let productName = cartItem.find('h3').text();
        
        if (confirm(`Are you sure you want to remove from your cart?`)) {
            $.ajax({
                url: `/cart/remove/`,
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: getCsrfToken()
                },
                success: function(response) {
                    if (response.success) {
                        cartItem.remove();
                        $('.cart-total').text('Rs. ' + response.total);
                        
                        // Update cart count
                        updateCartCount(response.count, response.total);
                        
                        // Show success message
                        showToast('Product removed from cart successfully.', 'success');

                        if (response.count === 0) {
                            $('.cart-summary').html('<p>Your cart is empty</p>');
                        }
                    }
                },
                error: function(xhr) {
                    showToast('Error removing product from cart', 'error');
                }
            });
        }            
    });

    // function to update cart count in navbar
    function updateCartCount(count = null, total = 0) {
        if (count !== null) {
            $('#header-cart-count').text(count);
            $('#header-cart-total').text('Rs. ' + total);
         //   $('#header-wishlist-count').text(0);
        } else {
            $.get('/cart', function(response) {
                if (response.success) {
                    $('#header-cart-count').text(response.count);
                    $('#header-cart-total').text('Rs. ' + response.total);
                    $('#header-wishlist-count').text(response.wishlist_count);
                }
            });
        }
    }

    // initialize cart items (for page load)
    function initializeCartItems() {
        $.get('/cart', function(response) {
            if (response.success && response.cart) {
                // Update cart count
                $('#header-cart-count').text(response.count);
                $('#header-cart-total').text('Rs. ' + response.total);
                $('#header-wishlist-count').text(response.wishlist_count);
                
                var data = "";

                // For each product in cart, show quantity controls
                response.cart.items.forEach(function(item) {
                    data += '<div class="product shadow-none">';
                    data += '<div class="product-cart-details">';
                    data += '<h4 class="product-title font-size-normal">';
                    data += `<a href="#">${item.product.name}</a>`;
                    data += '</h4>';
                    data += '<span class="cart-product-info">';
                    data += `<span class="cart-product-qty">${item.quantity}</span>`;
                    data += ` x Rs. ${item.price}`;
                    data += '</span>';
                    data += '</div>';
                    data += '<figure class="product-image-container">';
                    data += '<a href="#" class="product-image border">';
                    if(item.product.images.length > 0) {
                        item.product.images.slice(0, 1).map((image) => {
                            data += `<img src=${image.image_url} alt=${item.product.name} style="width: 60px; height: 60px;" />`;
                        })
                    }
                    data += '</a>';
                    data += '</figure>';
                    data += '<a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>';
                    data += '</div>';


                //    $(`.add-to-cart[data-product-id="${item.product_id}"]`).hide();
                //    $(`.quantity-selector[data-product-id="${item.product_id}"] .quantity-input`).val(item.quantity);
                //    $(`.quantity-selector[data-product-id="${item.product_id}"]`).show();
                });

                $("#dropdown-cart-products").append(data)
            }
        });
    }

    initializeCartItems();

})
