<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Invoice implements XmlSerializable
{
    private $UBLVersionID = '2.1';
    private $CustomizationID = 'urn:cen.eu:en16931:2017#compliant#urn:fdc:peppol.eu:2017:poacc:billing:3.0';
    private $ProfileID = 'urn:fdc:peppol.eu:2017:poacc:billing:01:1.0';
    private $OrderReference;
    private $BuyerReference;
    private $Note;
    private $id;
    private $copyIndicator = false;
    private $issueDate;
    private $invoiceTypeCode = InvoiceTypeCode::INVOICE;
    private $taxPointDate;
    private $dueDate;
    private $paymentTerms;
    private $accountingSupplierParty;
    private $accountingCustomerParty;
    private $paymentMeans;
    private $taxTotal;
    private $legalMonetaryTotal;
    private $invoiceLines;
    private $allowanceCharges;
    private $additionalDocumentReference = array();
    private $documentCurrencyCode = 'NOK';
    private $documentType =  "Invoice";


    /**
     * @return string
     */
    public function getUBLVersionID()
    {
        return $this->UBLVersionID;
    }

    /**
     * @param string $UBLVersionID
     * eg. '2.0', '2.1', '2.2', ...
     * @return Invoice
     */
    public function setUBLVersionID(string $UBLVersionID)
    {
        $this->UBLVersionID = $UBLVersionID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Invoice
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCopyIndicator()
    {
        return $this->copyIndicator;
    }

    /**
     * @param bool $copyIndicator
     * @return Invoice
     */
    public function setCopyIndicator(bool $copyIndicator)
    {
        $this->copyIndicator = $copyIndicator;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * @param \DateTime $issueDate
     * @return Invoice
     */
    public function setIssueDate(\DateTime $issueDate)
    {
        $this->issueDate = $issueDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $dueDate
     * @return Invoice
     */
    public function setDueDate(\DateTime $dueDate)
    {
        $this->dueDate = $dueDate;
        return $this;
    }




    /**
     * @param mixed $currencyCode
     * @return Invoice
     */
    public function setDocumentCurrencyCode(string $currencyCode = 'NOK')
    {
        $this->documentCurrencyCode = $currencyCode;
        return $this;
    }

    public function getDocumentCurrencyCode()
    {
        return $this->documentCurrencyCode;
    }


    /**
     * @return string
     */
    public function getInvoiceTypeCode()
    {
        return $this->invoiceTypeCode;
    }

    /**
     * @param string $invoiceTypeCode
     * See also: src/InvoiceTypeCode.php
     * @return Invoice
     */
    public function setInvoiceTypeCode(string $invoiceTypeCode)
    {
        $this->invoiceTypeCode = $invoiceTypeCode;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getTaxPointDate()
    {
        return $this->taxPointDate;
    }

    /**
     * @param DateTime $taxPointDate
     * @return Invoice
     */
    public function setTaxPointDate(\DateTime $taxPointDate)
    {
        $this->taxPointDate = $taxPointDate;
        return $this;
    }

    /**
     * @return PaymentTerms
     */
    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    /**
     * @param PaymentTerms $paymentTerms
     * @return Invoice
     */
    public function setPaymentTerms(PaymentTerms $paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;
        return $this;
    }

    /**
     * @return Party
     */
    public function getAccountingSupplierParty()
    {
        return $this->accountingSupplierParty;
    }

    /**
     * @param Party $accountingSupplierParty
     * @return Invoice
     */
    public function setAccountingSupplierParty(Party $accountingSupplierParty)
    {
        $this->accountingSupplierParty = $accountingSupplierParty;
        return $this;
    }

    /**
     * @return Party
     */
    public function getAccountingCustomerParty()
    {
        return $this->accountingCustomerParty;
    }

    /**
     * @param Party $accountingCustomerParty
     * @return Invoice
     */
    public function setAccountingCustomerParty(Party $accountingCustomerParty)
    {
        $this->accountingCustomerParty = $accountingCustomerParty;
        return $this;
    }

    /**
     * @return PaymentMeans
     */
    public function getPaymentMeans()
    {
        return $this->paymentMeans;
    }

    /**
     * @param PaymentMeans $paymentMeans
     * @return Invoice
     */
    public function setPaymentMeans(PaymentMeans $paymentMeans)
    {
        $this->paymentMeans = $paymentMeans;
        return $this;
    }

    /**
     * @return TaxTotal
     */
    public function getTaxTotal()
    {
        return $this->taxTotal;
    }

    /**
     * @param TaxTotal $taxTotal
     * @return Invoice
     */
    public function setTaxTotal(TaxTotal $taxTotal)
    {
        $this->taxTotal = $taxTotal;
        return $this;
    }

    /**
     * @return LegalMonetaryTotal
     */
    public function getLegalMonetaryTotal()
    {
        return $this->legalMonetaryTotal;
    }

    /**
     * @param LegalMonetaryTotal $legalMonetaryTotal
     * @return Invoice
     */
    public function setLegalMonetaryTotal(LegalMonetaryTotal $legalMonetaryTotal)
    {
        $this->legalMonetaryTotal = $legalMonetaryTotal;
        return $this;
    }

    /**
     * @return InvoiceLine[]
     */
    public function getInvoiceLines()
    {
        return $this->invoiceLines;
    }

    /**
     * @param InvoiceLine[] $invoiceLines
     * @return Invoice
     */
    public function setInvoiceLines(array $invoiceLines)
    {
        $this->invoiceLines = $invoiceLines;
        return $this;
    }

    /**
     * @return AllowanceCharge[]
     */
    public function getAllowanceCharges()
    {
        return $this->allowanceCharges;
    }

    /**
     * @param AllowanceCharge[] $allowanceCharges
     * @return Invoice
     */
    public function setAllowanceCharges(array $allowanceCharges)
    {
        $this->allowanceCharges = $allowanceCharges;
        return $this;
    }

    /**
     * @return AdditionalDocumentReference
     */
    public function getAdditionalDocumentReference()
    {
        return $this->additionalDocumentReference;
    }

    /**
     * @param AdditionalDocumentReference $additionalDocumentReference
     * @return Invoice
     */
    public function setAdditionalDocumentReference(AdditionalDocumentReference $additionalDocumentReference)
    {
        $this->additionalDocumentReference[] = $additionalDocumentReference;
        return $this;
    }

    public function setProfileID(string $id)
   {
      $this->ProfileID = $id;
      return $this;
   }

   public function getProfileID()
   {
      return $this->ProfileID;
   }

   public function getCustomizationID(){
   		return $this->CustomizationID;
   }

   public function setCustomizationID($CustomizationID){
   		$this->CustomizationID = $CustomizationID;
      return $this;
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


   public function getOrderReference()
   {
      return $this->OrderReference;
   }

   public function setOrderReference($value)
   {
      $this->OrderReference = $value;
      return $this;
   }

   public function getBuyerReference()
   {
      return $this->BuyerReference;
   }

   public function setBuyerReference($value)
   {
      $this->BuyerReference = $value;
      return $this;
   }

   public function getDocumentType()
   {
      return $this->documentType;
   }

    /**
     * The validate function that is called during xml writing to valid the data of the object.
     *
     * @return void
     * @throws InvalidArgumentException An error with information about required data that is missing to write the XML
     */
    public function validate()
    {
        if ($this->id === null) {
            throw new \InvalidArgumentException('Missing invoice id');
        }

        if ($this->id === null) {
            throw new \InvalidArgumentException('Missing invoice id');
        }

        if (!$this->issueDate instanceof \DateTime) {
            throw new \InvalidArgumentException('Invalid invoice issueDate');
        }

        if ($this->invoiceTypeCode === null) {
            throw new \InvalidArgumentException('Missing invoice invoiceTypeCode');
        }

        if ($this->accountingSupplierParty === null) {
            throw new \InvalidArgumentException('Missing invoice accountingSupplierParty');
        }

        if ($this->accountingCustomerParty === null) {
            throw new \InvalidArgumentException('Missing invoice accountingCustomerParty');
        }

        if ($this->invoiceLines === null) {
            throw new \InvalidArgumentException('Missing invoice lines');
        }

        if ($this->legalMonetaryTotal === null) {
            throw new \InvalidArgumentException('Missing invoice LegalMonetaryTotal');
        }
    }

   /**
   * The xmlSerialize method is called during xml writing.
   * @param Writer $writer
   * @return void
   */
   public function xmlSerialize(Writer $writer)
   {
      $this->validate();

      $writer->write([
         //Schema::CBC . 'UBLVersionID' => $this->UBLVersionID,
         Schema::CBC . 'CustomizationID' => $this->CustomizationID,
         Schema::CBC . 'ProfileID' => $this->ProfileID,
         Schema::CBC . 'ID' => $this->getId(),
         //Schema::CBC . 'CopyIndicator' => $this->isCopyIndicator() ? 'true' : 'false',
         Schema::CBC . 'IssueDate' => $this->getIssueDate()->format('Y-m-d'),
         Schema::CBC . 'DueDate' => $this->getDueDate()->format('Y-m-d'),
         [
            Schema::CBC . 'InvoiceTypeCode' => $this->getInvoiceTypeCode() //https://docs.peppol.eu/poacc/billing/3.0/codelist/UNCL1001-inv/

         ]
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
         Schema::CBC . 'DocumentCurrencyCode' => $this->getDocumentCurrencyCode()
      ]);


      // cbc:TaxCurrencyCode

      // cbc:AccountingCost

      if ($this->getBuyerReference() != null) {
         $writer->write([
            Schema::CBC . 'BuyerReference' => $this->getBuyerReference()
         ]);
      }

      //  cac:InvoicePeriod

      if ($this->getOrderReference() != null) {
         $writer->write([
            Schema::CAC . 'OrderReference' => $this->getOrderReference()
         ]);
      }

      // cac:BillingReference

      // cac:DespatchDocumentReference

      // cac:ReceiptDocumentReference

      // cac:OriginatorDocumentReference

      // cac:ContractDocumentReference

      if ($this->getAdditionalDocumentReference() != null && !empty($this->getAdditionalDocumentReference())) {
         foreach ($this->getAdditionalDocumentReference() as $key => $AddDocRef) {
            $writer->write([
               Schema::CAC . 'AdditionalDocumentReference' => $AddDocRef
            ]);
         }

      }

      // cac:ProjectReference

      $writer->write([
         Schema::CAC . 'AccountingSupplierParty' => [Schema::CAC . "Party" => $this->getAccountingSupplierParty()],
         Schema::CAC . 'AccountingCustomerParty' => [Schema::CAC . "Party" => $this->getAccountingCustomerParty()],
      ]);

      // cac:PayeeParty

      // cac:TaxRepresentativeParty

      // cac:Delivery

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
