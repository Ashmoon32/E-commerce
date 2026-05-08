@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-light mb-6">All Orders</h2>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3 font-normal">Order ID</th>
                    <th class="text-left p-3 font-normal">Customer</th>
                    <th class="text-left p-3 font-normal">Total</th>
                    <th class="text-left p-3 font-normal">Status</th>
                    <th class="text-left p-3 font-normal">Payment</th>
                    <th class="text-left p-3 font-normal">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">#{{ $order->id }}</td>
                        <td class="p-3">{{ $order->user->name }}<br><span
                                class="text-xs text-gray-500">{{ $order->user->email }}</span></td>
                        <td class="p-3">${{ number_format($order->total, 2) }}</td>
                        <td class="p-3">
                            <span
                                class="px-2 py-0.5 text-xs rounded {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="p-3 text-xs">
                            {{ $order->payment_method ? ucfirst(str_replace('_', ' ', $order->payment_method)) : '—' }}</td>
                        <td class="p-3 text-sm">{{ $order->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
@endsection