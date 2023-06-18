<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class TaxCategory implements XmlSerializable
{
   private $id;
   private $name;
   private $percent;
   private $taxScheme;
   private $taxExemptionReason;

   public const UNCL5305 = 'UNCL5305';

   /**
   * @return mixed
   */
   public function getId()
   {
      /* https://docs.peppol.eu/poacc/billing/3.0/codelist/UNCL5305/
      S -> Utgående merverdiavgift
      E -> Unntatt fra merverdiavgiftsloven (utenfor merverdiavgiftsloven) -> 0%
      */
      if (!empty($this->id)) {
         return $this->id;
      }

      $percent = $this->getPercent();
      if ($percent !== null) {
         if ($percent >= 1) {
            return 'S';
         } else {
            return 'E';
         }
      }

      return null;
   }

   /**
   * @param mixed $id
   * @return TaxCategory
   */
   public function setId($id)
   {
      $this->id = $id;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getName()
   {
      return $this->name;
   }

   /**
   * @param mixed $name
   * @return TaxCategory
   */
   public function setName($name)
   {
      $this->name = $name;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getPercent()
   {
      return $this->percent;
   }

   /**
   * @param mixed $percent
   * @return TaxCategory
   */
   public function setPercent($percent)
   {
      $this->percent = $percent;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getTaxScheme()
   {
      return $this->taxScheme;
   }

   /**
   * @param mixed $taxScheme
   * @return TaxCategory
   */
   public function setTaxScheme($taxScheme)
   {
        $this->taxScheme = $taxScheme;
        return $this;
   }

   public function setTaxExemptionReason(string $taxExemptionReason)
   {
      $this->taxExemptionReason = $taxExemptionReason;
      return $this;
   }

   public function getTaxExemptionReason()
   {
      return $this->taxExemptionReason;
   }


   public function validate()
	{
		if ($this->getId() === null) {
			throw new \InvalidArgumentException('Missing taxcategory id');
		}

		// if ($this->getName() === null) {
		// 	throw new \InvalidArgumentException('Missing taxcategory name');
		// }

		if ($this->getPercent() === null) {
			throw new \InvalidArgumentException('Missing taxcategory percent');
		}
	}



    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
     function xmlSerialize(Writer $writer)
 	{
 		$this->validate();

 		$writer->write([
 			[
 				'name' => Schema::CBC . 'ID',
 				'value' => $this->getId()
 			],
 			Schema::CBC . 'Percent' => $this->getPercent(),
 		]);

       if ($this->getTaxExemptionReason() !== null) {
          $writer->write([
             Schema::CBC . 'TaxExemptionReason' => $this->getTaxExemptionReason()
          ]);
       }

 		// $writer->write([
 		// 	Schema::CBC . 'TaxExemptionReasonCode' => null,
 		// 	Schema::CBC . 'TaxExemptionReason' => null,
 		// ]);

 		if ( $this->getTaxScheme() !== null) {
 			$writer->write([Schema::CAC . 'TaxScheme' => $this->getTaxScheme()]);
 		}


 	}
}
