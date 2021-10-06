<?php
namespace App\Http\Lib;

use Illuminate\Support\Facades\Log;

class MpesaPayments 
{
    const Consumer_Key = 'T17ylo4YGMhQWMxG56kYnAZctAR3AVfn';
    const Consumer_Secret = 'zBORtg98xsYAK377';
    const Public_Key = '';
    const Password = '';

    public function getCredentials($path, $password)
    {
        Log::info("getCredentials " . $path . " - ". $password);
        $publicKey = isset($path)?$path:uniqid();
        $plaintext = isset($password)?$password:uniqid();

        openssl_public_encrypt($plaintext, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

        echo base64_encode($encrypted);
    }

    public function getDarajaAccessToken($apiConfig)
    {
        Log::info("getDarajaAccessToken " . $apiConfig);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $user = $apiConfig->public_key;
        $pwd = $apiConfig->secret;
        $headers = array(
            'Content-Type:application/json',
            'Authorization: Basic ' . base64_encode("$user:$pwd")
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return = curl_exec($ch);
        curl_close($ch);
        Log::info("getDarajaAccessToken " . $return);
        $response = json_decode($return, true);
        
        if (isset($response['access_token'])) {
            $apiConfig->access_token = $response['access_token'];
            $apiConfig->refresh_time = date('Y-m-d H:i:s', time() + $response['expires_in']);
            $apiConfig->update();
            return $response['access_token'];
        }
        return null;

    }


    public function c2bPayment()
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ACCESS_TOKEN')); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => ' ',
            'ResponseType' => ' ',
            'ConfirmationURL' => 'http://ip_address:port/confirmation',
            'ValidationURL' => 'http://ip_address:port/validation_url'
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }

    public function reverseTransaction()
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ACCESS_TOKEN')); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'CommandID' => ' ',
            'Initiator' => ' ',
            'SecurityCredential' => ' ',
            'CommandID' => 'TransactionReversal',
            'TransactionID' => ' ',
            'Amount' => ' ',
            'ReceiverParty' => ' ',
            'RecieverIdentifierType' => '4',
            'ResultURL' => 'https://ip_address:port/result_url',
            'QueueTimeOutURL' => 'https://ip_address:port/timeout_url',
            'Remarks' => ' ',
            'Occasion' => ' '
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }
    

    public function lipanampesastkpush($data, $transaction, $deposit)
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        Log::info("lipanampesastkpush " . print_r($data,true));

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $data['token'])); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $data["BusinessShortCode"],
            'Password' => $data["Password"],
            'Timestamp' => $data["Timestamp"],
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $data["Amount"],
            'PartyA' => $data["PartyA"],
            'PartyB' => $data["PartyB"],
            'PhoneNumber' => $data["PhoneNumber"],
            'CallBackURL' => $data["CallBackURL"],
            'AccountReference' => $data["AccountReference"],
            'TransactionDesc' => $data["TransactionDesc"]
        );

        $data_string = json_encode($curl_post_data);
        Log::info("lipanampesastkpush request " . $data_string);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        Log::info("lipanampesastkpush response " . $curl_response);
        $response = json_decode($curl_response, true);
        if (isset($response['ResponseCode'])) {
             Log::info("lipanampesastkpush updated ");
             $transaction['MerchantRequestID'] = $response['MerchantRequestID'];
             $transaction['CheckoutRequestID'] = $response['CheckoutRequestID'];
             $transaction['ResponseCode'] = $response['ResponseCode'];
             $transaction['ResponseDescription'] = $response['ResponseDescription'];
             $transaction->update();
            if($response['ResponseCode'] == 0)
            {
                $deposit['status'] = 2;
                $deposit->update();
            }
            
        }
    }

    public function callback()
    {
        Log::info("callback() write to file ");
        $postData = file_get_contents('php://input');
        //perform your processing here, e.g. log to file....
        $file = fopen(storage_path("logs/log.txt"), "w"); //url fopen should be allowed for this to occur
        if (fwrite($file, $postData) === FALSE) {
            Log::error("Error: no data written");
        }

        fwrite($file, "\r\n");
        fclose($file);

        echo '{"ResultCode": 0, "ResultDesc": "The service was accepted successfully", "ThirdPartyTransID": "1234567890"}';

    }

    public function authenticate()
    {
        Log::info("authenticate() write to file ");
        $postData = file_get_contents('php://input');
        //perform your processing here, e.g. log to file....
        $file = fopen(storage_path("logs/log.txt"), "w"); //url fopen should be allowed for this to occur
        if (fwrite($file, $postData) === FALSE) {
            Log::error("Error: no data written");
        }

        fwrite($file,"\r\n");
        fclose($file);

        echo '{"ResultCode": 0, "ResultDesc": "The service was accepted successfully", "ThirdPartyTransID": "1234567890"}';

    }
}