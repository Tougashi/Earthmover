<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/image/logo/logo-white.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/image/logo/logo-white.png') }}">
    
    {{-- CSS STYLE  --}}
    <link rel="stylesheet" href="{{ asset('/assets/plugins/Bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/BoxIcons/css/boxicons.css') }}">
    <style>
        #invoice {
            padding: 0;
        }

        .invoice {
            margin-left: auto;
            margin-right: auto;

            background-color: #fff;
            width: 90%;
            max-width: 600px;
            padding: 15px;
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #0e0e18;
            text-align: left; /* Mengubah posisi header ke kiri */
        }

        .invoice .company-details {
            text-align: right; /* Mengubah posisi detail perusahaan ke kiri */
        }

        .invoice .contacts {
            margin-bottom: 20px;
            text-align: left; /* Mengubah posisi kontak ke kiri */
        }

        .invoice .invoice-to {
            text-align: left;
        }

        .invoice .invoice-details {
            text-align: right; /* Mengubah posisi detail invoice ke kiri */
        }

        .invoice main {
            padding-bottom: 50px;
            text-align: left; /* Mengubah posisi konten utama ke kiri */
        }

        .invoice main .thanks {
            margin-top: 60px;
            font-size: 1.5em; /* Mengurangi ukuran teks terima kasih */
            margin-bottom: 30px; /* Mengurangi margin bawah untuk lebih sesuai dengan email */
            text-align: center;
        }

        .invoice main .notices .notice {
            font-size: 1em; /* Mengurangi ukuran teks pemberitahuan */
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 10px; /* Mengurangi margin bottom agar lebih kompak */
        }

        .invoice table td,
        .invoice table th {
            padding: 8px; /* Mengurangi padding agar lebih kompak */
            background: #eee;
            border-bottom: 1px solid #fff;
            font-size: 14px; /* Mengurangi ukuran teks agar lebih kecil */
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
        }

        .invoice table td h2 {
            margin: 0;
            font-weight: 600;
            color: #0e0e18;
            font-size: 1.2em;
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1em; /* Mengurangi ukuran teks agar lebih kecil */
        }

        .invoice table .no {
            color: #fff;
            font-size: 0.8em;
            background: #0e0e18;
        }

        .invoice table .unit {
            background: #ddd;
        }

        .invoice table .total {
            background: #0e0e18;
            color: #fff;
        }

        .invoice table tbody tr:last-child td {
            border: none;
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 8px 20px; /* Mengurangi padding agar lebih kompak */
            font-size: 1em; /* Mengurangi ukuran teks agar lebih kecil */
            border-top: 1px solid #aaa;
        }

        .invoice table tfoot tr:first-child td {
            border-top: none;
        }

        .invoice table tfoot tr:last-child td {
            color: #0e0e18;
            font-size: 1.2em;
            border-top: 1px solid #0e0e18;
        }

        .invoice table tfoot tr td:first-child {
            border: none;
        }


        .invoice .footer {
            width: 100%;
            text-align: center;
            color: #000000;
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
        }

        @media print {
            .invoice {
                font-size: 11px!important;
                overflow: hidden!important;
                width: 210mm;
                height: 148mm;
                position: static;
                transform: none;
                left: auto;
                top: auto;
            }

            .invoice footer {
                page-break-after: always;
            }

            .invoice > div:last-child {
                page-break-before: always;
            }
        }
        .text-center{
            text-align: center
        }
        .text-uppercase{
           text-transform: uppercase;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-wrapper">
            <div class="invoice">
                <header>
                    <div class="row">
                        <div class="col">
                                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                    width="80px" height="80px" viewBox="0 0 130.000000 130.000000"
                                    preserveAspectRatio="xMidYMid meet">
                                    <g transform="translate(0.000000,130.000000) scale(0.100000,-0.100000)"
                                    fill="#000000" stroke="none">
                                    <path d="M640 1130 c0 -33 4 -50 13 -51 132 -6 249 -68 331 -175 148 -194 98
                                    -488 -107 -624 -200 -134 -471 -81 -603 117 -41 61 -74 156 -74 209 l0 34 -50
                                    0 c-48 0 -50 -1 -50 -27 0 -50 29 -152 61 -215 72 -142 235 -260 394 -284 30
                                    -5 137 -5 165 0 99 16 212 76 291 155 187 188 211 467 56 683 -87 123 -219
                                    199 -384 222 l-43 6 0 -50z"/>
                                    <path d="M572 1020 c-215 -31 -368 -267 -308 -475 41 -138 138 -235 271 -270
                                    91 -23 95 -22 95 30 0 40 -3 45 -25 50 -14 3 -37 8 -52 11 -44 9 -118 61 -148
                                    104 -38 54 -54 106 -55 171 0 74 23 139 71 192 52 60 116 89 204 93 61 3 78 0
                                    132 -27 91 -44 150 -124 161 -216 l5 -43 44 0 c53 0 59 11 43 82 -17 73 -44
                                    123 -97 179 -88 94 -212 137 -341 119z"/>
                                    <path d="M640 826 c0 -42 2 -45 35 -56 40 -13 82 -62 91 -107 4 -20 -1 -46
                                    -14 -75 -48 -108 -203 -102 -242 10 -14 41 -16 42 -57 42 -41 0 -43 -1 -43
                                    -30 0 -68 84 -169 153 -185 50 -12 119 -8 157 7 146 62 189 249 82 361 -31 33
                                    -112 77 -142 77 -17 0 -20 -6 -20 -44z"/>
                                    </g>
                                    </svg>
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
                            <h3 class="invoice-id text-uppercase">INVOICE CODE: #{{ $order->code }}</h3>
                            <div class="date">Date of Invoice: {{ \Carbon\Carbon::parse($order->created_at)->format('l, j F Y') }}</div>
                        </div>
                    </div>
                   <div class="table-responsive">
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
                                <td><h2>$<span style="text-decoration: underline">{{ $order->totalPrice }}</span></h2></td>
                            </tr>
                        </tfoot>

                    </table>
                   </div>
                    <div class="text-center ms-auto mx-auto footer"><h1>Thank you!</h1></div>
                </main>
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
