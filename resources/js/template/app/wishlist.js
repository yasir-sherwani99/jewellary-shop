import { showToast } from '../../utils/toast';

$(document).ready(function() {
    'use strict';

    // helper function to get CSRF token
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').content;
    }

    $('.add-to-wishlist').on('click', function (e) {
        e.preventDefault();

        const $button = $(this);
        const productId = $button.data('product-id');
        
        if (window.isAuthenticated == 'false') {
            $('#signin-modal').modal('show'); 
            return;
        }
    
        $button.addClass('disabled');
        $button.find('.wishlist-text').text('Adding...');

        $.ajax({
            url: '/wishlists/toggle',
            method: 'POST',
            data: {
                product_id: productId,
                _token: getCsrfToken()
            },
            success: function(response) {
                if (response.success) {
                    if (response.status === 'added') {
                        showToast('Product added to your wishlist successfully', 'success');
                    } else {
                        showToast('Product removed from your wishlist successfully', 'success');
                    }

                    $('#header-wishlist-count').text(response.wishlist_count);
                }
            },
            error: function(xhr) {
                showToast('Error adding product to wishlist', 'error');
            },
            complete: function() {
               $button.removeClass('disabled');
               $button.find('.wishlist-text').text('Add to Wishlist');
            }
        });
    });

    // remove item from cart
    $('.wishlist-items').on('click', '.remove-wishlist-item', function(e) {
        e.preventDefault();
        const productId = $(this).data('product-id');
        let wishlistItem = $(this).closest('.wishlist-item');
      //  let productName = cartItem.find('h3').text();
        
        if (confirm(`Are you sure you want to remove this product from your wishlist?`)) {
            $.ajax({
                url: `/wishlists/remove/`,
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: getCsrfToken()
                },
                success: function(response) {
                    if (response.success) {

                        wishlistItem.remove();
                        
                        $('#header-wishlist-count').text(response.wishlist_count);
                        
                        // Update cart count
                        updateCartCount(response.count, response.total);
                        
                        // Show success message
                        showToast(response.message, 'success');
                    }
                },
                error: function(xhr) {
                    showToast('Error removing product from wishlist', 'error');
                }
            });
        }            
    });

});