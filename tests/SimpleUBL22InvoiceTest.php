<?php

namespace Bullyard\UBL\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Test an UBL2.2 invoice document
 */
class SimpleUBL22InvoiceTest extends TestCase
{
    private $schema = 'http://docs.oasis-open.org/ubl/os-UBL-2.2/xsd/maindoc/UBL-Invoice-2.2.xsd';

    /** @test */
    public function testIfXMLIsValid()
    {
        // Address country
        $country = (new \Bullyard\UBL\Country())
            ->setIdentificationCode('BE');

        // Full address
        $address = (new \Bullyard\UBL\Address())
            ->setStreetName('Korenmarkt')
            ->setBuildingNumber(1)
            ->setCityName('Gent')
            ->setPostalZone('9000')
            ->setCountry($country);

        // Supplier company node
        $supplierCompany = (new \Bullyard\UBL\Party())
            ->setName('Supplier Company Name')
            ->setPhysicalLocation($address)
            ->setPostalAddress($address);

        // Client company node
        $clientCompany = (new \Bullyard\UBL\Party())
            ->setName('My client')
            ->setPostalAddress($address);

        $legalMonetaryTotal = (new \Bullyard\UBL\LegalMonetaryTotal())
            ->setPayableAmount(10 + 2)
            ->setAllowanceTotalAmount(0);

        // Tax scheme
        $taxScheme = (new \Bullyard\UBL\TaxScheme())
            ->setId(0);

        // Product
        $productItem = (new \Bullyard\UBL\Item())
            ->setName('Product Name')
            ->setDescription('Product Description');

        // Price
        $price = (new \Bullyard\UBL\Price())
            ->setBaseQuantity(1)
            ->setUnitCode(\Bullyard\UBL\UnitCode::UNIT)
            ->setPriceAmount(10);

        // Invoice Line tax totals
        $lineTaxTotal = (new \Bullyard\UBL\TaxTotal())
            ->setTaxAmount(2.1);

        // Invoice Line(s)
        $invoiceLine = (new \Bullyard\UBL\InvoiceLine())
            ->setId(0)
            ->setItem($productItem)
            ->setPrice($price)
            ->setTaxTotal($lineTaxTotal)
            ->setInvoicedQuantity(1);

        $invoiceLines = [$invoiceLine];

        // Total Taxes
        $taxCategory = (new \Bullyard\UBL\TaxCategory())
            ->setId(0)
            ->setName('VAT21%')
            ->setPercent(.21)
            ->setTaxScheme($taxScheme);

        $taxSubTotal = (new \Bullyard\UBL\TaxSubTotal())
            ->setTaxableAmount(10)
            ->setTaxAmount(2.1)
            ->setTaxCategory($taxCategory);

        $taxTotal = (new \Bullyard\UBL\TaxTotal())
            ->addTaxSubTotal($taxSubTotal)
            ->setTaxAmount(2.1);

        // Invoice object
        $invoice = (new \Bullyard\UBL\Invoice())
            ->setUBLVersionID('2.2')
            ->setId(1234)
            ->setIssueDate(new \DateTime())
            ->setAccountingSupplierParty($supplierCompany)
            ->setAccountingCustomerParty($clientCompany)
            ->setInvoiceLines($invoiceLines)
            ->setLegalMonetaryTotal($legalMonetaryTotal)
            ->setTaxTotal($taxTotal);

        // Test created object
        // Use \Bullyard\UBL\Generator to generate an XML string
        $generator = new \Bullyard\UBL\Generator();
        $outputXMLString = $generator->invoice($invoice);

        // Create PHP Native DomDocument object, that can be
        // used to validate the generate XML
        $dom = new \DOMDocument;
        $dom->loadXML($outputXMLString);

        $this->assertEquals(true, $dom->schemaValidate($this->schema));
    }
}
