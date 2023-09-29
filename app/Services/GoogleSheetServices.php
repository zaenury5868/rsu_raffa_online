<?php

namespace App\Http\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Google\Service\Sheets\ClearValuesRequest;

class GoogleSheetServices {

    public $client, $service, $documentId, $range;
    public function __construct()
    {
        $this->client = $this->getClient();
        $this->service =  new Sheets($this->client);
        $this->documentId = '1NQsCklnI2eBaZgI7mEVhX0PSUOvxgNTIhcuINaaKD0M';
        $this->range = 'A:Z';
    }

    public function getClient() {
        $client = new Client;
        $client->setApplicationName('RSU Raffa');
        $client->setRedirectUri(route('generate-sheet'));

        $client->setScopes(Sheets::SPREADSHEETS);
        $client->setAuthConfig('rsu-raffa-400510-88058328650f.json');
        $client->setAccessType('offline');
        $client->setClientId('899865803454-fn2dbf991pnmh4aah71b9s89tovp6se7.apps.googleusercontent.com');
        $client->setClientSecret('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');

        return $client;
    }

    public function readSheet() {
        $doc = $this->service->spreadsheets_values->get($this->documentId, $this->range);
        return $doc;
    }

    public function writeSheet($values, $startRow = 2) {
        dd($values);
        $this->documentId = '1NQsCklnI2eBaZgI7mEVhX0PSUOvxgNTIhcuINaaKD0M';
    
        $clearRange = 'A'.$startRow.':Z';
        $clearBody = new ClearValuesRequest();
        $this->service->spreadsheets_values->clear($this->documentId, $clearRange, $clearBody);
        
        $body = new ValueRange([
            'values' => $values,
        ]);
        $params = [
            'valueInputOption' => 'RAW',
            'range' => 'A'.$startRow.':Z',
        ];
    
        try {
            $this->service->spreadsheets_values->update($this->documentId, $this->range, $body, $params);
            $redirectUrl = 'https://docs.google.com/spreadsheets/d/'.$this->documentId;
            return $redirectUrl;
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    
}