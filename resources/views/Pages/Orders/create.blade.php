    @extends('Layouts.index')
    @section('content') 

    <div class="container-fluid px-md-5">
        <form id="orderForm" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow mb-3 custom-rounded">
                        <div class="card-body">
                            <div class="border border-dark border-3 p-4 custom-rounded">
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <label class="form-label">Customers</label>
                                        <div class="input-group">
                                            <select id="buyerSelect" class="single-select form-select" name="customerId">
                                                <option selected disabled>Choose Customers</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Products</label>
                                        <div class="input-group">
                                            <select id="productSelect" class="single-select form-select">
                                                <option selected disabled>Choose Product</option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id }}" data-code="{{ $product->code }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-id="{{ $product->id }}" data-stock="{{ $product->stock }}">{{ $product->code }} | {{ $product->name }} ${{ $product->price }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="button" id="addBtn" class="btn btn-dark custom-rounded">Add Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow mb-3 custom-rounded">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped border border-dark border-2 rounded" style="width:100%">
                                <thead style="background-color: rgb(19, 16, 16); color:white">
                                    <tr>
                                        <th>No</th>
                                        <th>Customer</th>
                                        <th>Code</th>
                                        <th>Product</th>
                                        <th>Quantity</th> 
                                        <th>Price</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="orderTableBody">
                                </tbody>
                                <tfoot style="background-color: rgb(19, 16, 16); color:white">
                                    <tr>
                                        <th colspan="5" style="text-align: right;">Total Price:</th>
                                        <th><input type="hidden" name="totalPrice" id="totalPriceInput" value="0"><span id="totalPrice">0</span></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>   
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" id="submitBtn" class="btn btn-dark custom-rounded"><i class="bx bx-credit-card"></i> Pay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>    
    </div>



    @push('scripts')
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        document.getElementById('submitBtn').style.display = 'none';

        document.getElementById('addBtn').addEventListener('click', function() {
            let buyer = document.getElementById('buyerSelect');
            let product = document.getElementById('productSelect');
            let selectedProductId = product.value;
            let selectedProductStock = parseInt(product.options[product.selectedIndex].getAttribute('data-stock'));
            if (buyer.value !== '' && !buyer.options[buyer.selectedIndex].disabled && product.value !== '' && !product.options[product.selectedIndex].disabled) {
                let existingRow = findExistingRow(selectedProductId);
                if (existingRow) {
                    let quantityInput = existingRow.querySelector('.quantity-input');
                    let currentQuantity = parseInt(quantityInput.value);
                    if (currentQuantity < selectedProductStock) {
                        quantityInput.value = currentQuantity + 1;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Quantity cannot exceed available stock (' + selectedProductStock + ').'
                        });
                    }
                } else {
                    let orderTable = document.getElementById('orderTableBody');
                    let newRow = orderTable.insertRow();
                    let noOfRows = orderTable.getElementsByTagName('tr').length;
                    newRow.innerHTML = `
                        <td>${noOfRows}</td>
                        <td>${buyer.options[buyer.selectedIndex].text}</td>
                        <td>${product.options[product.selectedIndex].getAttribute('data-code')}</td>
                        <td><input type="hidden" class="form-control productId" name="productId[]" value="${selectedProductId}">${product.options[product.selectedIndex].getAttribute('data-name')}</td>
                        <td><input type="number" name="quantity[]" class="form-control quantity-input" value="1" min="1" max="${selectedProductStock}" /></td>
                        <td>$${product.options[product.selectedIndex].getAttribute('data-price')}</td>
                        <td><button class="btn btn-outline-secondary btn-dark text-white deleteBtn"><i class='bx bxs-trash'></i></button></td>
                    `;
                    newRow.setAttribute('data-id', selectedProductId);
                    newRow.querySelector('.quantity-input').addEventListener('input', function() {
                        updateTotalPrice();
                    });
                    newRow.querySelector('.deleteBtn').addEventListener('click', function() {
                        orderTable.removeChild(newRow);
                        updateTotalPrice();
                        togglePayButtonVisibility();
                    });
                }
                updateTotalPrice();
                togglePayButtonVisibility();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select a buyer and a valid product.'
                });
            }
        });


        function togglePayButtonVisibility() {
            let orderTable = document.getElementById('orderTableBody');
            let submitBtn = document.getElementById('submitBtn');
            if (orderTable.getElementsByTagName('tr').length > 0) {
                submitBtn.style.display = 'block';
            } else {
                submitBtn.style.display = 'none';
            }
        }

        togglePayButtonVisibility();

        function findExistingRow(productId) {
            let rows = document.getElementById('orderTableBody').getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                let rowProductId = rows[i].getAttribute('data-id');
                if (rowProductId === productId) {
                    return rows[i];
                }
            }
            return null;
        }

        function updateTotalPrice() {
            let totalPrice = 0;
            let rows = document.getElementById('orderTableBody').getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                let row = rows[i];
                let priceString = row.getElementsByTagName('td')[5].textContent;
                let price = parseFloat(priceString.replace('$', ''));

                let quantity = parseInt(row.getElementsByTagName('td')[4].getElementsByTagName('input')[0].value);

                totalPrice += price * quantity;
            }

            document.getElementById('totalPriceInput').value = totalPrice.toFixed(2);
            document.getElementById('totalPrice').textContent = '$' + totalPrice.toFixed(2);
        }

        document.getElementById('submitBtn').addEventListener('click', function(event) {
        event.preventDefault();

        let form = document.getElementById('orderForm');
        let formData = new FormData(form);

        let route = '{{ Auth::user()->roleId == 1 ? route("admin.order.store") : route("cashier.order.store") }}';
        $.ajax({
            type: 'POST',
            url: route,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Order is successful. Do you want to print an invoice?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '';
                    } else {
                        $('#orderTableBody').empty();
                        $('#totalPrice').empty();
                        $('#buyerSelect').val('').trigger('change');
                        $('#productSelect').val('').trigger('change');
                        document.getElementById('submitBtn').style.display = 'none';
                        Swal.fire('Cancelled', 'You chose not to print an invoice.', 'info');
                    }
                });

            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error:', errorThrown);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to create order. Please try again.'
                });
            }
        });
    });


    </script>

    @endpush
    @endsection