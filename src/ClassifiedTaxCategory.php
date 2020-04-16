<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class ClassifiedTaxCategory implements XmlSerializable
{
    private $id;
    private $name;
    private $percent;
    private $taxScheme;

    public const UNCL5305 = 'UNCL5305';

    /**
     * @return mixed
     */

     public function getId()
   {
      /* https://vefa.difi.no/ehf/g2/invoice-and-creditnote/2.0/no/#_merverdiavgift
      S -> Utgående merverdiavgift, alminnelig sats -> 25%
      H -> Utgående merverdiavgift, redusert sats – næringsmidler -> 15%
      A -> Utgående merverdiavgift, redusert sats – lav sats -> 10%
      Z -> Unntatt fra merverdiavgiftsloven (utenfor merverdiavgiftsloven) -> 0%
      */
      if (!empty($this->id)) {
         return $this->id;
      }

      $percent = $this->getPercent();
      if ($percent !== null) {

         if ($percent >= 25) {
            return 'S';
         } else if ($percent >= 15) {
            return 'H';
         } else if ($percent >= 10) {
            return 'AA';
         } else {
            return 'Z';
         }
      }

      return null;
   }


    /**
     * @param mixed $id
     * @return ClassifiedTaxCategory
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
     * @return ClassifiedTaxCategory
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
     * @return ClassifiedTaxCategory
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
   * @return ClassifiedTaxCategory
   */
	public function setTaxScheme($taxScheme)
	{
		$this->taxScheme = $taxScheme;
		return $this;
	}

   /**
   * The validate function that is called during xml writing to valid the data of the object.
   *
   * @throws InvalidArgumentException An error with information about required data that is missing to write the XML
   * @return void
   */
   public function validate()
   {
      if ($this->getId() === null) {
      throw new \InvalidArgumentException('Missing taxcategory id');
      }
      //
      // if ($this->getName() === null) {
      //    throw new \InvalidArgumentException('Missing taxcategory name');
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
				'value' => $this->getId(),
				'attributes' => [
					'schemeID' => ClassifiedTaxCategory::UNCL5305
				]
			],
			//Schema::CBC . 'Name' => $this->getName(),
			Schema::CBC . 'Percent' => number_format($this->getPercent(), 2, '.', ''),
		]);

		// $writer->write([
		// 	Schema::CBC . 'TaxExemptionReasonCode' => null,
		// 	Schema::CBC . 'TaxExemptionReason' => null,
		// ]);

		if ($this->taxScheme != null) {
			$writer->write([Schema::CAC . 'TaxScheme' => $this->getTaxScheme()]);
		} else {
			$writer->write([
				Schema::CAC . 'TaxScheme' => null,
			]);
		}
	}


}
