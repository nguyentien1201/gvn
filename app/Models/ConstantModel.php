<?php

namespace App\Models;

class ConstantModel
{
    public static $PAGINATION = 20;

    public static $TYPE_MESSAGE = [
       'SMS' => 0,
       'MMS' => 1
    ];
    public static $REVIEW_TYPE = [
        'nail_supply' => 0,
        'google' => 1,
        'facebook' => 2,
        'yelp' => 3,
    ];

    const REVIEW_TAGS = [
        'review_link' => 'Review link',
        'first_name' => 'First name',
        'last_name' => 'Last name',
        'phone' => 'Phone',
        'company' => 'Company',
        'address' => 'Address',
    ];

    public static $STATUS = [
        0 => 'New',
        1 => 'Payment',
        2 => 'In progress',
        3 => 'Processed',
        4 => 'Completed',
        5 => 'Cancel'
    ];

    public static $STATUS_WOOCOMMERCE = [
        0 => 'on-hold',
        1 => 'pending',
        2 => 'processing',
        4 => 'completed',
        5 => 'cancelled'
    ];

    public static $STATUS_BACKGROUND = [
        0 => 'secondary',
        1 => 'primary',
        2 => 'info',
        3 => 'warning',
        4 => 'success',
        5 => 'danger'
    ];

    public static $STATUS_ALERT = [
        0 => 'To do',
        1 => 'Alerted',
        2 => 'Read'
    ];

    public static $STATUS_ALERT_BACKGROUND = [
        0 => 'secondary',
        1 => 'primary',
        2 => 'success'
    ];

    const ROLES = [
        'admin' => 1,
        'staff' => 2
    ];

    const PROMOTION_STATUS = [
        'reserve' => 0,
        'done' => 1
    ];

    const PROMOTION_STATUS_BACKGROUND = [
        0 => 'secondary',
        1 => 'success',
    ];

    const ORDER_TAGS = [
        'title' => 'Title',
        'first_name' => 'First name',
        'last_name' => 'Last name',
        'phone_number' => 'Phone Number',
        'email' => 'Email',
        'address' => 'Address',
        'note' => 'Note'
    ];
    const GROUP = [
        0 => 'Indices Future',
        1 => 'Commodities',
        2 => 'Forex',
        3 => 'Crypto',
    ];

}
