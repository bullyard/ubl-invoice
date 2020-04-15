<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Country implements XmlSerializable
{
   private $identificationCode;
   private $listID = 'ISO3166-1:Alpha2';

   /**
   * @return mixed
   */
   public function getIdentificationCode()
   {
      return $this->identificationCode;
   }

   /**
   * @param mixed $identificationCode
   * @return Country
   */
   public function setIdentificationCode($identificationCode)
   {
      $this->identificationCode = $identificationCode;
      return $this;
   }

   public function setListID(string $listID)
   {
      $this->listID = $listID;
      return $this;
   }

   public function getListID()
   {
      return $this->listID;
   }

   /**
   * The xmlSerialize method is called during xml writing.
   *
   * @param Writer $writer
   * @return void
   */
   function xmlSerialize(Writer $writer)
	{
		$writer->write(
         [
            'name' => Schema::CBC . 'IdentificationCode',
            'value' => $this->getIdentificationCode(),
            'attributes' => [
               'listID' => $this->getListID()
            ]
         ]
      );
	}
}
