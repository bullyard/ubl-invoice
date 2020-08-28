<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class LegalEntity implements XmlSerializable
{
   private $registrationName;
   private $companyId;
   private $registrationAddress;
   private $name;

   public function getRegistrationName()
   {
      return $this->registrationName;
   }

   public function setRegistrationName($registrationName)
   {
      $this->registrationName = $registrationName;
   }

   public function getCompanyId()
   {
      return $this->companyId;
   }

   public function setCompanyId($companyId)
   {
      $this->companyId = $companyId;
   }


   public function getRegistrationAddress()
   {
      return $this->registrationAddress;
   }

   /**
   * @param Address $registrationAddress.
   * @return mixed
   */
   public function setRegistrationAddress($registrationAddress)
   {
      $this->registrationAddress = $registrationAddress;
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
   * @return Party
   */
   public function setName($name)
   {
      $this->name = $name;
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
		$writer->write([
         Schema::CBC . 'RegistrationName' => $this->getRegistrationName(),

      ]);

      $writer->write([
         'name' => Schema::CBC . 'CompanyID',
         'value' => $this->getCompanyId()

      ]);


      if ($this->getRegistrationAddress()){
         $writer->write([
   			Schema::CBC . 'RegistrationAddress' => $this->getRegistrationAddress()
   		]);
      }
	}
}
