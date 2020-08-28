<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;


class PayeeFinancialAccount implements XmlSerializable
{
	private $Id;


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


	function xmlSerialize(Writer $writer)
	{

		if ($this->getId() !== null) {
			$writer->write([
				Schema::CBC . 'ID' => $this->getId(),

			]);

		}
	}
}
