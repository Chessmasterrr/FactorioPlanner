<?php
/*
 * Copyright (C) 2017 Chessmasterrr
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Factorioplanner\Elements;

/**
 * Abstract class for all drills to store their specific values.
 * @author Chessmasterrr
 */
abstract class Drill extends Element
{

    protected $miningPower; // mining power to indicate how strong a drill is
    protected $miningSpeed; // mining speed to indicate how fast a drill can mine

    /**
     * Getter
     * @return float Mining power of the drill.
     */
    public function getMiningPower()
    {
        return $this->miningPower;
    }

    /**
     * Getter
     * @return float Mining Speed of the drill.
     */
    public function getMiningSpeed()
    {
        return $this->miningSpeed;
    }

}
