<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Reminder extends Invoice
{

   private $CustomizationID = 'urn:cen.eu:en16931:2017#compliant#urn:fdc:peppol.eu:2017:poacc:billing:3.0#conformant#urn:fdc:anskaffelser.no:2019:ehf:reminder:3.0';
   private $ProfileID = 'urn:fdc:anskaffelser.no:2019:ehf:postaward:g3:06:1.0';


   public function setProfileID(string $id)
   {
      $this->ProfileID = $id;
      return $this;
   }

   public function getProfileID()
   {
      return $this->ProfileID;
   }


   public function setReminderReference(string $reminderReference)
   {
      $this->reminderReference = $reminderReference;
      return $this;
   }

   public function getReminderReference()
   {
      return $this->reminderReference;
   }


   public function xmlSerialize(Writer $writer)
   {
      //$this->validate();

      $writer->write([

         Schema::CBC . 'CustomizationID' => $this->CustomizationID,
         Schema::CBC . 'ProfileID' => $this->ProfileID,
         Schema::CBC . 'ID' => $this->getId(),
         //Schema::CBC . 'CopyIndicator' => $this->isCopyIndicator() ? 'true' : 'false',
         Schema::CBC . 'IssueDate' => $this->getIssueDate()->format('Y-m-d'),
         Schema::CBC . 'DueDate' => $this->getDueDate()->format('Y-m-d')
      ]);


      if ($this->getNote() != null) {
         $writer->write([
            Schema::CBC . 'Note' => $this->getNote()
         ]);
      }

      if ($this->getTaxPointDate() != null) {
         $writer->write([
            Schema::CBC . 'TaxPointDate' => $this->getTaxPointDate()->format('Y-m-d')
         ]);
      }

      $writer->write([
         'name' => Schema::CBC . 'DocumentCurrencyCode',
         'value' => 'NOK'
      ]);

      if ($this->getBuyerReference() != null) {
         $writer->write([
            Schema::CBC . 'BuyerReference' => $this->getBuyerReference()
         ]);
      }

      if ($this->getAdditionalDocumentReference() != null) {
         $writer->write([
            Schema::CAC . 'AdditionalDocumentReference' => $this->getAdditionalDocumentReference()
         ]);
      }

      $writer->write([
         Schema::CAC . 'BillingReference' => [
         	Schema::CAC . 'InvoiceDocumentReference' => [
					Schema::CBC . 'ID' => $this->getReminderReference()
				]
         ]
      ]);

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
         foreach ($this->getAllowanceCharges() as $invoiceLine) {
            $writer->write([
               Schema::CAC . 'AllowanceCharge' => $invoiceLine
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

      foreach ($this->getInvoiceLines() as $invoiceLine) {
         $writer->write([
            Schema::CAC . 'InvoiceLine' => $invoiceLine
         ]);
      }
   }
}
