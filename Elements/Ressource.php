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
 * Abstract class for all ressources to store their specific values.
 * @author Chessmasterrr
 */
abstract class Ressource extends Element
{

    protected $miningHardness; // Mining hardness to indicate how hard a ressource is to mine
    protected $miningTime; // Mining time to indicat how long mining this ressource will take

    /**
     * Getter
     * @return float Mining hardness of the ressource
     */
    public function getMiningHardness()
    {
        return $this->miningHardness;
    }

    /**
     * Getter
     * @return float Mining time of the ressource
     */
    public function getMiningTime()
    {
        return $this->miningTime;
    }

}
