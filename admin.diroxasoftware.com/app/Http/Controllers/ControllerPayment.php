<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;

class ControllerPayment extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );
    }

    public function payWithPaypal(Request $request, $id)
    {
        $total =  $id;

        //obj que representa o usuário que vai pagar
        $payer = new Payer();
        $payer->setPaymentMETHOD('paypal');
        
        $amount = new Amount();
        //pç do produto  a ser pago
        $amount->setTotal($total);
        $amount->setCurrency('GBP');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        //$transaction->setDescription('See your 10 results');

        $callbakcUrl = url('/paypal/status');
        
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbakcUrl)
        ->setCancelUrl($callbakcUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);

          try {
              $payment->create($this->apiContext);
            //   echo $payment;
             
            return redirect()->away($payment->getApprovalLink());
          }

          catch (PayPalConnectionException $ex){
              //redirect a uma rote diffrent
              echo $ex->getData();
          }
    } 

    public function payPalStatus(Request $request)
    {


        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        // failure
        if(!$paymentId || !$paymentId || !$token)
        {
            $status = 'Was not possible pay with PayPal';
            return redirect ('/paypal/failed')->with(compact('status'));
        }

        //success 

        $payment = Payment::get($paymentId, $this->apiContext);
        
        $execution = new PaymentExecution();
        $execution-> setPayerId($payerId);

        /** Execute the payment */
        $result = $payment->execute($execution, $this->apiContext);
        // dd($result);
        // $tot=  $result->cart;

        $a = $result->toArray();
        // return $a; 
        $a2 = $a["transactions"];
        $size = sizeof($a2);

        for ($i=0; $i<$size; $i++)
        {
            // dd($result);
            $total = $a2[0]["amount"]["total"];
        }

        // return $a["links"]["href"];
        // var_dump($array["multi"]["dimensional"]["array"]);




        //aproved
        if($result->getState() === 'approved'){
            $status = 'PAYMENT SUCCESSFUL';
            return redirect('/results')->with(compact('status', 'total'));
        }

        // declined

        $status = 'PAYMENT FAILED';
        return redirect('/results')->with(compact('status'));

         
        
    } 
}
