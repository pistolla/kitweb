<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class MpesaPayment extends Model {
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Password','TransactionType','TransID','TransTime','TransAmount','BusinessShortCode','BillRefNumber','InvoiceNumber','ThirdPartyTransID','MSISDN','FirstName','MiddleName','LastName','OrgAccountBalance','Timestamp','Amount','PartyA','PartyB','PhoneNumber','CallBackURL','AccountReference','TransactionDesc','ResponseCode','ResponseDescription','ResultCode','ResultDesc','MerchantRequestID','CheckoutRequestID','MpesaReceiptNumber','TransactionDate'
    ];

}