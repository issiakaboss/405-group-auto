<?php

return [
    'title' => 'Orders Management',
    'subtitle' => 'Validate, update, or cancel customer orders.',
    'order_details' => 'Order Details #:id',
    'back_to_list' => 'Back to Orders List',
    'columns' => [
        'id_date' => 'ID / Date',
        'customer' => 'Customer',
        'contact' => 'Contact',
        'total_amount' => 'Total Amount',
        'current_status' => 'Current Status',
        'action' => 'Action',
    ],
    'sections' => [
        'ordered_items' => 'Ordered Items',
        'customer_info' => 'Customer Info',
        'update_status' => 'Update Order Status',
    ],
    'fields' => [
        'quantity' => 'Qty: :qty',
        'total_amount' => 'Total Amount',
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'address' => 'Address',
    ],
    'statuses' => [
        'pending_review' => 'Pending Review',
        'confirmed' => 'Confirmed',
        'shipping' => 'In Transit / Shipping',
        'delivered' => 'Delivered',
        'cancelled' => 'Cancelled',
    ],
    'buttons' => [
        'update_order' => 'Update Order',
    ],
    'empty' => 'No orders recorded yet.',
];