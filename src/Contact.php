<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Contact implements XmlSerializable
{
   private $telephone;
   private $telefax;
   private $electronicMail;
   private $id;
   private $name;

   /**
   * @return mixed
   */
   public function getTelephone()
   {
      return $this->telephone;
   }

   /**
   * @param mixed $telephone
   * @return Contact
   */
   public function setTelephone($telephone)
   {
      $this->telephone = $telephone;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getTelefax()
   {
      return $this->telefax;
   }

   /**
   * @param mixed $telefax
   * @return Contact
   */
   public function setTelefax($telefax)
   {
      $this->telefax = $telefax;
      return $this;
   }

   /**
   * @return mixed
   */
   public function getElectronicMail()
   {
      return $this->electronicMail;
   }

   /**
   * @param mixed $electronicMail
   * @return Contact
   */
   public function setElectronicMail($electronicMail)
   {
      $this->electronicMail = $electronicMail;
      return $this;
   }

   public function setID(string $id)
   {
      $this->id = $id;
      return $this;
   }

   public function getID()
   {
      return $this->id;
   }

   public function setName(string $name)
   {
      $this->name = $name;
      return $this;
   }

   public function getName()
   {
      return $this->name;
   }

   /**
   * The xmlSerialize method is called during xml writing.
   *
   * @param Writer $writer
   * @return void
   */
   function xmlSerialize(Writer $writer)
   {
   if ($this->getID() !== null) {
      $writer->write([
         Schema::CBC . 'ID' => $this->getID()
      ]);
   }

   if ($this->getName() !== null) {
      $writer->write([
         Schema::CBC . 'Name' => $this->getName()
      ]);
   }

   if ($this->getTelephone() !== null) {
      $writer->write([
         Schema::CBC . 'Telephone' => $this->getTelephone()
      ]);
   }

   if ( $this->getTelefax() !== null) {
      $writer->write([
         Schema::CBC . 'Telefax' => $this->getTelefax()
      ]);
   }

   if ($this->getElectronicMail() !== null) {
      $writer->write([
         Schema::CBC . 'ElectronicMail' => $this->getElectronicMail()
      ]);
   }

}
