<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Customer Name',
            'Email',
            'Total Amount',
            'Status',
            'Created Date',
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->name,
            $order->email,
            number_format($order->total, 2),
            ucfirst($order->status),
            $order->created_at->format('d-m-Y'),
        ];
    }
}