@extends('layouts.admin_app')

@section('style')

<link href="{{ asset('admin-assets/plugins/image-uploader/src/image-uploader.css') }}" rel="stylesheet" type="text/css" />
<style>

    /* Container styling */
    .image-uploader {
        border: 2px dashed #cbd5e0;
        border-radius: 8px;
        background-color: #f8fafc;
        min-height: 200px;
        padding: 20px;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        cursor: pointer !important;
    }

    .upload-text .iui-cloud-upload {
        font-size: 40px;
        color: #63b3ed;
        margin-bottom: 10px;
    }

    .upload-text span {
        color: #4a5568;
        font-size: 16px;
        margin: 0;
    }

</style>

@endsection

@section('content')

    @include('layouts.partials.admin._breadcrumb', ['title' => "Edit Product", 'section' => "Products", 'page' => 'Edit'])

    @if(session()->has('success'))
        <div class="alert alert-success border-0 alert-dismissible fade show" role="alert">
            <strong>Well done!</strong> {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header bg-light">
                    <h4 class="card-title">Edit Product</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <form method="POST" class="needs-validation" enctype="multipart/form-data" action="{{ route('admin.products.update', $product->id) }}" novalidate>    
                        @csrf 
                        @method('PUT')         
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="name" class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="name" 
                                    name="name" 
                                    value="{{ $product->name }}" 
                                    placeholder="Enter product name" 
                                    required 
                                />
                                <div class="invalid-feedback">
                                    Product name is a required field.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="category_id" class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="{{ $product->category_id }}">{{ $product->category->name }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Product category is a required field.
                                </div>
                            </div>
                        </div>      
                        <div class="row my-3">
                            <div class="col-6">
                                <label for="price" class="form-label fw-bold">Price <span class="text-danger">*</span></label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="price" 
                                    name="price" 
                                    value="{{ $product->price }}" 
                                    step=".01" 
                                    placeholder="Enter product price" 
                                    required 
                                />
                                <div class="invalid-feedback">
                                    Product new price is a required field.
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="discount_price" class="form-label fw-bold">Discount Price</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="discount_price" 
                                    name="discount_price" 
                                    value="{{ $product->discount_price }}" 
                                    step=".01" 
                                    placeholder="Enter product discount price" 
                                />
                                <small class="form-text text-muted">Leave blank if no discount price</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="stock_qty" class="form-label fw-bold">Stock Qty</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="stock_qty" 
                                    name="stock_qty" 
                                    value="{{ $product->stock_quantity }}" 
                                    value="1" 
                                    placeholder="Enter product stock qty" 
                                />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control tinymce_editor" id="description" name="description" rows="4" placeholder="Product Description" required>{{ $product->description }}</textarea>
                                <div class="invalid-feedback">
                                    Product description is a required field.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="additional_info" class="form-label fw-bold">Additional Info</label>
                                <textarea class="form-control tinymce_editor" id="additional_info" name="additional_info" rows="4" placeholder="Product Additional Information">{{ $product->additional_info }}</textarea>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="images" class="form-label fw-bold">Product Images <span class="text-danger">*</span></label>
                                <div class="input-images-1"></div>
                                <small class="form-text text-muted">Max 5 images allowed, each image should not exceed 2MB</small>
                                <div class="invalid-feedback">
                                    Product images is a required field.
                                </div>
                            </div>
                        </div>

                        @if(count($product->images) > 0)
                            @foreach($product->images as $image)
                                <div class="row" id="prod-image-{{ $image->id }}">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <div class="media">
                                                            <img 
                                                                class="d-flex align-self-center me-3 thumb-lg rounded object-fit-cover" 
                                                                src="{{ asset($image->image_url) }}" 
                                                                alt="{{ $product->name }}"
                                                            />
                                                            <div class="media-body align-self-center">
                                                                <h4 class="mt-0 mb-1 font-14">{{ $image->image_url }}</h4>                                                    
                                                            </div><!--end media-body-->
                                                        </div><!--end media-->
                                                    </div><!--end col-->
                                                    <div class="col-sm-2 align-self-center">
                                                        <div class="text-end">
                                                            <a 
                                                                href="javascript:;" 
                                                                onclick="deleteImage({{ $image->id }})"
                                                            >
                                                                <i class="las la-trash-alt text-secondary font-18"></i>
                                                            </a>
                                                        </div>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-check form-switch form-switch-success">
                                    <input 
                                        class="form-check-input" 
                                        name="active" 
                                        type="checkbox" 
                                        id="active" 
                                        {{ $product->is_active == 1 ? 'checked' : '' }} 
                                    />
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                            </div>
                        </div>          
                        <div class="row mt-2">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success">Update Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

<script src="{{ asset('admin-assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '.tinymce_editor',
        menubar: false,
        statusbar: false,
        readonly: false,
        height: 200,
        plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'table emoticons template paste help'
        ],
        toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | ' + ' | link image | ' +
            'bullist numlist | ' + 'emoticons',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>

<script src="{{ asset('admin-assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/image-uploader/src/image-uploader.js') }}"></script>
<script>

    // let prodImages = "{{-- $prodImages --}}";
    // let prodImagess = JSON.parse(prodImages.replace(/&quot;/g, '"'));

    $(function () {
        $('.input-images-1').imageUploader({
         //   preloaded: prodImagess,
            imagesInputName: 'images',
            maxFiles: 5,
            extensions: ['.jpg', '.jpeg', '.png', '.gif', '.svg'],
            maxSize: 2 * 1024 * 1024
        });
    });

</script>

<script src="{{ asset('admin-assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>

    function deleteImage(imageId)
    {
        let csrf = "{{ csrf_token() }}";
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then(function(result) {
            if (result.isConfirmed) {
                fetch(`/admin/product-image/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-Token": csrf,
                        "Content-Type": "application/json"
                    }
                })
                .then(res => res.json())
                .then(data => { 
                    document.getElementById(`prod-image-${data.image_id}`).style.display = 'none';
                    Swal.fire(
                        'Deleted!',
                        data.message,
                        data.success ? 'success' : 'error'
                    )
                })
                .catch(error => console.log(error))   
            }
        })
    }
</script>

@endsection