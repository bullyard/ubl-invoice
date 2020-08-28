<?php

namespace Bullyard\UBL;

use Sabre\Xml\Service;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;


class Generator
{
	public static $currencyID;

	public static function invoice(Invoice $invoice, $currencyId = 'NOK')
	{
		self::$currencyID = $currencyId;

		$xmlService = new Service();

		$xmlService->namespaceMap = [
			'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2' => '',
			'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2' => 'cbc',
			'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2' => 'cac'
		];

		return $xmlService->write('Invoice', [
			$invoice
		]);
	}

	public static function reminder(Invoice $invoice, $currencyId = 'NOK')
	{
		self::$currencyID = $currencyId;

		$xmlService = new Service();

		$xmlService->namespaceMap = [
			'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2' => '',
			'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2' => 'cbc',
			'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2' => 'cac'
		];

		return $xmlService->write('Invoice', [
			$invoice
		]);
	}

   public static function creditnote(Invoice $creditnote, $currencyId = 'NOK')
   {
      self::$currencyID = $currencyId;

      $xmlService = new Service();

      $xmlService->namespaceMap = [
         'urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2' => '',
         'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2' => 'cbc',
         'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2' => 'cac'
      ];

      return $xmlService->write('CreditNote', [
         $creditnote
      ]);
   }
}
