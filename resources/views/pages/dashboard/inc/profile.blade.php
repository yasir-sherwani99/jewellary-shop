<form method="POST" action="{{ route('user.update', $user->id) }}" class="needs-validation" novalidate>
    @method('PUT')
    @csrf
    <div class="row mb-1">
        <div class="col-sm-6">
            <label for="first_name">First Name *</label>
            <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" class="form-control mb-0" required />
            <div class="invalid-feedback">
                This is a required field.
            </div>
        </div><!-- End .col-sm-6 -->

        <div class="col-sm-6">
            <label for="last_name">Last Name *</label>
            <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" class="form-control mb-0" required />
            <div class="invalid-feedback">
                This is a required field.
            </div>
        </div><!-- End .col-sm-6 -->
    </div><!-- End .row -->

    <div class="row">
        <div class="col-sm-12">
            <label for="email">Email *</label>
            <input type="email" id="email" class="form-control" value="{{ $user->email }}" readonly />
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-12">
            <label for="phone">Phone </label>
            <input type="phone" id="phone" name="phone" class="form-control" value="{{ $user->phone }}" />
        </div>
    </div>

    <button type="submit" class="btn btn-outline-primary-2">
        <span>UPDATE CHANGES</span>
        <i class="icon-long-arrow-right"></i>
    </button>
</form>