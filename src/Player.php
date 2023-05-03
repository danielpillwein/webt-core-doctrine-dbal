<?php

namespace Lukas\WebtCoreDoctrineDbal;

class Player
{
    public function __construct(
        public string $fname,
        public string $lname
    ){}
}