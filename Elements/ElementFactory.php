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
 * Factory class for the elements
 * @author Chessmasterrr
 */
class ElementFactory
{

    private static $instance; // singleton pattern

    private function __construct() // singleton pattern
    {
        
    }

    private function __clone() // singleton pattern
    {
        
    }

    public static function getInstance() // singleton pattern
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Gets all known elements
     * @return Array with all elements.
     */
    public function getAllElements()
    {
        $elements = array_merge($this->getProductionElements(),
                $this->getIntermediateProductElements(),
                $this->getRessorceElements(),
                $this->getCombatElements(),
                $this->getLogisticElements());

        usort($elements, array($this, "cmp"));
        
        return $elements;
    }
    
    /**
     * Compares two elements with names for sorting.
     * @param Element $a
     * @param Element $b
     * @return int
     */
    private function cmp($a, $b) {
        $aName = $a->getName();
        $bName = $b->getName();
        if ($aName == $bName) {
            return 0;
        }
        if ($aName > $bName) {
            return 1;
        } else {
            return -1;
        }
    }

    /**
     * Gets all known logistic elements
     * @return Array with all logistic elements.
     */
    public function getLogisticElements()
    {
        return $this->getElementsFromFolder("Logistic");
    }
    
    /**
     * Gets all known combat
     * @return Array with all combat elements.
     */
    public function getCombatElements()
    {
        return $this->getElementsFromFolder("Combat");
    }
    
    /**
     * Gets all known production elements
     * @return Array with all production elements.
     */
    public function getProductionElements()
    {
        return $this->getElementsFromFolder("Production");
    }

    /**
     * Gets all known intermediate product elements
     * @return Array with all intermediate product elements.
     */
    public function getIntermediateProductElements()
    {
        return $this->getElementsFromFolder("Intermediateproduct");
    }
    
    /**
     * Creates an array with all elements in a folder.
     * @param  string $folder Folder to create the elements from
     * @return Array with all elements of a folder.
     */
    private function getElementsFromFolder($folder) {
        $elements = array();

        // get files from folder
        $files = scandir("Elements/$folder");
        foreach ($files as $file) {
            if (strcmp(substr($file, -4), '.php') === 0) {
                $classname = substr($file, 0, -4);
                array_push($elements, $this->createElement("Factorioplanner\\Elements\\$folder\\$classname"));
            }
        }

        return $elements;
    }

    /**
     * Gets all known ressource elements
     * @return Array with all ressource elements.
     */
    public function getRessorceElements()
    {
        return $this->getElementsFromFolder("Ressource");
    }

    /**
     * Creates an element.
     * @param $name Name of the class to create
     * @param $parent Parent of the class to create
     * @param $val Value of the class to create
     * @return Created element
     */
    public function createElement($name, $parent = null, $val = 0)
    {
        return new $name($parent, $val);
    }

}
