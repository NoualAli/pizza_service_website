<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        .ticket {
            position: relative;
            width: 155px;
            max-width: 155px;
        }

        .column {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid black
        }

        .column.unbordered {
            border: none;
        }

        .is-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 3px 0;
        }

        .header {
            width: 100%;

        }

        .description {
            width: 75px;
            max-width: 75px;
        }

        .quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
            font-weight: bold;
        }

        .price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        .divider {
            border: 1px solid black;
            margin: 5px 0;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .border-top {
            border-top: 1px solid black
        }

        .border-bottom {
            border-bottom: 1px solid black
        }
    </style>
</head>

<body>
    <div class="ticket">
        <img src="{{ asset('assets/brand.png') }}" height="45" alt="Logo">

        {{-- Order details --}}
        <p class="centered border-bottom">
            <b>Order #{{ $entry->id }}</b>
            <br>
            {{ $entry->restaurant->name }}
            <br>
            {{ $entry->created_at }}
        </p>
        <p class="centered border-bottom">
            <b>Asiakas:</b>
            <br>
            <b>{{ $entry->full_name }}</b>
            <br>
            <b>{{ $entry->phone }}</b>
            <br>
            @if ($entry->order_type == 'Delivery')
                <b>Osoite:</b>
                <br>
                <b>{{ $entry->address }}</b>
                <br>
            @endif
            <b>{{ $entry->payment_method }}</b>
        </p>

        {{-- Order lines --}}
        @foreach ($entry->lines as $line)
            <div class="column unbordered">
                <div class="header is-row">
                    <span class="quantity">
                        x{{ $line->quantity }}
                    </span>
                    <div class="description">
                        {{ $line->product->name }}
                        <br>
                        {{ $line->size }}
                    </div>
                    <div class="price">
                        {{ $line->price }}
                    </div>
                </div>
                <div class="extras is-row">
                    @php
                        $extras = json_decode($line->extras, true);
                    @endphp
                    @if (count($extras))
                        @foreach ($extras as $name => $price)
                            <span class="quantity"></span>
                            <span class="description">
                                {{ $name }}
                            </span>
                            <span class="price">
                                {{ $price ? $price . ' ' . EURO_SIGN : '-' }}
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach

        {{-- Order prices --}}
        <div class="is-row border-top border-bottom">
            <span>
                <b>Subtotal</b>
            </span>
            <span>
                {{ $entry->subtotal }}
            </span>
        </div>
        <div class="is-row border-bottom">
            <span>
                <b>VAT tax (14%)</b>
            </span>
            <span>
                {{ $entry->tax }}
            </span>
        </div>
        <div class="is-row border-bottom">
            <span>
                <b>Delivery fee</b>
            </span>
            <span>
                {{ $entry->delivery_fee }}
            </span>
        </div>
        <div class="is-row border-bottom">
            <span>
                <b>Total</b>
            </span>
            <span>
                {{ $entry->total }}
            </span>
        </div>
        <p class="centered">
            Thanks for your purchase!
            <br>pizzaservice.fi
        </p>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
