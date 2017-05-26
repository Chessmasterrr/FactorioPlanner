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

namespace Factorioplanner\Elements\Intermediateproduct;

/**
 * Class for the solid fuel.
 * @author Chessmasterrr
 */
class SolidFuel extends \Factorioplanner\Elements\Element
{
    /**
     * Constructor
     * @param Element $parent Parent element of this.
     * @param float $val Amount of items to produce per second.
     */
    public function __construct($parent, $val)
    {
        parent::__construct($parent, $val);
        $this->name = 'solidFuel';
        $this->image = 'solid-fuel.png';
        $this->link = 'solid_fuel';
        $this->time = 3;
    }

    /**
     * Creates the dependencies as subtree and the producer for this element.
     */
    public function createDependencies()
    {
        $this->setProducer("chemicalplant");
        $this->addDependency('Factorioplanner\Elements\Intermediateproduct\PetroleumGas', 2);
    }

}
