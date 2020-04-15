<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Address implements XmlSerializable
{
   private $streetName;
   private $buildingNumber;
   private $cityName;
   private $postalZone;
   private $country;

   /**
   * @return mixed
   */
   public function getStreetName()
   {
      return $this->streetName;
   }

   /**
   * @param mixed $streetName
   * @return Address
   */
   public function setStreetName($streetName)
   {
      $this->streetName = $streetName;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getBuildingNumber()
   {
      return $this->buildingNumber;
   }

   /**
   * @param mixed $buildingNumber
   * @return Address
   */
   public function setBuildingNumber($buildingNumber)
   {
      $this->buildingNumber = $buildingNumber;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getCityName()
   {
      return $this->cityName;
   }

   /**
   * @param mixed $cityName
   * @return Address
   */
   public function setCityName($cityName)
   {
      $this->cityName = $cityName;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getPostalZone()
   {
      return $this->postalZone;
   }

   /**
   * @param mixed $postalZone
   * @return Address
   */
   public function setPostalZone($postalZone)
   {
      $this->postalZone = $postalZone;
      return $this;
   }

   /**
   * @return Country
   */
   public function getCountry()
   {
      return $this->country;
   }

   /**
   * @param Country $country
   * @return Address
   */
   public function setCountry(Country $country)
   {
      $this->country = $country;
      return $this;
   }


   /**
   * The xmlSerialize method is called during xml writing.
   *
   * @param Writer $writer
   * @return void
   */
   function xmlSerialize(Writer $writer)
	{
      if ($this->getStreetName() !== null){
         $writer->write([
   			Schema::CBC . 'StreetName' => $this->getStreetName(),
   		]);
      }

      if ($this->getCityName() !== null){
   		$writer->write([
   			Schema::CBC . 'CityName' => $this->getCityName(),
   		]);
      }

      if ($this->getPostalZone() !== null){
   		$writer->write([
   			Schema::CBC . 'PostalZone' => $this->getPostalZone(),
   		]);
      }

      if ($this->getCountry() !== null){
   		$writer->write([
   			Schema::CAC . 'Country' => $this->getCountry(),
   		]);
      }
	}
}
