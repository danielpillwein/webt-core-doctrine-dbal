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
    #[ORM\Column(type: 'string')]
    private string $lname;

    /**
     * @param int $player_id
     */
    public function setPlayerId(int $player_id): void
    {
        $this->player_id = $player_id;
    }
}