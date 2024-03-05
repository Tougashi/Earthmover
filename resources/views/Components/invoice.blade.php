<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/image/logo/logo-white.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/image/logo/logo-white.png') }}">
    
    {{-- CSS STYLE  --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/Bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/BoxIcons/css/boxicons.css') }}">
</head>
<body>
    <div class="container">
        <div class="invoice">
            <div style="min-width: 600px; height:100%">
                <header>
                    <div class="row">
                        <div class="col">
                                <img src="{{ asset('assets/image/logo/logo.png') }}" width="80" alt="" />
                        </div>
                        <div class="col company-details">
                            <h2 class="name">Earthmover</h2>
                            <div>Indonesia</div>
                            <div>+62 8587 7171 626</div>
                            <div>earthmover.eyes@gmail.com</div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">INVOICE TO:</div>
                            <h2 class="to">{{ $order->customer->name }}</h2>
                            <div class="address">{{ $order->customer->address }}</div>
                            <div class="address">{{ $order->customer->email }}</div>
                            <div class="address">{{ $order->customer->contact }}</div>
                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id text-uppercase">INVOICE CODE : #{{ $order->code }}</h1>
                            <div class="date">Date of Invoice: {{ \Carbon\Carbon::parse($order->created_at)->format('l, j F Y') }}</div>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">DESCRIPTION</th>
                                <th class="text-right">QUANTITY</th>
                                <th class="text-center">PRICE</th>
                                <th class="text-center">SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @php
                                $totalQuantity = 0;
                                $grandTotal = 0; 
                            @endphp
                            @foreach (json_decode($order->productId) as $key => $productId)
                                @php
                                    $product = $products->where('id', $productId)->first();
                                    $quantity = json_decode($order->quantity)[$key];
                                    $totalQuantity += $quantity;
                                    $subtotal = $product->price * $quantity;
                                    $grandTotal += $subtotal;
                                @endphp
                                <tr>
                                    <td class="no text-center">{{ $loop->iteration }}</td>
                                    <td class="text-left">
                                        <h2>{{ $product->name }} ({{ $product->category->name }})</h2>
                                        {{-- {{ $product->description }} --}}
                                    </td>
                                    <td class="qty text-center">{{ $quantity }}</td>
                                    <td class="unit text-center">${{ $product->price }}</td>
                                    <td class="total text-center">${{ $subtotal }}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>                        
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">TOTAL QUANTITY</td>
                                <td>{{ $totalQuantity }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2"><h2>GRAND TOTAL</h2></td>
                                <td><h2>$<span class="text-decoration-underline">{{ $order->totalPrice }}</span></h2></td>
                                
                            </tr>
                        </tfoot>

                    </table>
                    <div class="text-center ms-auto mx-auto footer"><h1>Thank you!</h1></div>
                </main>
               
                <footer></footer>
            </div>
            <div></div>
        </div>
    </div>
    {{-- JS SCRIPT  --}}
    <script src="{{ asset('/assets/plugins/JQuery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/Bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/Bootstrap/js/popper.min.js') }}"></script>   
    <script src="{{ asset('/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        // Function to print the invoice when the page is loaded
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
