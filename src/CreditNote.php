<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class CreditNote extends Invoice
{

   private $UBLVersionID = '2.1';
   private $CustomizationID = 'urn:www.cenbii.eu:transaction:biitrns014:ver2.0:extended:urn:www.peppol.eu:bis:peppol5a:ver2.0:extended:urn:www.difi.no:ehf:kreditnota:ver2.0';
   private $ProfileID = 'urn:www.cenbii.eu:profile:bii05:ver2.0';
   private $OrderReference;
   private $Note;
	private $creditNoteReference;

   public function setProfileID(string $id)
   {
      $this->ProfileID = $id;
      return $this;
   }

   public function getProfileID()
   {
      return $this->ProfileID;
   }

   public function setNote(string $Note)
   {
      $this->Note = $Note;
      return $this;
   }

   public function getNote()
   {
      return $this->Note;
   }

	public function setCreditNoteReference(string $creditNoteReference)
   {
      $this->creditNoteReference = $creditNoteReference;
      return $this;
   }

   public function getCreditNoteReference()
   {
      return $this->creditNoteReference;
   }



   public function getOrderReference()
   {
      return $this->OrderReference;
   }

   public function setOrderReference($value)
   {
      $this->OrderReference = $value;
      return $this;
   }


   public function xmlSerialize(Writer $writer)
   {
      //$this->validate();

      $writer->write([
         Schema::CBC . 'UBLVersionID' => $this->UBLVersionID,
         Schema::CBC . 'CustomizationID' => $this->CustomizationID,
         Schema::CBC . 'ProfileID' => $this->ProfileID,
         Schema::CBC . 'ID' => $this->getId(),
         //Schema::CBC . 'CopyIndicator' => $this->isCopyIndicator() ? 'true' : 'false',
         Schema::CBC . 'IssueDate' => $this->getIssueDate()->format('Y-m-d')
      ]);


      if ($this->getNote() != null) {
         $writer->write([
            Schema::CBC . 'Note' => $this->getNote()
         ]);
      }


      $writer->write([
         'name' => Schema::CBC . 'DocumentCurrencyCode',
         'value' => 'NOK',
         'attributes' => [
            'listID' => 'ISO4217' //https://docs.peppol.eu/poacc/billing/3.0/codelist/UNCL1001-inv/
         ]
      ]);

		$writer->write([
         Schema::CAC . 'BillingReference' => [
				Schema::CAC . 'InvoiceDocumentReference' => [
					Schema::CBC . 'ID' => $this->getCreditNoteReference()
				]
			]
      ]);


      if ($this->getAdditionalDocumentReference() != null) {
         $writer->write([
            Schema::CAC . 'AdditionalDocumentReference' => $this->getAdditionalDocumentReference()
         ]);
      }

      if ($this->getOrderReference() != null) {
         $writer->write([
            Schema::CAC . 'OrderReference' => $this->getOrderReference()
         ]);
      }

      $writer->write([
         Schema::CAC . 'AccountingSupplierParty' => [Schema::CAC . "Party" => $this->getAccountingSupplierParty()],
         Schema::CAC . 'AccountingCustomerParty' => [Schema::CAC . "Party" => $this->getAccountingCustomerParty()],
      ]);

      if ($this->getPaymentMeans() != null) {
         $writer->write([
            Schema::CAC . 'PaymentMeans' => $this->getPaymentMeans()
         ]);
      }

      if ($this->getPaymentTerms() != null) {
         $writer->write([
            Schema::CAC . 'PaymentTerms' => $this->getPaymentTerms()
         ]);
      }

      if ($this->getAllowanceCharges() != null) {
         foreach ($this->getAllowanceCharges() as $creditNoteLine) {
            $writer->write([
               Schema::CAC . 'AllowanceCharge' => $creditNoteLine
            ]);
         }
      }

      if ($this->getTaxTotal() != null) {
         $writer->write([
            Schema::CAC . 'TaxTotal' => $this->getTaxTotal()
         ]);
      }

      $writer->write([
         Schema::CAC . 'LegalMonetaryTotal' => $this->getLegalMonetaryTotal()
      ]);

      foreach ($this->getInvoiceLines() as $creditNoteLine) {
         $writer->write([
            Schema::CAC . 'CreditNoteLine' => $creditNoteLine
         ]);
      }
   }
}
