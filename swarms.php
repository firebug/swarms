<?php
include_once('extensions.php');
include_once('versionComparator.php');

define('FIREBUG_ID', 'firebug@software.joehewitt.com');

$swarms = array('basic' => 'Basic Extensions, includes Firebug',
                'developer' => 'Developer Extensions',
                'designer' => 'Designer Extensions',
                'performance' => 'Performance Extensions',
                'labs' => 'Firebug Labs Extensions');

$extensions = new extensions(
    array(
        array(
            'url' => 'https://getfirebug.com/releases/firebug/1.7/firebug-1.7.3.xpi',
            'swarms' => array('basic', 'designer', 'developer', 'performance', 'labs')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/firebug/1.8/firebug-1.8.0.xpi',
            'swarms' => array('basic', 'designer', 'developer', 'performance', 'labs')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/firebug/1.8/firebug-1.8.1.xpi',
            'swarms' => array('basic', 'designer', 'developer', 'performance', 'labs')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/firebug/1.8/firebug-1.8.2.xpi',
            'swarms' => array('basic', 'designer', 'developer', 'performance', 'labs')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/firebug/1.8/firebug-1.8.3.xpi',
            'swarms' => array('basic', 'designer', 'developer', 'performance', 'labs')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/firebug/1.8/firebug-1.8.4.xpi',
            'swarms' => array('basic', 'designer', 'developer', 'performance', 'labs')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/firebug/1.9/firebug-1.9.0.xpi',
            'swarms' => array('basic', 'designer', 'developer', 'performance', 'labs')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/firebug/1.9/firebug-1.9.1.xpi',
            'swarms' => array('basic', 'designer', 'developer', 'performance', 'labs')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/eventbug/1.5/eventbug-0.1b9.xpi',
            'swarms' => array('developer')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/eventbug/1.5/eventbug-0.1b10.xpi',
            'swarms' => array('developer')
        ),
        array(
            'url' => 'http://www.incaseofstairs.com/download/firediff/firediff1.1.3.xpi',
            'swarms' => array('designer')
        ),
        array(
            'url' => 'http://getfirebug.com/releases/selectbug/selectbug-0.1a3.xpi',
            'swarms' => array('designer')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/netexport/netExport-0.8b17.xpi',
            'swarms' => array('performance')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/netexport/netExport-0.8b19.xpi',
            'swarms' => array('performance')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/netexport/netExport-0.8b20.xpi',
            'swarms' => array('performance')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/netexport/netExport-0.8b21.xpi',
            'swarms' => array('performance')
        ),
        array(
            'url' => 'https://addons.mozilla.org/firefox/downloads/file/113498/firecookie-1.2.1-fx.xpi?src=external-Firebug-Swarm',
            'swarms' => array('developer')
        ),
        array(
            'url' => 'https://addons.mozilla.org/firefox/downloads/file/137044/illuminations_for_developers_for_firebug-1.1.10-fx.xpi?src=external-Firebug-Swarm',
            'swarms' => array('developer')
        ),
        array(
            'url' => 'http://getfirebug.com/releases/dojofirebugextension/1.7/dojofirebugextension-1.0a9.xpi',
            'swarms' => array('developer')
        ),
        array(
            'url' => 'https://addons.mozilla.org/firefox/downloads/file/102244/firephp-0.5.0-fx.xpi?src=external-Firebug-Swarm',
            'swarms' => array('developer')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/firestarter/1.5/fireStarter-0.1a6.xpi',
            'swarms' => array('basic')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/fbtest/1.7/fbTest-1.7b17.xpi',
            'swarms' => array('labs')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/fbtest/1.8/fbTest-1.8b12.xpi',
            'swarms' => array('labs')
        ),
        array(
            'url' => 'https://getfirebug.com/releases/fbtrace/1.8/fbTrace-1.8b9.xpi',
            'swarms' => array('labs')
        ),
        array(
            'url' => 'https://addons.mozilla.org/en-US/firefox/downloads/latest/7943?src=external-Firebug-Swarm',
            'swarms' => array('designer')
        ),
        array(
            'url' => 'https://addons.mozilla.org/firefox/downloads/file/108292/cssupdater-0.4.3-fx-windows.xpi?src=external-Firebug-Swarm',
            'swarms' => array('designer')
        )
    )
);

