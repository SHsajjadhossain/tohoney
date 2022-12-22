<table>
    <thead>
    <tr>
        <th>Cart Total</th>
        <th>Discount Total</th>
        <th>Sub Total</th>
        <th>Grand Total</th>
        <th>Payment Option</th>
        <th>Payment Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->cart_total }}</td>
            <td>{{ $invoice->discount_total }}</td>
            <td>{{ $invoice->sub_total }}</td>
            <td>{{ $invoice->grand_total }}</td>
            <td>
                @if ($invoice->payment_option == 1)
                    Cash On Delivery
                @else
                    Online Payment
                @endif
            </td>
            <td>
                @if ($invoice->payment_status == 0)
                    Not Paid Yet
                @else
                    Paid
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
