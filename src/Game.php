<?php

namespace Lukas\WebtCoreDoctrineDbal;

class Game
{
    public function __construct(
        public int|null $game_id,
        public Player   $player_one,
        public Player   $player_two,
        public string   $move_one,
        public string   $move_two,
        public string   $date
    )
    {
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