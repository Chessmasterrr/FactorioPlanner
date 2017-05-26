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
 * Abstract class for all elements to hold their specific values.
 * @author Chessmasterrr
 */
abstract class Element implements ElementInterface
{

    protected $name; // name of the element
    protected $time; // time to create the element
    protected $image; // icon name of the element
    protected $link; // link name of the element in the factorio wiki
    protected $parent; // parent element of this one
    protected $children = array(); // dependend elements of this one
    protected $elementFactory; // factory for elements
    protected $value; // value of produced items per second of this element
    private $lang; // current selected language
    private $producedIn; // producer element of this one

    /**
     * Constructor
     * @param Element $parent Parent element of this one.
     * @param float $val Amount of items to produce per second.
     */
    public function __construct($parent, $val)
    {
        if ($val >= 0) {
            $this->value = $val;
        } else {
            $this->value = 0;
        }
        $languageHelper = \Factorioplanner\Language\LanguageHelper::getInstance();
        $this->lang = $languageHelper->getLang();
        $this->parent = $parent;
        $this->elementFactory = \Factorioplanner\Elements\ElementFactory::getInstance();
    }

    /**
     * Sets the producing element for this element.
     * @param string $producer Producerclass to set for this element.
     */
    public function setProducer($producer)
    {
        if ($producer == "furnace") {
            $this->setFurnaceProducer();
        }

        if (($producer == "drill") && (is_subclass_of($this, "Factorioplanner\Elements\Ressource"))) {
            $this->setDrillProducer();
        }

        if ($producer == "assemblingmachine") {
            $this->setAssemblingMachineProducer();
        }
        
        if ($producer == "chemicalplant") {
            $this->setChemicalPlantProducer();
        }
        
        if ($producer == "oilrefinery") {
            $this->setOilRefineryProducer();
        }
        
        if ($producer == "pumpjack") {
            $this->setPumpjackProducer();
        }
    }
    
    /**
     * Sets a pumpjack as the producer of this element.
     */
    private function setPumpjackProducer() {
        global $oilproductionrate;
        $elementFactory = ElementFactory::getInstance();
        $value = round($this->value / $oilproductionrate, 2);
        $this->producedIn = $elementFactory->createElement("Factorioplanner\Elements\Production\Pumpjack", null, $value);
    }
    
    /**
     * Sets a oil refinery as the producer of this element.
     */
    private function setOilRefineryProducer() {
        global $oilprocessing;
        $elementFactory = ElementFactory::getInstance();
        if ($oilprocessing == "basic") {
            $value = round($this->value / (4 / $this->time), 2);
        }
        if ($oilprocessing == "advanced") {
            $value = round($this->value / (5.5 / $this->time), 2);
        }
        $this->producedIn = $elementFactory->createElement("Factorioplanner\Elements\Production\OilRefinery", null, $value);
    }
    
    /**
     * Sets a chemical plant as the producer of this element.
     */
    private function setChemicalPlantProducer() {
        $elementFactory = ElementFactory::getInstance(); 
        $value = round($this->value / (1.25 / $this->time), 2);
        $this->producedIn = $elementFactory->createElement("Factorioplanner\Elements\Production\ChemicalPlant", null, $value);
    }
    
    /**
     * Sets a furnace as the producer of this element.
     * @global \Factorioplanner\Elements\Furnace $furnace Current selected furnace.
     */
    private function setFurnaceProducer() {
        global $furnace;
        $elementFactory = ElementFactory::getInstance();
        $value = round($this->value / ($furnace->getCraftingSpeed() / $this->time), 2);
        $this->producedIn = $elementFactory->createElement(get_class($furnace), null, $value);

        // add coal dependency if needed
        if ((get_class($furnace) == "Factorioplanner\Elements\Production\StoneFurnace") || (get_class($furnace) == "Factorioplanner\Elements\Production\SteelFurnace")) {
            $this->addDependency("Factorioplanner\Elements\Ressource\Coal", round($furnace->energy / 8000, 2)); // 8000 kWs = 8MJ is the energy of one coal
        }
    }
    
    /**
     * Sets a drill as the producer of this element.
     * @global \Factorioplanner\Elements\Drill $drill Current selected drill.
     */
    private function setDrillProducer() {
        global $drill;
        $elementFactory = ElementFactory::getInstance();
        $value = round($this->value / ((($drill->getMiningPower() - $this->getMiningHardness()) * $drill->getMiningSpeed()) / $this->getMiningTime()), 2);
        $this->producedIn = $elementFactory->createElement(get_class($drill), null, $value);
    }
    
    /**
     * Sets a assembling machine as the producer of this element.
     * @global \Factorioplanner\Elements\Producer $assemblingmachine Current selected assembling machine.
     */
    private function setAssemblingMachineProducer() {
        global $assemblingmachine;
        $elementFactory = ElementFactory::getInstance();
        $value = round($this->value / ($assemblingmachine->getCraftingSpeed() / $this->time), 2);
        $this->producedIn = $elementFactory->createElement(get_class($assemblingmachine), null, $value);
    }

