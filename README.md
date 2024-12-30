# STInvoice Laravel Client Package

## Installation

You can install the package via composer:

```bash

composer require sankyutech/stinvoice-client

```

### Register Service Provider

Put StinvoiceClientServiceProvider in boostrap/providers.php or in configuration file app.php in provider section

```php

Sankyutech\StinvoiceClient\StinvoiceClientServiceProvider::class,

```

## (Optional) Migrate prepared database structure related to E-Invoice needs

This action will migrate directly to database without publish to application database/migration directory. If your application database migration not sync with database, this might be option.

```php

php artisan migrate --path=vendor/sankyutech/stinvoice-client/database/migrations

```

## Publish Vendor

### Database

If you want to track this database structure along with your application database migration, this might be the option

```php

php artisan vendor:publish --tag=stinvoice-migrations
php artisan migrate

```

## Integration Usage & Steps

#### 1. Company/Supplier Details & Credential 

Check & fetch company details & ST Invoice Credentials

```php

use Sankyutech\StInvoiceClient\Class\CompanyDetails;
use Sankyutech\StInvoiceClient\Class\StInvoiceConstants;

$supplier_id = 1;

$companyDetails = new CompanyDetails($supplier_id);
$einvoice_company_details = $companyDetails->getDetailWithCredential();

// eg: dropdown input usage, at address details section

$states = StInvoiceConstants::getListStates();

```

 Save company details with StInvoice credentials

```php
        
use Sankyutech\StInvoiceClient\Class\CompanyDetails;

$data['registration_name'] = $request->registration_name;
$data['phone'] = $request->phone;
$data['email'] = $request->email;
$data['tax_identification_no'] = $request->tax_identification_no;
$data['identification_no'] = $request->identification_no;
$data['identification_type'] = $request->identification_type;
$data['msic_codes'] = $request->msic_codes;
$data['address_line_1'] = $request->address_line_1;
$data['address_line_2'] = $request->address_line_2;
$data['address_line_3'] = $request->address_line_3 ?? NULL;
$data['city'] = $request->city;
$data['postcode'] = $request->postcode;
$data['state'] = $request->state;
$data['stinvoice_key'] = $request->stinvoice_key;
$data['stinvoice_secret'] = $request->stinvoice_secret;
$data['stinvoice_sandbox'] = $request->stinvoice_sandbox;
$data['status'] = $request->status ?? 0;

//Passing internal_id as main system referrence eg:session('supplier_id')

$companyDetails = new CompanyDetails(session('supplier_id'));

$einvoice_company_details = $companyDetails->saveDetailWithCredential($data);

```

#### 2. Client/Buyer Details

Check & fetch client details

```php
    
use Sankyutech\StInvoiceClient\Class\StInvoiceConstants;
use Sankyutech\StInvoiceClient\Class\CustomerDetails;

$client_id = 1;

$customerDetails = new CustomerDetails($client_id);
$einvoice_customer_details = $customerDetails->getDetail();

// eg: dropdown input usage, at address details section

$states = StInvoiceConstants::getListStates();

```

 Save client details

```php
        
use Sankyutech\StInvoiceClient\Class\CustomerDetails;

$data['registration_name'] = $request->registration_name;
$data['phone'] = $request->phone;
$data['email'] = $request->email;
$data['tax_identification_no'] = $request->tax_identification_no;
$data['identification_no'] = $request->identification_no;
$data['identification_type'] = $request->identification_type;
$data['address_line_1'] = $request->address_line_1;
$data['address_line_2'] = $request->address_line_2;
$data['address_line_3'] = $request->address_line_3 ?? NULL;
$data['city'] = $request->city;
$data['postcode'] = $request->postcode;
$data['state'] = $request->state;
$data['country_code'] = $request->country_code;

$customerDetails = new CustomerDetails($client->id);

// 2nd parameter is optional, however second parameter will use for client TIN validation before details been save.
$supplier_id = 1;

$status = $customerDetails->saveDetail($data,$supplier_id);

```


#### 3. Invoice Submission

Invoice submission require to ST Invoice Adapter functions. ST Invoice Client will be use for submission records, storing supplier and buyer details for E-Invoice usage.

