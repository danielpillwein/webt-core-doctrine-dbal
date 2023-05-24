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
     * @return int
     */
    public function getPlayerTwoId(): int
    {
        return $this->player_two_id;
    }

    /**
     * @param int $player_two_id
     */
    public function setPlayerTwoId(int $player_two_id): void
    {
        $this->player_two_id = $player_two_id;
    }

    /**
     * @return string
     */
    public function getMoveOne(): string
    {
        return $this->move_one;
    }

    /**
     * @param string $move_one
     */
    public function setMoveOne(string $move_one): void
    {
        $this->move_one = $move_one;
    }

    /**
     * @return string
     */
    public function getMoveTwo(): string
    {
        return $this->move_two;
    }

    /**
     * @param string $move_two
     */
    public function setMoveTwo(string $move_two): void
    {
        $this->move_two = $move_two;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getPlayerOneId(): int
    {
        return $this->player_one_id;
    }

    /**
     * @param int $player_one_id
     */
    public function setPlayerOneId(int $player_one_id): void
    {
        $this->player_one_id = $player_one_id;
    }

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