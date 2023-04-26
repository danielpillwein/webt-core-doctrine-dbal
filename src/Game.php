<?php

namespace Lukas\WebtCoreDoctrineDbal;

class Game
{
    public function __construct(
        public string $name_one,
        public string $name_two,
        public string $move_one,
        public string $move_two,
        public string $date,
        public int $winner
    )
    {}
}