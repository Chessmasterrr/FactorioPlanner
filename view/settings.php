<div class="row well well-sm" id="settings">
    <div class="col-xs-12">
        <div class="form-group form-group-sm">
            <label for="rootElement"><?php echo $lang['rootElement'] ?></label>
            <select name="rootElement" class="form-control width-200" onchange="this.form.submit()">
                <?php
// show rootElement dropdown
                if (!isset($rootElement)) {
                    echo "                              <option disabled='disabled' selected='true'>{$lang['pleaseSelect']}</option>\r\n";
                } else {
                    echo "                              <option disabled='disabled'>{$lang['pleaseSelect']}</option>\r\n";
                }
                foreach ($elementFactory->getAllElements() as $element) {
                    $classname = get_class($element);
                    if ((isset($rootElement)) && ($rootElement == $classname)) {
                        echo "                              <option value='{$classname}' selected='true'>{$element->getName()}</option>\r\n";
                    } else {
                        echo "                              <option value='{$classname}'>{$element->getName()}</option>\r\n";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group form-group-sm">
            <label for="rootCount"><?php echo $lang['rootCount'] ?> /s</label>
            <?php
            // set root count
            $value = 1;
            if (isset($rootCount)) {
                $value = $rootCount;
            }
            echo "                            <input name='rootCount' class='form-control input-sm width-100' type=number step=0.01 min='0.01' value='{$value}' onchange='this.form.submit()'/>\r\n";
            ?>
        </div>
        <div class="form-group form-group-sm">
            <label for="furnace"><?php echo $lang['usedFurnace'] ?></label>
            <select name="furnace" class="form-control width-150" onchange="this.form.submit()">
                <?php
                // show furnace dropdown
                if (get_class($furnace) == "Factorioplanner\Elements\Production\StoneFurnace") {
                    echo "                                <option selected='true' value='Factorioplanner\Elements\Production\StoneFurnace'>{$lang['stoneFurnace']}</option>\r\n";
                } else {
                    echo "                                <option value='Factorioplanner\Elements\Production\StoneFurnace'>{$lang['stoneFurnace']}</option>\r\n";
                }
                if (get_class($furnace) == "Factorioplanner\Elements\Production\SteelFurnace") {
                    echo "                                <option selected='true' value='Factorioplanner\Elements\Production\SteelFurnace'>{$lang['steelFurnace']}</option>\r\n";
                } else {
                    echo "                                <option value='Factorioplanner\Elements\Production\SteelFurnace'>{$lang['steelFurnace']}</option>\r\n";
                }
                if (get_class($furnace) == "Factorioplanner\Elements\Production\ElectricFurnace") {
                    echo "                                <option selected='true' value='Factorioplanner\Elements\Production\ElectricFurnace'>{$lang['electricFurnace']}</option>\r\n";
                } else {
                    echo "                                <option value='Factorioplanner\Elements\Production\ElectricFurnace'>{$lang['electricFurnace']}</option>\r\n";
                }
                ?>
            </select>
        </div>
        <div class="form-group form-group-sm">
            <label for="drill"><?php echo $lang['usedDrill'] ?></label>
            <select name="drill" class="form-control width-200" onchange="this.form.submit()">
                <?php
                // show drill dropdown
                if (get_class($drill) == "Factorioplanner\Elements\Production\BurnerMiningDrill") {
                    echo "                                <option selected='true' value='Factorioplanner\Elements\Production\BurnerMiningDrill'>{$lang['burnerMiningDrill']}</option>\r\n";
                } else {
                    echo "                                <option value='Factorioplanner\Elements\Production\BurnerMiningDrill'>{$lang['burnerMiningDrill']}</option>\r\n";
                }
                if (get_class($drill) == "Factorioplanner\Elements\Production\ElectricMiningDrill") {
                    echo "                                <option selected='true' value='Factorioplanner\Elements\Production\ElectricMiningDrill'>{$lang['electricMiningDrill']}</option>\r\n";
                } else {
                    echo "                                <option value='Factorioplanner\Elements\Production\ElectricMiningDrill'>{$lang['electricMiningDrill']}</option>\r\n";
                }
                ?>
            </select>
        </div>
        <div class="form-group form-group-sm">
            <label for="assemblingmachine"><?php echo $lang['useAssemblingmachine'] ?></label>
            <select name="assemblingmachine" class="form-control width-200" onchange="this.form.submit()">
                <?php
                // show assembling machine dropdown
                if (get_class($assemblingmachine) == "Factorioplanner\Elements\Production\AssemblingMachine1") {
                    echo "                                <option selected='true' value='Factorioplanner\Elements\Production\AssemblingMachine1'>{$lang['assemblingMachine1']}</option>\r\n";
                } else {
                    echo "                                <option value='Factorioplanner\Elements\Production\AssemblingMachine1'>{$lang['assemblingMachine1']}</option>\r\n";
                }
                if (get_class($assemblingmachine) == "Factorioplanner\Elements\Production\AssemblingMachine2") {
                    echo "                                <option selected='true' value='Factorioplanner\Elements\Production\AssemblingMachine2'>{$lang['assemblingMachine2']}</option>\r\n";
                } else {
                    echo "                                <option value='Factorioplanner\Elements\Production\AssemblingMachine2'>{$lang['assemblingMachine2']}</option>\r\n";
                }
                if (get_class($assemblingmachine) == "Factorioplanner\Elements\Production\AssemblingMachine3") {
                    echo "                                <option selected='true' value='Factorioplanner\Elements\Production\AssemblingMachine3'>{$lang['assemblingMachine3']}</option>\r\n";
                } else {
                    echo "                                <option value='Factorioplanner\Elements\Production\AssemblingMachine3'>{$lang['assemblingMachine3']}</option>\r\n";
                }
                ?>
            </select>
        </div>
        <div class="form-group form-group-sm">
            <label for="oilprocessing"><?php echo $lang['useOilProcessing'] ?></label>
            <select name="oilprocessing" class="form-control width-150" onchange="this.form.submit()">
                <?php
                // show oil processing dropdown
                if ($oilprocessing == "basic") {
                    echo "                                <option selected='true' value='basic'>{$lang['basicOilProcessing']}</option>\r\n";
                } else {
                    echo "                                <option value='basic'>{$lang['basicOilProcessing']}</option>\r\n";
                }
                if ($oilprocessing == "advanced") {
                    echo "                                <option selected='true' value='advanced'>{$lang['advancedOilProcessing']}</option>\r\n";
                } else {
                    echo "                                <option value='advanced'>{$lang['advancedOilProcessing']}</option>\r\n";
                }
                ?>
            </select>
        </div>
        <div class="form-group form-group-sm">
            <label for="oilproductionrate"><?php echo $lang['oilproductionrate'] ?></label>
            <?php
            // set root count
            $value = 1;
            if (isset($oilproductionrate)) {
                $value = $oilproductionrate;
            }
            echo "                            <input name='oilproductionrate' class='form-control input-sm width-100' type=number step=0.01 min='0.01' max='10' value='{$value}' onchange='this.form.submit()'/>\r\n";
            ?>
        </div>
        <div class="form-group form-group-sm">
            <input type=image src=../images/reload.png alt="Refresh" id="reload_button">
        </div>
    </div>
</div>
