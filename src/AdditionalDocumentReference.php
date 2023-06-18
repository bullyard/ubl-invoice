<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class AdditionalDocumentReference implements XmlSerializable
{
   private $id;
   private $documentTypeCode;
   private $attachment;

   /**
   * @return String
   */
   public function getId()
   {
      return $this->id;
   }

   /**
   * @param String $id
   * @return AdditionalDocumentReference
   */
   public function setId($id)
   {
      $this->id = $id;
      return $this;
   }

   /**
   * @return String
   */
   public function getDocumentTypeCode()
   {
      return $this->documentTypeCode;
   }

   /**
   * @param String $documentTypeCode
   * @return AdditionalDocumentReference
   */
   public function setDocumentTypeCode($documentTypeCode)
   {
      $this->documentTypeCode = $documentTypeCode;
      return $this;
   }

   /**
   * @return Attachment
   */
   public function getAttachment()
   {
      return $this->attachment;
   }

   /**
   * @param Attachment $attachment
   * @return Attachment
   */
   public function setAttachment(Attachment $attachment)
   {
      $this->attachment = $attachment;
      return $this;
   }

   /**
   * The xmlSerialize method is called during xml writing.
   *
   * @param Writer $writer
   * @return void
   */
   public function xmlSerialize(Writer $writer){

      if($this->getDocumentTypeCode() !== null){
         $writer->write([
            Schema::CBC . 'ID' => $this->id,
            Schema::CBC . 'DocumentTypeCode' => $this->documentTypeCode,
            Schema::CAC . 'Attachment' => $this->attachment,
         ]);

      }else{
         $writer->write([
            Schema::CBC . 'ID' => $this->id,
            Schema::CAC . 'Attachment' => $this->attachment,
         ]);

      }
   }

}
