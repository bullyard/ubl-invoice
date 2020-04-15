<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Party implements XmlSerializable
{
   private $name;
   private $postalAddress;
   private $physicalLocation;
   private $contact;
   private $companyId;
   private $taxScheme;
   private $legalEntity;
   private $appendCompanyID = 'MVA';
   private $schemeId = 'NO:VAT';
   private $schemeIdItentification = 'ZZZ';
   private $identificationId;
   private $endpointId;
   private $endpointScheme = 'NO:ORGNR';

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
   * @return Address
   */
   public function getPostalAddress()
   {
      return $this->postalAddress;
   }

   /**
   * @param Address $postalAddress
   * @return Party
   */
   public function setPostalAddress($postalAddress)
   {
      $this->postalAddress = $postalAddress;
      return $this;
   }

   /**
   * @return string
   */
   public function getCompanyId()
   {
      return $this->companyId;
   }

   /**
   * @param string $companyId
   */
   public function setCompanyId($companyId)
   {
      $this->companyId = $companyId;
   }

   /**
   * @param TaxScheme $taxScheme.
   * @return mixed
   */
   public function getTaxScheme()
   {
      return $this->taxScheme;
   }

   /**
   * @param TaxScheme $taxScheme
   */
   public function setTaxScheme(TaxScheme $taxScheme)
   {
      $this->taxScheme = $taxScheme;
   }

   /**
   * @return LegalEntity
   */
   public function getLegalEntity()
   {
      return $this->legalEntity;
   }

   /**
   * @param LegalEntity $legalEntity
   * @return Party
   */
   public function setLegalEntity(LegalEntity $legalEntity)
   {
      $this->legalEntity = $legalEntity;
      return $this;
   }

   /**
   * @return Address
   */
   public function getPhysicalLocation()
   {
      return $this->physicalLocation;
   }

   /**
   * @param Address $physicalLocation
   * @return Party
   */
   public function setPhysicalLocation(Address $physicalLocation)
   {
      $this->physicalLocation = $physicalLocation;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getContact()
   {
      return $this->contact;
   }

   /**
   * @param mixed $contact
   * @return Party
   */
   public function setContact($contact)
   {
      $this->contact = $contact;
      return $this;
   }

   /**
	 * @return mixed
	 */
	public function getIdentificationId()
	{
		return $this->identificationId;
	}

	/**
	 * @param mixed $identificationId
	 * @return mixed
	 */
	public function setIdentificationId($identificationId)
	{
		$this->identificationId = $identificationId;
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

      if ($this->getCompanyId() !== null){
         $writer->write([
            [
               'name' => Schema::CBC . 'EndpointID',
               'value' => $this->getCompanyId(),
               'attributes' => [
                  'schemeID' => $this->endpointScheme
               ]
            ]
   		]);
      }

      if ($this->getIdentificationId()) {
         $writer->write([
            Schema::CAC . 'PartyIdentification' => [
               [
                  'name' => Schema::CBC . 'ID',
                  'value' => $this->getIdentificationId(),
                  'attributes' => [
                     'schemeID' => $this->schemeIdItentification
                  ]
               ]
            ]
         ]);
      }

		$writer->write([
			Schema::CAC . 'PartyName' => [
				Schema::CBC . 'Name' => $this->getName()
			],
			Schema::CAC . 'PostalAddress' => $this->getPostalAddress()
		]);

		if ($this->getPhysicalLocation()) {
			$writer->write([
			   Schema::CAC . 'PhysicalLocation' => [Schema::CAC . 'Address' => $this->getPhysicalLocation()]
			]);
		}



		if ($this->getTaxScheme()) {
			$writer->write([
				Schema::CAC . 'PartyTaxScheme' => [
					Schema::CBC . 'RegistrationName' => $this->getName(),
               [
      				'name' => Schema::CBC . 'CompanyID',
      				'value' => $this->getCompanyId().$this->appendCompanyID,
      				'attributes' => [
      					'schemeID' => $this->schemeId
      				]
      			],

					Schema::CAC . 'TaxScheme' => $this->getTaxScheme()
				]
			]);
		}


      if ($this->getLegalEntity()) {
			$writer->write([
				Schema::CAC . 'PartyLegalEntity' => $this->getLegalEntity()
			]);
		}

		if ($this->getContact()) {
			$writer->write([
				Schema::CAC . 'Contact' => $this->getContact()
			]);
		}
	}
}
