<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class CreditNoteLine extends InvoiceLine
{

	function xmlSerialize(Writer $writer)
	{
		$writer->write([
			Schema::CBC . 'ID' => $this->getId()
		]);

		if (!empty($this->getNote())) {
			$writer->write([
				Schema::CBC . 'Note' => $this->getNote()
			]);
		}

		$writer->write([
			[
				'name' => Schema::CBC . 'CreditedQuantity',
				'value' => $this->getInvoicedQuantity(),
				'attributes' => [
					'unitCode' => $this->getUnitCode()

				]
			],
			[
				'name' => Schema::CBC . 'LineExtensionAmount',
				'value' => number_format($this->getLineExtensionAmount(), 2, '.', ''),
				'attributes' => [
					'currencyID' => Generator::$currencyID
				]
			]

		]);

      $writer->write([
         Schema::CAC . 'OrderLineReference' => [
            Schema::CBC . 'LineID' => $this->getId()
         ]
      ]);

      if ($this->getAllowanceCharge() !== null){
         $writer->write([Schema::CAC . 'AllowanceCharge' => $this->getAllowanceCharge()]);
      }

   	$writer->write([
         //Schema::CAC . 'TaxTotal' => $this->getTaxTotal(),
         Schema::CAC . 'Item' => $this->getItem()
      ]);


		if ($this->getPrice() !== null) {
			$writer->write([
				Schema::CAC . 'Price' => $this->getPrice()
			]);
		} else {
			$writer->write([
				Schema::CAC . 'TaxScheme' => null,
			]);
		}
	}

}