    /**
     * Getter
     * @return string Name of the element in the current selected language.
     */
    public function getName()
    {
        return $this->lang[$this->name];
    }

    /**
     * Getter
     * @return float Time needed to produce this element.
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Getter
     * @return string Name of the icon for this element.
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Adds a dependency for this element.
     * @param Element $element Element which is needed to produce this element.
     * @param float $factor Amount of the element to produce this one.
     */
    public function addDependency($element, $factor)
    {
        $object = $this->elementFactory->createElement($element, $this, round($this->value * $factor, 2));
        $object->createDependencies();
        $this->children[] = $object;
    }

    /**
     * Calculates the subtree width.
     * @return int Subtree width (in nodes).
     */
    public function getTreeWidth()
    {
        $width = 0;
        if (empty($this->children)) {
            return 1;
        }
        
        foreach ($this->children as $child) {
            $width += $child->getTreeWidth();
        }
        
        return $width;
    }

    /**
     * Gets the producer for this element.
     * @return Element Element which produces this element.
     */
    public function getProducer()
    {
        return $this->producedIn;
    }
    
    /**
     * Gets the wiki link for this element.
     * @return string Link to the wiki.
     */
    public function getLink()
    {
        return "https://wiki.factorio.com/{$this->link}";
    }

    /**
     * Renders the element (with subtree) to a specific place.
     * @global int $_BASEWIDTH Width of one element.
     * @global int $_BASEHEIGHT Height of one element.
     * @param int $x X coordinate to render the element to.
     * @param int $y Y coordinate to render the element to.
     */
    public function render($x, $y)
    {
        global $_BASEWIDTH;
        global $_BASEHEIGHT;

        echo "                            <div class='well well-sm text-center tree-element' style='width: {$_BASEWIDTH}px; height: {$_BASEHEIGHT}px; left:{$x}px; top:{$y}px;'>\r\n";
        echo "                                <p class='element-header'><a href='{$this->getLink()}'>{$this->getName()}</a></p>\r\n";
        $file = "Elements/icons/{$this->getImage()}";
        $perSecond = "  /s";
        if (get_class($this) === "Factorioplanner\Elements\Special\Research") 
        {
            $perSecond = "";
        }
        if (file_exists($file)) {
            echo "                                <p><img src='{$file}' class='element-image'>{$perSecond}</p>\r\n";
        } else {
            echo "                                <p><img src='images/empty.png' class='element-image' title='{$this->getName()}'>{$perSecond}</p>\r\n";
        }
        echo "                                <p>{$this->value}</p>\r\n";
        $this->renderProducer();
        echo "                            </div>\r\n";
        $this->renderChildren($x, $y);
    }

    /**
     * Renders the producer if it exists.
     */
    private function renderProducer() {
        $producer = $this->getProducer();
        if (!empty($producer)) {
            echo "<hr>\r\n";
            $file = "Elements/icons/{$producer->getImage()}";
            if (file_exists($file)) {
                echo "                                <p class='inline-element'><img src='{$file}' class='producer-image'></p>\r\n";
            } else {
                echo "                                <p class='inline-element'><img src='images/empty.png' class='producer-image' title='{$producer->getName()}'></p>\r\n";
            }
            echo "                                <p class='inline-element'>{$producer->value}</p>\r\n";
        }
    }
    
    /**
     * Renders the children of an element.
     * @global int $_BASEWIDTH Width of one element.
     * @global int $_BASEHEIGHT Height of one element.
     * @global type $_BASESPACE Distance of the base space between two elements.
     * @param int $x X coordinate to render this element to.
     * @param int $y Y coordinate to render this element to.
     */
    private function renderChildren($x, $y) {
        global $_BASEWIDTH;
        global $_BASEHEIGHT;
        global $_BASESPACE;
        
        if (!empty($this->children)) {
            $newY = $y + $_BASEHEIGHT + $_BASESPACE;
            $svgTop = $y + $_BASEHEIGHT;
            $lineX1 = round($x + $_BASEWIDTH / 2);
            $offset = round($x + $_BASEWIDTH / 2 - $this->getTreeWidth() / 2 * $_BASEWIDTH - ($this->getTreeWidth() - 1) / 2 * $_BASESPACE);
            foreach ($this->children as $child) {
                $neededPlace = $child->getTreeWidth() * $_BASEWIDTH + ($child->getTreeWidth() - 1) * $_BASESPACE;
                $newX = round($neededPlace / 2 + $offset - $_BASEWIDTH / 2);
                $offset += $neededPlace + $_BASESPACE;
                $child->render($newX, $newY);
                echo "                            <svg height='{$_BASESPACE}px' width='100%' class='svg-element' style='top:{$svgTop}px;'>\r\n";
                $lineX2 = round($newX + $_BASEWIDTH / 2);
                echo "                                <line x1='{$lineX1}px' y1='0px' x2='{$lineX2}px' y2='{$_BASESPACE}px' class='line-element'/>\r\n";
                echo "                            </svg>\r\n";
            }
        }
    }
}
