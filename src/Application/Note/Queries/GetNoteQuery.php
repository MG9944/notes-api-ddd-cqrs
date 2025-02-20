<?php

namespace App\Application\Note\Queries;

class GetNoteQuery
{
 public int $idNote;

    public function __construct(int $idNote)
    {
        $this->idNote = $idNote;
    }


}