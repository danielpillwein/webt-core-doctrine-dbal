<?php

namespace Lukas\WebtCoreDoctrineDbal;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'players')]
class Player
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $player_id = null;
    #[ORM\Column(type: 'string')]
    private string $fname;

    /**
     * @return string
     */
    public function getFname(): string
    {
        return $this->fname;
    }

    /**
     * @param string $fname
     */
    public function setFname(string $fname): void
    {
        $this->fname = $fname;
    }

    /**
     * @return string
     */
    public function getLname(): string
    {
        return $this->lname;
    }

    /**
     * @param string $lname
     */
    public function setLname(string $lname): void
    {
        $this->lname = $lname;
    }
    #[ORM\Column(type: 'string')]
    private string $lname;

    /**
     * @param int $player_id
     */
    public function setPlayerId(int $player_id): void
    {
        $this->player_id = $player_id;
    }

    /**
     * @return int|null
     */
    public function getPlayerId(): ?int
    {
        return $this->player_id;
    }
}