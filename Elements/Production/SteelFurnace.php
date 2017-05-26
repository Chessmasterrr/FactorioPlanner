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

namespace Factorioplanner\Elements\Production;

/**
 * Class for the steel furnace.
 * @author Chessmasterrr
 */
class SteelFurnace extends \Factorioplanner\Elements\Furnace
{
/**
     * Constructor
     * @param Element $parent Parent element of this.
     * @param float $val Amount of items to produce per second.
     */
    public function __construct($parent, $val)
    {
        parent::__construct($parent, $val);
        $this->name = "steelFurnace";
        $this->image = "steel-furnace.png";
        $this->link = 'steel_furnace';
        $this->craftingSpeed = 2;
        $this->energy = 180;
        $this->time = 3;
    }

    /**
     * Creates the dependencies as subtree and the producer for this element.
     */
    public function createDependencies()
    {
        $this->addDependency('Factorioplanner\Elements\Intermediateproduct\SteelPlate', 6);
        $this->addDependency('Factorioplanner\Elements\Logistic\StoneBrick', 10);
    }

}
