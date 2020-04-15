<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;


class PayeeFinancialAccount implements XmlSerializable
{
	private $Id;
	private $IdScheme = "BBAN";

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->Id;
	}

	/**
	 * @param mixed $setId
	 * @return PayeeFinancialAccount
	 */
	public function setId(string $accountNumber)
	{
		$this->Id = $accountNumber;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdScheme()
	{
		return $this->IdScheme;
	}

	/**
	 * @param mixed $IdScheme
	 * @return PayeeFinancialAccount
	 */
	public function setIdScheme(string $IdScheme)
	{
		$this->IdScheme = $IdScheme;
		return $this;
	}

	function xmlSerialize(Writer $writer)
	{

		if ($this->getId() !== null) {
			$writer->write([
				'name' => Schema::CBC . 'ID',
				'value' => $this->getId(),
				'attributes' => [
					'schemeID' => $this->getIdScheme()
				]
			]);

		}
	}
}