```php
	   
use Sankyutech\StInvoiceClient\Class\CustomerDetails;
use Sankyutech\StInvoiceClient\Class\CompanyCredentials;
use Sankyutech\StInvoiceClient\Class\CompanyDetails;
use Sankyutech\StInvoiceClient\Class\CompanySubmission;

use Sankyu\Client;
use Sankyu\One\Submission;
use Sankyu\CustomSankyuAuth;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;

use Sankyu\One\Mapper\ReferenceNumber;
use Sankyu\One\Mapper\Supplier;
use Sankyu\One\Mapper\Customer;
use Sankyu\One\Mapper\TaxTotal;
use Sankyu\One\Mapper\LegalMonitoryTotal;
use Sankyu\One\Mapper\AllowanceCharges;
use Sankyu\One\Mapper\Wrapper;

//fetching supplier details

$companyDetails = new CompanyDetails($order->suplier_id);
$supplierInfo = $companyDetails->getDetailWithCredential();

// fetching buyer details

$customerDetails = new CustomerDetails($order->client_id);
$customerInfo = $customerDetails->getDetail();

//ST Invoice Adapter functions
//setting up invoice reference number

$referenceNumber = new ReferenceNumber();
$reference = $referenceNumber->setDocumentReferenceNo($order->no_inv);
$reference = $referenceNumber->setUpInvoiceReference();


//setting up invoice supplier details

$supplier = new Supplier();
$supplierDetails = $supplier->setAddressLine1($supplierInfo->address_line_1);
$supplierDetails = $supplier->setAddressLine2($supplierInfo->address_line_2);

if(isset($supplierInfo->address_line_3)){
    $supplierDetails = $supplier->setAddressLine3($supplierInfo->address_line_3);
}

$supplierDetails = $supplier->setCity($supplierInfo->city);
$supplierDetails = $supplier->setState($supplierInfo->state);
$supplierDetails = $supplier->setPostcode($supplierInfo->postcode);
$supplierDetails = $supplier->setCountryCode($supplierInfo->country_code);
$supplierDetails = $supplier->setRegistrationName($supplierInfo->registration_name);
$supplierDetails = $supplier->setPhone($supplierInfo->phone);
$supplierDetails = $supplier->setTaxIdentificationNo($supplierInfo->tax_identification_no);
$supplierDetails = $supplier->setIdentificationNo($supplierInfo->identification_no);
$supplierDetails = $supplier->setIdentificationType($supplierInfo->identification_type);
$supplierDetails = $supplier->setSSTRegistrationNo($supplierInfo->sst_registration_no);
$supplierDetails = $supplier->setMISCCode($supplierInfo->msic_codes);
$supplierDetails = $supplier->setUpSupplier();

//setting up invoice customer details

$customer = new Customer();
$customerDetails = $customer->setAddressLine1($customerInfo->address_line_1);
$customerDetails = $customer->setAddressLine2($customerInfo->address_line_2);
if(isset($customerInfo->address_line_3)){
    $customerDetails = $customer->setAddressLine3($customerInfo->address_line_3);   
}

$customerDetails = $customer->setCity($customerInfo->city);
$customerDetails = $customer->setState($customerInfo->state);
$customerDetails = $customer->setPostcode($customerInfo->postcode);
$customerDetails = $customer->setCountryCode($customerInfo->country_code);
$customerDetails = $customer->setRegistrationName($customerInfo->registration_name);
$customerDetails = $customer->setPhone($customerInfo->phone);
$customerDetails = $customer->setEmail($customerInfo->email);
$customerDetails = $customer->setTaxIdentificationNo($customerInfo->tax_identification_no);
$customerDetails = $customer->setIdentificationNo($customerInfo->identification_no);
$customerDetails = $customer->setIdentificationType($customerInfo->identification_type);
$customerDetails = $customer->setSSTRegistrationNo($customerInfo->sst_registration_no);
$customerDetails = $customer->setUpCustomer();

$item_net_amount = 0;
$item_total_discount = 0;
$item_total_charges = 0;

//setting up invoice lines

if($order->stock_type == 1){

    $invoiceDetails = $this->eInvoicePieceInvoiceDetails($this->sales_uuid);

}elseif($order->stock_type == 2){

    $invoiceDetails = $this->eInvoiceGroupInvoiceDetails($this->sales_uuid);

}

$line = $invoiceDetails['invoice_line'];
$item_net_amount = $invoiceDetails['item_net_amount'];
$item_total_discount = $invoiceDetails['item_total_discount'];
$item_total_charges = $invoiceDetails['item_total_charges'];


//setting up invoice discount/charges (allowance charges)

if($order->discount != "0.00" || $order->discount != "0" || $order->discount != null || $order->additional_workmanship != "0.00" || $order->additional_workmanship != "0" || $order->additional_workmanship != null){



    $allowanceCharges = new AllowanceCharges();

    if($order->discount != "0.00" || $order->discount != "0" || $order->discount != null){

        $discount_charges = $allowanceCharges->setDiscount($order->discount,"Discount");


    }

    if($order->additional_workmanship != "0.00" || $order->additional_workmanship != "0" || $order->additional_workmanship != null){

        $discount_charges = $allowanceCharges->setCharges($order->additional_workmanship,"Additional Workmanship");
    }
    
    
    $discount_charges = $allowanceCharges->setUpAllowanceCharges();

}

//setting up invoice tax total

$taxTotal = new TaxTotal();
$tax = $taxTotal->setTaxSubtotal();
$tax = $taxTotal->setUpTaxTotal();

$total_charges = $item_total_charges + $order->additional_workmanship;
$total_discount = $item_total_discount + $order->discount;

$total_net_amount = $item_net_amount - $total_charges + $total_discount;

//setting up invoice amount summary

$legalMonitoryTotal = new LegalMonitoryTotal();
$monitory = $legalMonitoryTotal->setTotalNetAmount($total_net_amount);
$monitory = $legalMonitoryTotal->setTotalExcludeTax($total_net_amount);
$monitory = $legalMonitoryTotal->setTotalIncludeTax($total_net_amount);
$monitory = $legalMonitoryTotal->setTotalDiscount($total_discount);
$monitory = $legalMonitoryTotal->setTotalCharges($total_charges);
$monitory = $legalMonitoryTotal->setRoundingAmount($total_net_amount);
$monitory = $legalMonitoryTotal->setPayableAmount($total_net_amount);
$monitory = $legalMonitoryTotal->setUpLegalMonitoryTotal();


//wrapping all parameter

$wrapper = new Wrapper();
$submissionData = $wrapper->wrapUp(
                                $reference,
                                $supplierDetails,
                                $customerDetails,
                                $line,
                                $tax,
                                $monitory,
                                $discount_charges ?? []
                            );


//making http request for submissions

$config = [
        'api_key' => $supplierInfo->stinvoice_key,
        'api_secret' => $supplierInfo->stinvoice_secret,
        'use_sandbox'  => $supplierInfo->stinvoice_sandbox,
    ];

$httpClient = new GuzzleClient(['verify' => false]);

$client = Client::make($httpClient, $config)
    ->provideAuth(new CustomSankyuAuth($config['api_key'], $config['api_secret']));

$submission = $client->v1()->submissions()->invoice($submissionData);

$responseBody = $submission->getBody();
$result = json_decode($responseBody, true);

if($result['error'] == false && isset($result['data']['acceptedDocuments'][0])){

    $data['document_uuid'] = $result['data']['acceptedDocuments'][0]['uuid'];

    $parameter_checker_status =  false;
    $retryCount = 0;
    $maxRetry = 3;
    $buffer = 5;

    // to getting all completed information of e-invoice, require to make other http request.
    // however, sometimes some parameter not been filled yet by LHDN system. 
    // this flow will try make 3 times http request and have buffer 5 seconds between request to get all information needed.
    //

    // however it depends how you implement into your system

    while($parameter_checker_status == false && $retryCount <=  $maxRetry){

        sleep($buffer);

        $submissionDetails = $client->v1()->submissions()->getSubmissionDocumentDetailsQr($data);

        $submissionDetailsBody = $submissionDetails->getBody();

        $submissionDetailsResult = json_decode($submissionDetailsBody, true);

        if($submissionDetailsResult['data']['longId'] != ""){

            $parameter_checker_status = true;
        }

        $retryCount++;

    }

    // save all the details

    $data['stinvoice_company_id'] = $supplierInfo->id;
    $data['internal_reference_id'] = $order->id;
    $data['reference_no'] = $this->invoice_no;
    $data['einvoice_submission_uuid'] = $submissionDetailsResult['data']['submissionUid'];
    $data['einvoice_submission_invoice_uuid'] = $submissionDetailsResult['data']['uuid'];
    $data['einvoice_validation_link'] = $submissionDetailsResult['data']['qr_link'];
    $data['einvoice_submission_invoice_long_uuid'] = $submissionDetailsResult['data']['longId'];
    $data['einvoice_submission_timestamp'] = $submissionDetailsResult['data']['dateTimeValidated'];
    $data['document_type'] = $submissionDetailsResult['data']['typeName'];
    $data['stinvoice_sandbox'] = $supplierInfo->stinvoice_sandbox;
    $data['raw_submission'] = json_encode($submissionData);
    $data['response'] = $submissionDetailsBody;
    $data['status'] = $submissionDetailsResult['data']['status'];

    $companySubmission = new CompanySubmission(session('supplier_id'));
    $companySubmission->saveSubmission($data);
}

```


Fetching submission details
```php
        
use Sankyutech\StInvoiceClient\Class\Invoices;

$einvoice = new Invoices(session('supplier_id'));
$einvoiceDetails = $einvoice->getInvoice($sales->einvoice_submission_invoice_uuid);
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email info@sankyutech.com instead of using the issue tracker.

## Credits

-   [SankyuTech](https://github.com/sankyutech)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

