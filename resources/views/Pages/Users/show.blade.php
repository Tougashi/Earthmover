<div class="card custom-rounded mb-4">
    <div class="card-body">
        <form id="productForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-body mt-4">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="border border-dark border-2 p-4 custom-rounded">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control border-dark border-2" id="inputEmail" value="{{ auth()->user()->email }}" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="inputUsername" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control border-dark border-2" id="inputUsername" value="{{ auth()->user()->username }}" readonly>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="button" id="submitBtn" class="btn btn-dark custom-rounded">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" readonly/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" value="john@example.com" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" value="(239) 816-9029" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" value="(320) 380-4539" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" value="Bay Area, San Francisco, CA" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                        <input type="button" class="btn btn-primary px-4" value="Save Changes" />
                    </div>
                </div>
            </div>
        </div>
    </div>