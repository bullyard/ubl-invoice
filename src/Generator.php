<?php

namespace Bullyard\UBL;

use Sabre\Xml\Service;

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

		$xmlService->classMap['RootElement'] = function( $writer, $value) {
		   $writer->writeAttribute('version', '1.00');
		   $writer->write($value);
		};

		$xmlService->namespaceMap = [
			'urn:oasis:names:specification:ubl:schema:xsd:Reminder-2' => '',
			'http://www.w3.org/2001/XMLSchema-instance' => 'xsi',
			'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2' => 'cbc',
			'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2' => 'cac'
		];

		return $xmlService->write('Reminder',
			new RootElement($invoice)
		);
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

class RootElement implements XmlSerializable {

    public $value;

    function __construct($value) {
       $this->value = $value;
    }

    public function xmlSerialize(Writer $writer) {
       $writer->writeAttribute('xsi:schemaLocation', 'urn:oasis:names:specification:ubl:schema:xsd:Reminder-2 UBL-Reminder-2.0.xsd');
       $writer->write($this->value);
    }
}
