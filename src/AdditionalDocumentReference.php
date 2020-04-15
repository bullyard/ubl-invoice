<?php

namespace Bullyard\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class AdditionalDocumentReference implements XmlSerializable
{
    private $id;
    private $documentType;
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
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * @param String $documentType
     * @return AdditionalDocumentReference
     */
    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;
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
    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            Schema::CBC . 'ID' => $this->id,
            Schema::CBC . 'DocumentType' => $this->documentType,
            Schema::CAC . 'Attachment' => $this->attachment,
        ]);
    }
}
