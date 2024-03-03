@extends('Layouts.index')
@section('content') 

<div class="container-fluid px-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-3 custom-rounded">
                <div class="card-body">
                    <div class="border border-dark border-3 p-4 custom-rounded">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">Buyer</label>
                                <div class="input-group">
                                    <select id="buyerSelect" class="single-select form-select">
                                        <option selected disabled>Choose Buyer</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
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
                                <th>Buyer</th>
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
                                <th id="totalPrice">0</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>   
                    <div class="col-12">
                        <div class="d-grid">
                            <button type="button" id="submitBtn" class="btn btn-dark custom-rounded"><i class="bx bx-credit-card"></i> Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
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
            var buyer = document.getElementById('buyerSelect');
            var product = document.getElementById('productSelect');
            var selectedProductId = product.value;
            if (buyer.value !== '' && !buyer.options[buyer.selectedIndex].disabled && product.value !== '' && !product.options[product.selectedIndex].disabled) {
                var existingRow = findExistingRow(selectedProductId);
                if (existingRow) {
                    var quantityInput = existingRow.querySelector('.quantity-input');
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                } else {
                    var orderTable = document.getElementById('orderTableBody');
                    var newRow = orderTable.insertRow();
                    var noOfRows = orderTable.getElementsByTagName('tr').length;

                    newRow.innerHTML = `
                        <td>${noOfRows}</td>
                        <td>${buyer.options[buyer.selectedIndex].text}</td>
                        <td>${product.options[product.selectedIndex].getAttribute('data-code')}</td>
                        <td>${product.options[product.selectedIndex].getAttribute('data-name')}</td>
                        <td><input type="number" class="form-control quantity-input" value="1" /></td>
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
            var orderTable = document.getElementById('orderTableBody');
            var submitBtn = document.getElementById('submitBtn');
            if (orderTable.getElementsByTagName('tr').length > 0) {
                submitBtn.style.display = 'block'; 
            } else {
                submitBtn.style.display = 'none'; 
            }
        }

        function findExistingRow(productId) {
            var rows = document.getElementById('orderTableBody').getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                var rowProductId = rows[i].getAttribute('data-id');
                if (rowProductId === productId) {
                    return rows[i];
                }
            }
            return null;
        }

        function updateTotalPrice() {
            var totalPrice = 0;
            var rows = document.getElementById('orderTableBody').getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var priceString = row.getElementsByTagName('td')[5].textContent;
                var price = parseFloat(priceString.replace('$', ''));

                var quantity = parseInt(row.getElementsByTagName('td')[4].getElementsByTagName('input')[0].value);

                totalPrice += price * quantity;
            }

            document.getElementById('totalPrice').textContent = '$' + totalPrice.toFixed(2);
        }

    </script>
@endpush
@endsection