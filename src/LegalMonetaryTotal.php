<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class LegalMonetaryTotal implements XmlSerializable
{
   private $lineExtensionAmount;
   private $taxExclusiveAmount;
   private $taxInclusiveAmount;
   private $allowanceTotalAmount = 0;
   private $payableAmount;
   private $PayableRoundingAmount;

   public function calculate(float $valueWithoutTax, float $valueWithTax)
   {
      $this->setTaxExclusiveAmount($valueWithoutTax);
      $this->setLineExtensionAmount($valueWithoutTax);

      $difference = 0;
      $rounded = round($valueWithTax);

      if ($rounded < $valueWithTax){
         $difference = $rounded - $valueWithTax ;
      }else{
         $difference = abs($valueWithTax - $rounded);
      }


      $this->setPayableRoundingAmount($difference);
      $this->setPayableAmount($rounded);
      $this->setTaxInclusiveAmount($rounded);
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
   * @return LegalMonetaryTotal
   */
   public function setLineExtensionAmount($lineExtensionAmount)
   {
      $this->lineExtensionAmount = $lineExtensionAmount;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getTaxExclusiveAmount()
   {
      return $this->taxExclusiveAmount;
   }

   /**
   * @param mixed $taxExclusiveAmount
   * @return LegalMonetaryTotal
   */
   public function setTaxExclusiveAmount($taxExclusiveAmount)
   {
      $this->taxExclusiveAmount = $taxExclusiveAmount;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getTaxInclusiveAmount()
   {
      return $this->taxInclusiveAmount;
   }

   /**
   * @param mixed $taxInclusiveAmount
   * @return LegalMonetaryTotal
   */
   public function setTaxInclusiveAmount($taxInclusiveAmount)
   {
      $this->taxInclusiveAmount = $taxInclusiveAmount;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getAllowanceTotalAmount()
   {
      return $this->allowanceTotalAmount;
   }

   /**
   * @param mixed $allowanceTotalAmount
   * @return LegalMonetaryTotal
   */
   public function setAllowanceTotalAmount($allowanceTotalAmount)
   {
      $this->allowanceTotalAmount = $allowanceTotalAmount;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getPayableAmount()
   {
      return $this->payableAmount;
   }

   /**
   * @param mixed $payableAmount
   * @return LegalMonetaryTotal
   */
   public function setPayableAmount($payableAmount)
   {
      $this->payableAmount = $payableAmount;
      return $this;
   }

   public function setPayableRoundingAmount(float $id)
   {
      $this->PayableRoundingAmount = $id;
      return $this;
   }

   public function getPayableRoundingAmount()
   {
      return $this->PayableRoundingAmount;
   }

   /**
   * The xmlSerialize method is called during xml writing.
   *
   * @param Writer $writer
   * @return void
   */
   function xmlSerialize(Writer $writer)
	{
		$writer->write([
			[
				'name' => Schema::CBC . 'LineExtensionAmount',
				'value' => number_format($this->getLineExtensionAmount(), 2, '.', ''),
				'attributes' => [
					'currencyID' => Generator::$currencyID
				]

			],
			[
				'name' => Schema::CBC . 'TaxExclusiveAmount',
				'value' => number_format($this->getTaxExclusiveAmount(), 2, '.', ''),
				'attributes' => [
					'currencyID' => Generator::$currencyID
				]

			],
			[
				'name' => Schema::CBC . 'TaxInclusiveAmount',
				'value' => number_format($this->getTaxInclusiveAmount(), 2, '.', ''),
				'attributes' => [
					'currencyID' => Generator::$currencyID
				]

			],
			[
				'name' => Schema::CBC . 'AllowanceTotalAmount',
				'value' => number_format($this->getAllowanceTotalAmount(), 2, '.', ''),
				'attributes' => [
					'currencyID' => Generator::$currencyID
				]

			],
			[
				'name' => Schema::CBC . 'PayableRoundingAmount',
				'value' => number_format($this->getPayableRoundingAmount(), 2, '.', ''),
				'attributes' => [
					'currencyID' => Generator::$currencyID
				]

			],
			[
				'name' => Schema::CBC . 'PayableAmount',
				'value' => number_format($this->getPayableAmount(), 2, '.', ''),
				'attributes' => [
					'currencyID' => Generator::$currencyID
				]
			]
		]);

   }

}
