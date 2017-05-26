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
 * Class for the science pack 3.
 * @author Chessmasterrr
 */
class SciencePack3 extends \Factorioplanner\Elements\Element
{

    /**
     * Constructor
     * @param Element $parent Parent element of this.
     * @param float $val Amount of items to produce per second.
     */
    public function __construct($parent, $val)
    {
        parent::__construct($parent, $val);
        $this->name = "sciencePack3";
        $this->image = "science-pack-3.png";
        $this->link = 'science_pack_3';
        $this->time = 12;
    }

    /**
     * Creates the dependencies as subtree and the producer for this element.
     */
    public function createDependencies()
    {
        $this->setProducer("assemblingmachine");
        $this->addDependency('Factorioplanner\Elements\Intermediateproduct\AdvancedCircuit', 1);
        $this->addDependency('Factorioplanner\Elements\Production\ElectricMiningDrill', 1);
        $this->addDependency('Factorioplanner\Elements\Intermediateproduct\EngineUnit', 1);
    }

}
