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
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $move_one;
    #[ORM\Column(type: 'string')]
    private string $move_two;
    #[ORM\Column(type: 'datetime')]
    private DateTime $date;
    #[ORM\ManyToOne(targetEntity: Player::class)]
    private Player|null $player_one = null;
    #[ORM\ManyToOne(targetEntity: Player::class)]
    private Player|null $player_two = null;

    /**
     * @return Player|null
     */
    public function getPlayerOne(): ?Player
    {
        return $this->player_one;
    }

    /**
     * @param Player|null $player_one
     */
    public function setPlayerOne(?Player $player_one): void
    {
        $this->player_one = $player_one;
    }

    /**
     * @return Player|null
     */
    public function getPlayerTwo(): ?Player
    {
        return $this->player_two;
    }

    /**
     * @param Player|null $player_two
     */
    public function setPlayerTwo(?Player $player_two): void
    {
        $this->player_two = $player_two;
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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
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