$compatibleExtensions = array();
$versionComparator = new versionComparator();
foreach($extensions as $extension)
{
    if ($extension->isCompatibleWithUserAgent() &&
        (!isset($compatibleExtensions[$extension->id]) ||
        $versionComparator->compareVersions($extension->version, $compatibleExtensions[$extension->id]->version) == 1))
    {
        $isCompatible = true;
        if ($extension->id != FIREBUG_ID)
        {
            foreach ($extension->targetAddOns as $targetAddOn)
            {
                if ($targetAddOn['id'] == FIREBUG_ID)
                {
                    $isCompatible = $versionComparator->compareVersions($compatibleExtensions[FIREBUG_ID]->version, $targetAddOn['minVersion']) >= 0 &&
                        $versionComparator->compareVersions($compatibleExtensions[FIREBUG_ID]->version, $targetAddOn['maxVersion']) <= 0;
                }
            }
        }
        if ($isCompatible)
            $compatibleExtensions[$extension->id] = $extension;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Firebug Swarms</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" href="common/swarmExtensionStatus.css" type="text/css"/>
        <link rel="stylesheet" href="common/swarm.css" type="text/css"/>
        <script type="text/javascript" src="common/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="common/swarm.js"></script>
    </head>
    <body>
        <table id="header">
            <tbody>
                <tr>
                    <td>
                        <a href="http://getfirebug.com/" target="_blank"><img class="logo" src="http://getfirebug.com/img/firebug-logo.png"/></a>
                    </td>
                    <td>
                        <a href="http://getfirebug.com/contribute" target="_blank">
                            <div id="contribute">
                                Support Firebug<br>
                                <span>Become a Corporate Sponsor</span>
                            </div>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="swarmpicker">
            <form id="swarmSelector">
<?php
foreach ($swarms as $type => $description)
{
    echo '<div class="swarmSelector">
              <input type="checkbox" id="'.$type.'Swarm" name="swarms" value="'.$type.'" '.
             ($_SERVER['REQUEST_METHOD'] == 'GET' && $type == 'basic' ? 'checked="true"' : '').'/>
              <label for="'.$type.'Swarm">'.$description.'</label>
          </div>';
}
?>
                <button class="swarmCommand blue-pill" id="installSelected">Install The Swarm!</button><br><span id="extensionsSelected"></span>
            </form>
        </div>
        <div class="swarmSpecification">
            <div class="theSwarm"> <!-- One item for every extension in the Swarm -->
               <form id="extensionSelector">
<?php
foreach ($compatibleExtensions as $extension)
{
    echo '<div class="extension '. implode(' ', $extension->swarms) .'">
              <input type="checkbox" class="installThisOne" id="'.$extension->id.'" name="extension" value="tbd" />
              <label for="'.$extension->id.'">
                <a class="extensionURL" href="'. $extension->xpiURL .'" id="'. $extension->id .'">'. $extension->name .'</a>
                <span class="extensionAuthor">'. $extension->creator .'</span>
              </label>
              <span class="extensionStatus">'. $extension->version .'</span>
              <div class="extensionInfo">
                  <p>'. $extension->description .
                  ($extension->homepageURL != '' ? '<a class="extensionMoreInfo" target="_blank" href="'. $extension->homepageURL .'">more info</a>' : '') .
                  '</p>
              </div>
          </div>';
}
?>
                </form>
            </div> <!-- theSwarm -->

            <h2>
                <img src="http://getfirebug.com/images/firebug3.jpg" alt=""/>
                <span class="date">
                    <a href="http://getfirebug.com/testresults/?userheaderid=75586fa2adea86670c7c8094021ebc95"><em>Tested with Firebug</em></a>
                </span>
            </h2>
        </div> <!-- swarmSpecification -->
    </body>
</html>