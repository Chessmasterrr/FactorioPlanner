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
 * Abstract class for all furnaces to store their specific values.
 * @author Chessmasterrr
 */
abstract class Furnace extends Element
{

    protected $craftingSpeed; // crafting speed to indicate how long (relative to a player) a production of an item will take
    protected $energy; // the energy needed for a furnace

    /**
     * Getter
     * @return int Energy consumption of the furnace
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * Getter
     * @return float Crafting speed of the furnace
     */
    public function getCraftingSpeed()
    {
        return $this->craftingSpeed;
    }

}
