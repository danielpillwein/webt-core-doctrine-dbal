<?php

namespace Lukas\WebtCoreDoctrineDbal;

class Player
{
    public function __construct(
        public int|null $player_id,
        public string $fname,
        public string $lname
    ){}

    /**
     * @param int $player_id
     */
    public function setPlayerId(int $player_id): void
    {
        $this->player_id = $player_id;
    }
}