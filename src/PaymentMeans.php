<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use DateTime;

class PaymentMeans implements XmlSerializable
{
    private $paymentMeansCode = 1;
    private $paymentDueDate;
    private $instructionId;
    private $PayeeFinancialAccount;


    /**
     * @return mixed
     */
    public function getPaymentMeansCode()
    {
        return $this->paymentMeansCode;
    }

    /**
     * @param mixed $paymentMeansCode
     * @return PaymentMeans
     */
    public function setPaymentMeansCode($paymentMeansCode)
    {
        $this->paymentMeansCode = $paymentMeansCode;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPaymentDueDate()
    {
        return $this->paymentDueDate;
    }

    /**
     * @param \DateTime $paymentDueDate
     * @return PaymentMeans
     */
    public function setPaymentDueDate(\DateTime $paymentDueDate)
    {
        $this->paymentDueDate = $paymentDueDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstructionId()
    {
        return $this->instructionId;
    }

    /**
     * @param mixed $instructionId
     * @return PaymentMeans
     */
    public function setInstructionId($instructionId)
    {
        $this->instructionId = $instructionId;
        return $this;
    }

    /**
	 * @return mixed
	 */
	public function getPayeeFinancialAccount()
	{
		return $this->PayeeFinancialAccount;
	}

	/**
	 * @param mixed $orderReference
	 * @return PaymentMeansEHF
	 */
	public function setPayeeFinancialAccount(PayeeFinancialAccount $account)
	{
		$this->PayeeFinancialAccount = $account;
		return $this;
	}

   function xmlSerialize(Writer $writer)
 	{
 		$writer->write([
 			'name' => Schema::CBC . 'PaymentMeansCode',
 			'value' => $this->paymentMeansCode,
 			'attributes' => [
 				'listID' => 'UNCL4461'
 			]
 		]);

 		if ($this->getPaymentDueDate() !== null) {
 			$writer->write([
 				Schema::CBC . 'PaymentDueDate' => $this->getPaymentDueDate()->format('Y-m-d')
 			]);
 		}

      if ($this->getPayeeFinancialAccount() !== null) {
 			$writer->write([
 				Schema::CAC . 'PayeeFinancialAccount' => $this->getPayeeFinancialAccount()
 			]);
 		}

 		if ($this->getInstructionId() !== null) {
 			$writer->write([
 				Schema::CBC . 'InstructionID' => $this->getInstructionId()
 			]);
 		}
 	}
}
