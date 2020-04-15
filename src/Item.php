<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Item implements XmlSerializable
{
   private $description;
   private $name;
   private $sellersItemIdentification;
   private $classifiedTaxCategory;

   /**
   * @return mixed
   */
   public function getDescription()
   {
      return $this->description;
   }

   /**
   * @param mixed $description
   * @return Item
   */
   public function setDescription($description)
   {
      $this->description = $description;
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
   * @return Item
   */
   public function setName($name)
   {
      $this->name = $name;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getSellersItemIdentification()
   {
      return $this->sellersItemIdentification;
   }

   /**
   * @param mixed $sellersItemIdentification
   * @return Item
   */
   public function setSellersItemIdentification($sellersItemIdentification)
   {
      $this->sellersItemIdentification = $sellersItemIdentification;
      return $this;
   }

   /**
   * @return ClassifiedTaxCategory
   */
   public function getClassifiedTaxCategory()
   {
      return $this->classifiedTaxCategory;
   }

   /**
   * @param ClassifiedTaxCategory $classifiedTaxCategory
   * @return Item
   */
   public function setClassifiedTaxCategory(ClassifiedTaxCategory $classifiedTaxCategory)
   {
      $this->classifiedTaxCategory = $classifiedTaxCategory;
      return $this;
   }

   public function xmlSerialize(Writer $writer)
	{
      if (!empty($this->getDescription())){
         $writer->write([
            Schema::CBC . 'Description' => $this->getDescription(),
         ]);
      }

		$writer->write([
			Schema::CBC . 'Name' => $this->getName()
		]);

		if (!empty($this->getSellersItemIdentification())) {
			$writer->write([
				Schema::CAC . 'SellersItemIdentification' => [
					Schema::CBC . 'ID' => $this->getSellersItemIdentification()
				],
			]);
		}

		if (!empty($this->getClassifiedTaxCategory())) {
			$writer->write([
				Schema::CAC . 'ClassifiedTaxCategory' => $this->getClassifiedTaxCategory()
			]);
		}
	}
}
