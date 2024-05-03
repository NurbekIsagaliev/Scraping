<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\ParsedData;

class ParsingController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://gis.gosreestr.kz/',
            'timeout' => 30000,
        ]);
    }

    public function parseData($flId = 1, $flTypeId = 'ATS')
    {
        $data = $this->getListValues($flId, $flTypeId);
        if (!isset($data) || count($data) == 0) {
            return;
        }
        foreach ($data as $item) {
            ParsedData::create([
                'flId' => $item['flId'],
                'flTypeId' => $item['flTypeId'],
                'flText' => $item['flText'],
                'flType' => $item['flType'],
                'flSubType' => $item['flSubType'],
                'flCato' => $item['flCato'],
                'flRca' => $item['flRca'],
                'parentId' => $flId,
            ]);
            $dataInner = $this->getListValues($item['flId'], $item['flTypeId']);
            if (isset($dataInner) && count($dataInner) > 0) {
                foreach ($dataInner as $itemInner) {
                    ParsedData::create([
                        'flId' => $itemInner['flId'],
                        'flTypeId' => $itemInner['flTypeId'],
                        'flText' => $itemInner['flText'],
                        'flType' => $itemInner['flType'],
                        'flSubType' => $itemInner['flSubType'],
                        'flCato' => $itemInner['flCato'],
                        'flRca' => $itemInner['flRca'],
                        'parentId' => $item['flId'],
                    ]);
                    $this->parseData($itemInner['flId'], $itemInner['flTypeId']);
                }
            }
        }
    }

    protected function getListValues($flId, $flTypeId)
    {
        $response = $this->client->request('GET', 'p/ru/address-registry/get-list-values', [
            'query' => [
                'flId' => $flId,
                'flTypeId' => $flTypeId,
            ],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return $data;
    }
}
