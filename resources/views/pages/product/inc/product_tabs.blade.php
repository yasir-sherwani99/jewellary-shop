<div class="product-details-tab">
    <ul class="nav nav-pills justify-content-center" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
            <div class="product-desc-content">
                <h3>Product Description</h3>
                {{ $product->description }}
            </div><!-- End .product-desc-content -->
        </div><!-- .End .tab-pane -->
        <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
            <div class="product-desc-content">
                <h3>Additional Information</h3>
                @if(empty($product->additional_info))
                    <p>No additional information available.</p>
                @else
                    {{ $product->additional_info }}
                @endif
            </div><!-- End .product-desc-content -->
        </div><!-- .End .tab-pane -->
        <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
            <div class="product-desc-content">
                <h3>Delivery & returns</h3>
                <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
            </div><!-- End .product-desc-content -->
        </div><!-- .End .tab-pane -->
        <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
            <div class="reviews">
                <h3>Reviews (2)</h3>
                <div class="review">
                    <div class="row no-gutters">
                        <div class="col-auto">
                            <h4><a href="#">Samanta J.</a></h4>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                            </div><!-- End .rating-container -->
                            <span class="review-date">6 days ago</span>
                        </div><!-- End .col -->
                        <div class="col">
                            <h4>Good, perfect size</h4>

                            <div class="review-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                            </div><!-- End .review-content -->

                            <div class="review-action">
                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                            </div><!-- End .review-action -->
                        </div><!-- End .col-auto -->
                    </div><!-- End .row -->
                </div><!-- End .review -->

                <div class="review">
                    <div class="row no-gutters">
                        <div class="col-auto">
                            <h4><a href="#">John Doe</a></h4>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                            </div><!-- End .rating-container -->
                            <span class="review-date">5 days ago</span>
                        </div><!-- End .col -->
                        <div class="col">
                            <h4>Very good</h4>

                            <div class="review-content">
                                <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                            </div><!-- End .review-content -->

                            <div class="review-action">
                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                            </div><!-- End .review-action -->
                        </div><!-- End .col-auto -->
                    </div><!-- End .row -->
                </div><!-- End .review -->
            </div><!-- End .reviews -->
        </div><!-- .End .tab-pane -->
    </div><!-- End .tab-content -->
</div><!-- End .product-details-tab -->