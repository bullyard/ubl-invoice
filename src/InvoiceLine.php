<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class InvoiceLine implements XmlSerializable
{
   private $id;
   private $invoicedQuantity;
   private $lineExtensionAmount;
   private $unitCode = 'MON';
   private $taxTotal;
   private $note;
   private $item;
   private $price;

   private $unitCode = 'VAR';
   private $unitCodeListID = "UNECERec20"; // https://docs.peppol.eu/poacc/billing/3.0/codelist/UNECERec20/
   private $allowanceCharge;

   function __construct($unitCode = false)
   {
      if ($unitCode){
         $this->unitCode = $unitCode;
      }
   }

   /**
   * @return mixed
   */
   public function getId()
   {
      return $this->id;
   }

   /**
   * @param mixed $id
   * @return InvoiceLine
   */
   public function setId($id)
   {
      $this->id = $id;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getInvoicedQuantity()
   {
      return $this->invoicedQuantity;
   }

   /**
   * @param mixed $invoicedQuantity
   * @return InvoiceLine
   */
   public function setInvoicedQuantity($invoicedQuantity)
   {
      $this->invoicedQuantity = $invoicedQuantity;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getLineExtensionAmount()
   {
      return $this->lineExtensionAmount;
   }

   /**
   * @param mixed $lineExtensionAmount
   * @return InvoiceLine
   */
   public function setLineExtensionAmount($lineExtensionAmount)
   {
      $this->lineExtensionAmount = $lineExtensionAmount;
      return $this;
   }

   /**
   * @return TaxTotal
   */
   public function getTaxTotal()
   {
      return $this->taxTotal;
   }

   /**
   * @param TaxTotal $taxTotal
   * @return InvoiceLine
   */
   public function setTaxTotal(TaxTotal $taxTotal)
   {
      $this->taxTotal = $taxTotal;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getNote()
   {
      return $this->note;
   }

   /**
   * @param mixed $note
   * @return InvoiceLine
   */
   public function setNote($note)
   {
      $this->note = $note;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getItem()
   {
      return $this->item;
   }

   /**
   * @param mixed $item
   * @return InvoiceLine
   */
   public function setItem($item)
   {
      $this->item = $item;
      return $this;
   }

   /**
   * @return Price
   */
   public function getPrice()
   {
      return $this->price;
   }

   /**
   * @param Price $price
   * @return InvoiceLine
   */
   public function setPrice(Price $price)
   {
      $this->price = $price;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getUnitCode()
   {
      return $this->unitCode;
   }

   /**
   * @param mixed $unitCode
   * @return InvoiceLine
   */
   public function setUnitCode($unitCode)
   {
   $this->unitCode = $unitCode;
      return $this;
   }

   public function setAllowanceCharge(AllowanceCharge $allowanceCharge)
   {
      $this->allowanceCharge = $allowanceCharge;
      return $this;
   }

   public function getAllowanceCharge()
   {
      return $this->allowanceCharge;
   }

   public function setUnitCodeListID(string $id)
   {
      $this->unitCodeListID = $id;
      return $this;
   }

   public function getUnitCodeListID()
   {
      return $this->unitCodeListID;
   }


   /**
   * The xmlSerialize method is called during xml writing.
   * @param Writer $writer
   * @return void
   */
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
				'name' => Schema::CBC . 'InvoicedQuantity',
				'value' => $this->getInvoicedQuantity(),
				'attributes' => [
					'unitCode' => $this->getUnitCode(),
               'unitCodeListID' => $this->getUnitCodeListID()
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
