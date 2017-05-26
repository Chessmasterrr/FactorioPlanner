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
namespace Factorioplanner;

// set error handling, comment in for debugging
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// set autoload
require 'autoloader.php';

// set global variables
$_BASEWIDTH = 110;
$_BASEHEIGHT = 200;
$_BASESPACE = 50;

// get values from UI
$language = filter_input(INPUT_POST, 'language', FILTER_SANITIZE_STRING);
$rootElement = filter_input(INPUT_POST, 'rootElement', FILTER_SANITIZE_STRING);
$rootCount = filter_input(INPUT_POST, 'rootCount', FILTER_SANITIZE_STRING);
$furnaceString = filter_input(INPUT_POST, 'furnace', FILTER_SANITIZE_STRING);
$drillString = filter_input(INPUT_POST, 'drill', FILTER_SANITIZE_STRING);
$assemblingmachineString = filter_input(INPUT_POST, 'assemblingmachine', FILTER_SANITIZE_STRING);
$oilprocessing = filter_input(INPUT_POST, 'oilprocessing', FILTER_SANITIZE_STRING);
$oilproductionrate = filter_input(INPUT_POST, 'oilproductionrate', FILTER_SANITIZE_STRING);

// create common used classes
$elementFactory = \Factorioplanner\Elements\ElementFactory::getInstance();
$languageHelper = \Factorioplanner\Language\LanguageHelper::getInstance();

// get wanted language (in order: selection on website, browser setting, default en)
if (!isset($language)) {
    $language = substr(filter_input(INPUT_SERVER, 'HTTP_ACCEPT_LANGUAGE', FILTER_SANITIZE_STRING), 0, 2);
    if (!isset($language)) {
        $language = 'en';
    }
}
// create needed objects
$lang = $languageHelper->getLanguage($language);
if (empty($furnaceString)) {
    $furnace = $elementFactory->createElement("\Factorioplanner\Elements\Production\StoneFurnace");
} else {
    $furnace = $elementFactory->createElement($furnaceString);
}
if (empty($drillString)) {
    $drill = $elementFactory->createElement("\Factorioplanner\Elements\Production\ElectricMiningDrill");
} else {
    $drill = $elementFactory->createElement($drillString);
}
if (empty($assemblingmachineString)) {
    $assemblingmachine = $elementFactory->createElement("\Factorioplanner\Elements\Production\AssemblingMachine1");
} else {
    $assemblingmachine = $elementFactory->createElement($assemblingmachineString);
}

// echo view
require 'view/header.php';
require 'view/settings.php';
require 'view/main.php';
require 'view/footer.php';
