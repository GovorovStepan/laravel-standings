<?php

namespace App\Models;

class Team
{
    private string $id;
    private string $title;

    public function __construct(string $title)
    {
        $this->id = uniqid();
        $this->title = $title;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isEqual(Team $team): bool
    {
        return $this->id === $team->id;
    }


}
