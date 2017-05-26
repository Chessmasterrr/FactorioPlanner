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
namespace Factorioplanner\Language;

/**
 * Class for language management
 */
class LanguageHelper
{

    private static $instance; // singleton pattern
    private $lang; // array with current selected language strings

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
     * Gets a list of all available languages
     * @return array of available language strings
     */
    public function getAvailableLanguages()
    {
        $languages = array();

        $files = scandir('Language/');
        foreach ($files as $file) {
            if ((strlen($file) == 6) && (strcmp(substr($file, -4), '.ini') === 0)) {
                array_push($languages, substr($file, 0, 2));
            }
        }

        return $languages;
    }

    /**
     * Gets strings for one language
     * @param $language The language to get the strings for
     * @return Array with language strings
     */
    public function getLanguage($language)
    {
        // default language
        $this->lang = parse_ini_file('Language/en.ini');

        // overwrite with selected language, if translation is known
        if (strcmp($language, 'en') !== 0) {
            if (file_exists("Language/{$language}.ini")) {
                $lang2 = parse_ini_file("Language/{$language}.ini");
                $this->lang = array_merge($this->lang, $lang2);
            }
        }

        return $this->lang;
    }

    /**
     * Getter
     * @return Array with language strings for the current selected language
     */
    public function getLang()
    {
        return $this->lang;
    }

}
