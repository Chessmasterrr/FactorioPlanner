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
 * Interface for the Element class.
 */
interface ElementInterface
{

    /**
     * Getter for the name
     */
    public function getName();

    /**
     * Getter for the icon name
     */
    public function getImage();

    /**
     * Adds a dependency to another element
     * @param $element Element to add a dependency for
     * @param $factor Factor of the needed elements for one piece of the current element
     */
    public function addDependency($element, $factor);

    /**
     * Gets the maximum tree width of the element with the dependency tree
     */
    public function getTreeWidth();

    /**
     * Draw the element and his dependency tree at a given position.
     * @param $x x-coordinate of the element
     * @param $y y-coordinate of the element
     */
    public function render($x, $y);

    /**
     * Getter for the production time of an element
     */
    public function getTime();
    
    /**
     * Creates the dependencies as subtree and the producer for this element.
     */
    public function createDependencies();
}
