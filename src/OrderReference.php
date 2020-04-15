<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use DateTime;

class OrderReference implements XmlSerializable
{
	private $OrderReference;
	private $id;

	/**
	 * @return mixed
	 */
	public function getPOrderReference()
	{
		return $this->OrderReference;
	}

	/**
	 * @param mixed $orderReference
	 * @return PaymentMeans
	 */
	public function setPOrderReference($orderReference)
	{
		$this->orderReference = $orderReference;
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
	 * @return PaymentMeans
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	function xmlSerialize(Writer $writer)
	{

		if ($this->getId() !== null) {
			$writer->write([
				Schema::CBC . 'ID' => $this->getId()
			]);
		}
	}
}
