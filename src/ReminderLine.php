<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class ReminderLine extends InvoiceLine
{

	public function setReminderReference(string $reminderReference)
	{
		$this->reminderReference = $reminderReference;
		return $this;
	}

	public function getReminderReference()
	{
		return $this->reminderReference;
	}


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
			'name' => Schema::CBC . 'DebitLineAmount',
			'value' => number_format($this->getLineExtensionAmount() * $this->getInvoicedQuantity(), 2, '.', ''),
			'attributes' => [
				'currencyID' => Generator::$currencyID
			]
		]);


      $writer->write([
         Schema::CAC . 'BillingReference' => [
         	Schema::CAC . 'InvoiceDocumentReference' => [
					Schema::CBC . 'ID' => $this->getReminderReference()
				]
         ]
      ]);

      if ($this->getAllowanceCharge() !== null){
          $writer->write([Schema::CAC . 'AllowanceCharge' => $this->getAllowanceCharge()]);
      }

	}

}
