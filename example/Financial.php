<?php declare(strict_types=1);

use MpApiClient\Common\Authenticators\ClientIdAuthenticator;
use MpApiClient\Exception\MpApiException;
use MpApiClient\MpApiClient;
use MpApiClient\MpApiClientOptions;

require '../vendor/autoload.php';

$options = new MpApiClientOptions(
    new ClientIdAuthenticator('my-client-id')
);
$client  = MpApiClient::createFromOptions('my-app-name', $options);

//
// Get invoice list
//

try {
    $invoiceList = $client->financial()->listInvoices(null);

    // Print all invoices as json object
    echo json_encode($invoiceList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all invoices as array
    var_dump($invoiceList->jsonSerialize());

    // Iterate over the returned list
    foreach ($invoiceList as $invoice) {
        echo 'Invoice number: ' . $invoice->getInvoiceNumber() . PHP_EOL;
        echo 'Created at: ' . $invoice->getCreatedAt()->format(DATE_RFC3339) . PHP_EOL;
        echo 'Total: ' . $invoice->getTotal() . PHP_EOL;
        echo 'Currency: ' . $invoice->getCurrency() . PHP_EOL;
        echo 'Item count: ' . $invoice->getItems()->count() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while loading invoice list: ' . $e->getMessage();
}

//
// Get invoice detail
//

try {
    $invoice = $client->financial()->getInvoice('invoice-id');

    // Print invoice as json object
    echo json_encode($invoice, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get invoice as array
    var_dump($invoice->jsonSerialize());

    // Show some invoice data
    echo 'Created at: ' . $invoice->getCreatedAt()->format(DATE_RFC3339) . PHP_EOL;
    echo 'Total: ' . $invoice->getTotal() . PHP_EOL;
    echo 'Currency: ' . $invoice->getCurrency() . PHP_EOL;
    echo 'Item count: ' . $invoice->getItems()->count() . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while loading invoice: ' . $e->getMessage();
}

//
// Download invoice
//

try {
    $response = $client->financial()->downloadInvoice('invoice-id');

    header('Content-Type: ' . $response->getHeaderLine('Content-Type'));
    // this header forces browser to download the file, comment out to display attachment in a browser
    header('Content-Disposition: attachment; filename="invoice-id.pdf"');
    echo $response->getBody()->getContents();
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while downloading invoice: ' . $e->getMessage();
}

//
// Get offset list
//

try {
    $offsetsList = $client->financial()->listOffsets(null);

    // Print all offsets as json object
    echo json_encode($offsetsList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get all invoices as array
    var_dump($offsetsList->jsonSerialize());

    // Iterate over the returned list
    foreach ($offsetsList as $offset) {
        echo 'Document number: ' . $offset->getDocumentNumber() . PHP_EOL;
        echo 'Created at: ' . $offset->getCreatedAt()->format(DATE_RFC3339) . PHP_EOL;
        echo 'Diff price: ' . $offset->getDiffPrice() . PHP_EOL;
        echo 'Currency: ' . $offset->getCurrency() . PHP_EOL;
        echo 'Invoice count: ' . $offset->getInvoices()->count() . PHP_EOL;
        echo 'Order count: ' . $offset->getOrders()->count() . PHP_EOL;
        echo PHP_EOL;
    }
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while loading offset list: ' . $e->getMessage();
}

//
// Get offset detail
//

try {
    $offset = $client->financial()->getOffset('offset-id');

    // Print offset as json object
    echo json_encode($offset, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Get offset as array
    var_dump($offset->jsonSerialize());

    // Show some offset data
    echo 'Document number: ' . $offset->getDocumentNumber() . PHP_EOL;
    echo 'Created at: ' . $offset->getCreatedAt()->format(DATE_RFC3339) . PHP_EOL;
    echo 'Diff price: ' . $offset->getDiffPrice() . PHP_EOL;
    echo 'Currency: ' . $offset->getCurrency() . PHP_EOL;
    echo 'Attachment: ' . $offset->getAttachment()->getFilename() . PHP_EOL;
    echo PHP_EOL;
} catch (MpApiException | Exception $e) {
    echo 'Unexpected error occurred while loading offset: ' . $e->getMessage();
}

//
// Download offset
//

try {
    $response = $client->financial()->downloadOffset('offset-id');

    header('Content-Type: ' . $response->getHeaderLine('Content-Type'));
    // this header forces browser to download the file, comment out to display attachment in a browser
    header('Content-Disposition: attachment; filename="offset-id.pdf"');
    echo $response->getBody()->getContents();
} catch (MpApiException $e) {
    echo 'Unexpected error occurred while downloading offset: ' . $e->getMessage();
}
