# FactorioPlanner
This is a planning tool for the game [Factorio](https://factorio.com). It calculates the optimal ratios to produce an element in the game. 

# Demo
You can find the tool [here](https://factorio.chessmasterrr.de). Please note that the ingame icons are licensed and therefore connot be used in the public demo. The icons are replaced with "?" by default.

# Installation
To use the tool you can simply clone the repository in your web directory. The website needs only a working php environment. To show the ingame icons find the "icons" folder in your Factorio-installation (under `%FACTORIO_ROOT%/game/data/base/graphics/icons`) and copy it to `%wEB_ROOT/Elements/icons`.

# Contribute
To contribute to the project you can add a translation into your favorite language or add more elements that can be build in the game.

## Add a language
To add a language to the tool, simply copy the `en.ini` language file in the Language folder to your language (for example `de.ini`). Replace the english words with your language and delete all phrases that you do not want to translate. Your language will than be available in the top right corner and all your translated phrases will be shown - words that you didn't translated will still be in english (default language).

## Add an element
To add an element to the project, create a class in the appropriate folder (`Elements/Combat`, `Elements/IntermediateProduct`, `Elements/Logistic`, `Elements/Production` or `Elements/Ressource`) and extend the appropriate abstract class (`Element`, `Drill`, `Furnace`, `Producer` or `Ressource`). Fill the `constructor` with the needed values (name, image, link and time) and the `createDependencies` function (`setProducer` and `addDependency`) if there are any dependencies. At least add the name of the element to the `en.ini` language file under `Language`. For example:
```php
public function __construct($parent, $val)
    {
        parent::__construct($parent, $val);
        $this->name = 'battery'; // name of the element in the language file
        $this->image = 'battery.png'; // name (and maybe the relative path such as 'fluid') of the icon of the element
        $this->link = 'battery'; // last part of the link to the wiki: https://wiki.factorio.com/battery
        $this->time = 5; // time to produce ONE item of this element
    }
```

```php
public function createDependencies()
    {
        $this->setProducer("chemicalplant"); // where is this element produced? possible values: assemblingmachine, chemicalplant, drill, furnace, oilrefinery, pumpjack
        $this->addDependency('Factorioplanner\Elements\Intermediateproduct\CopperPlate', 1); // this element needs 1 copper plate to produce one item
        $this->addDependency('Factorioplanner\Elements\Intermediateproduct\IronPlate', 1); // and 1 iron plate
        $this->addDependency('Factorioplanner\Elements\Intermediateproduct\SulfuricAcid', 20); // and 20 sulfuric acid
    }
```
