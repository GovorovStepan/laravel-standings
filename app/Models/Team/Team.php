<?php

namespace App\Models\Team;

class Team
{
    private string $id;
    private string $title;

    public function __construct(string $title)
    {
        $this->id = uniqid();
        $this->title = $title;
    }

    /**
     * @param Team $team
     * @return bool
     * Method for command identification
     */
    public function isEqual(Team $team): bool
    {
        return $this->id === $team->getId();
    }

    /**
     * @return string
     * ID getter
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     * Title getter
     */
    public function getTitle(): string
    {
        return $this->title;
    }




}
