@php($user = $order->user)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111827;">
    <h1 style="color:#10b981;">Thanks for ordering with Essen, {{ $user->name }}!</h1>
    <p>Your order #{{ $order->id }} has been received. Here's a summary of what you ordered:</p>
    <table style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th align="left" style="border-bottom:1px solid #e5e7eb; padding:8px;">Item</th>
                <th align="left" style="border-bottom:1px solid #e5e7eb; padding:8px;">Quantity</th>
                <th align="left" style="border-bottom:1px solid #e5e7eb; padding:8px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td style="padding:8px; border-bottom:1px solid #f3f4f6;">{{ $item->foodItem->name }}</td>
                <td style="padding:8px; border-bottom:1px solid #f3f4f6;">{{ $item->quantity }}</td>
                <td style="padding:8px; border-bottom:1px solid #f3f4f6;">${{ number_format($item->subtotal, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p style="margin-top:16px; font-weight:bold;">Total: ${{ number_format($order->total_price, 2) }}</p>
    <p>We'll notify you once your food is on the way. Enjoy!</p>
</body>
</html>
