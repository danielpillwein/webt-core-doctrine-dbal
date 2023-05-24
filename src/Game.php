<?php

namespace Lukas\WebtCoreDoctrineDbal;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity]
#[ORM\Table(name: 'games')]
class Game
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $game_id = null;
    #[ORM\Column(type: 'integer')]
    private int $player_one_id;
    #[ORM\Column(type: 'integer')]
    private int $player_two_id;
    #[ORM\Column(type: 'string')]
    private string $move_one;
    #[ORM\Column(type: 'string')]
    private string $move_two;
    #[ORM\Column(type: 'datetime')]
    private DateTime $date;

    /**
     * @param int|null $game_id
     */
    public function setGameId(?int $game_id): void
    {
        $this->game_id = $game_id;
    }

    public function getWinner(): int
    {
        if ($this->move_one == $this->move_two) {
            return 0;
        }

        $match = substr($this->move_one, 0, 1) . substr($this->move_two, 0, 1);

        $winner1 = ["RS", "PR", "SP"];

        if (in_array($match, $winner1)) {
            return 1;
        } else {
            return 2;
        }
    }
}