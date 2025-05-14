<form method="POST" id="approved-form" class="needs-validation" action="{{ route('admin.orders.process', $order->id) }}" onSubmit="return confirm('Are you sure you want to process this order?');" novalidate>    
    @csrf          
    @method('PUT')
    <div class="mb-3 row">
        <!-- <label class="col-sm-2 col-form-label text-end">Select</label> -->
        <div class="col-sm-8">
            <select name="status" class="form-select">
                <option value="{{ $order->status }}">{{ ucfirst($order->status) }}</option>
                <option value="pending">Pending</option>
                <option value="shipped">Shipped</option>
                <option value="cancelled">Cancelled</option>
                </select>
        </div>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
