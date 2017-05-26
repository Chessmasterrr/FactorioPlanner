<div class="row margin-10">
    <div class="col-xs-12">
        <?php
// show rootElement with tree
        if ((isset($rootElement)) && (isset($rootCount))) {
            $element = $elementFactory->createElement($rootElement, null, $rootCount);
            $element->createDependencies();
            $treeWidth = $element->getTreeWidth();
            $divWidth = round($treeWidth * $_BASEWIDTH + ($treeWidth - 1) * $_BASESPACE);
            echo "                        <div id='zoom-wrapper' style='width: {$divWidth}px;'>\r\n";
            $element->render(round(($divWidth - $_BASEWIDTH) / 2), 0);
            echo "                        </div>\r\n";
        }
        ?>
    </div>
</div>
