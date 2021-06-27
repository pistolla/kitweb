<?php

class DarajaApi {
    const Consumer_Key = 'T17ylo4YGMhQWMxG56kYnAZctAR3AVfn';
    const Consumer_Secret = 'zBORtg98xsYAK377';
    const Public_Key = '';
    const Password = '';

    public function getCredentials()
    {
        $publicKey = "PATH_TO_CERTICATE_FILE";
        $plaintext = "YOUR_PASSWORD";

        openssl_public_encrypt($plaintext, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

        echo base64_encode($encrypted);
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

    public function lipanampesastkpush()
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ACCESS_TOKEN')); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => ' ',
            'Password' => ' ',
            'Timestamp' => ' ',
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount"' => ' ',
            'PartyA' => ' ',
            'PartyB' => ' ',
            'PhoneNumber' => ' ',
            'CallBackURL' => 'https://ip_address:port/callback',
            'AccountReference' => ' ',
            'TransactionDesc' => ' '
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }

    public function callback()
    {
        $postData = file_get_contents('php://input');
        //perform your processing here, e.g. log to file....
        $file = fopen("log.txt", "w"); //url fopen should be allowed for this to occur
        if (fwrite($file, $postData) === FALSE) {
            fwrite("Error: no data written");
        }

        fwrite("\r\n");
        fclose($file);

        echo '{"ResultCode": 0, "ResultDesc": "The service was accepted successfully", "ThirdPartyTransID": "1234567890"}';

    }

    public function authenticate()
    {
        $postData = file_get_contents('php://input');
        //perform your processing here, e.g. log to file....
        $file = fopen("log.txt", "w"); //url fopen should be allowed for this to occur
        if (fwrite($file, $postData) === FALSE) {
            fwrite("Error: no data written");
        }

        fwrite("\r\n");
        fclose($file);

        echo '{"ResultCode": 0, "ResultDesc": "The service was accepted successfully", "ThirdPartyTransID": "1234567890"}';

    }
}