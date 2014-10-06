<?php
    class extension
    {
        public $id;
        public $name;
        public $version;
        public $author;
        public $icon;
        public $description;
        public $homepage;
        public $swarms;
        public $xpi;

        public function __construct($id, $name, $version, $author, $icon, $description, $homepage, $swarms, $xpi)
        {
            $this->id = $id;
            $this->name = $name;
            $this->version = $version;
            $this->author = $author;
            $this->icon = $icon;
            $this->description = $description;
            $this->homepage = $homepage;
            $this->swarms = $swarms;
            $this->xpi = $xpi;
        }
    }

    $extensions = array(
        new extension(
            'firebug@software.joehewitt.com',
            'Firebug',
            '2.0.4',
            'The Firebug Working Group',
            'http://getfirebug.com/img/firebug-tiny.png',
            'The Firebug Web Page Debugger, Firefox version',
            'http://getfirebug.com',
            array('basic', 'designer', 'developer', 'performance', 'labs'),
            'https://addons.mozilla.org/firefox/downloads/file/274666/firebug-2.0.4-fx.xpi?src=external-Firebug-Swarms'
        ),
        new extension(
            'firediff@johnjbarton.com',
            'Firediff',
            '1.2.1',
            'Kevin Decker',
            '',
            'Firediff is a Firebug extension that tracks changes to a pages DOM and CSS.',
            'http://www.incaseofstairs.com/firediff/',
            array('designer'),
            'https://addons.mozilla.org/firefox/downloads/file/236728/firediff-1.2.1-fx.xpi?src=external-Firebug-Swarms'
        ),
        new extension(
            'netexport@getfirebug.com',
            'NetExport',
            '0.9b6',
            'Jan \'Honza\' Odvarko',
            '',
            'Allows exporting data from the Net panel.',
            'http://www.softwareishard.com/blog/netexport/',
            array('performance'),
            'https://getfirebug.com/releases/netexport/netExport-0.9b6.xpi?src=Firebug-Swarms'
        ),
        new extension(
            'sroussey@illumination-for-developers.com',
            'Illuminations for Developers for Firebug',
            '1.1.28',
            'Steven Roussey',
            '',
            'Enhances Firebug to understand JavaScript libraries and frameworks (like ExtJS, '.
                'Dojo Toolkit, SproutCore, Closure Library, qooxdoo, YUI3, and jQuery/jQueryUI), '.
                'making things more obvious and helpful when debugging. Trial version.',
            'http://www.illuminations-for-developers.com/',
            array('developer'),
            'https://addons.mozilla.org/firefox/downloads/file/262108/illuminations_for_developers_for_firebug-1.1.28-fx.xpi?src=external-Firebug-Swarms'
        ),
        new extension(
            'dojo@silvergate.ar.ibm.com',
            'Dojo Firebug Extension',
            '1.2.0a1',
            'Patricio Reyna Almandos and Fernando Gomez',
            '',
            'Easy access to Dojo features: list dijit registry, and inspect visual widgets, view '.
                'and breakpoint connections and subscriptions.',
            'http://getfirebug.com/wiki/index.php/DojoFirebugExtension_Reference_Guide',
            array('developer'),
            'https://getfirebug.com/releases/dojofirebugextension/firebug1.11/dojofirebugextension-1.2.0a1.xpi?src=Firebug-Swarms'
        ),
        new extension(
            'FirePHPExtension-Build@firephp.org',
            'FirePHP',
            '0.7.4',
            'Christoph Dorn',
            '',
            'Log to your Firebug Console from PHP.',
            'http://www.firephp.org/',
            array('developer'),
            'https://addons.mozilla.org/firefox/downloads/file/226816/firephp-0.7.4-fx.xpi?src=external-Firebug-Swarms'
        ),
        new extension(
            'fbtest@mozilla.com',
            'FBTest',
            '2.0b1',
            'The Firebug Working Group',
            '',
            'Test Driver for Firebug itself, useful for extension authors.',
            '',
            array('labs'),
            'https://getfirebug.com/releases/fbtest/2.0/fbTest-2.0b1.xpi?src=Firebug-Swarms'
        ),
        new extension(
            'info@cssUpdater.com',
            'cssUpdater',
            '0.5.2',
            'Johan Andersson',
            '',
            'Edit your css with FireBug and let cssUpdater update the corresponding property and '.
                'value in your css source file. Pixel push with ease!',
            'http://www.cssupdater.com',
            array('designer'),
            'https://addons.mozilla.org/firefox/downloads/file/165471/cssupdater-0.5.2-fx.xpi?src=external-Firebug-Swarms'
        ),
        new extension(
            'fbtrace@getfirebug.com',
            'FBTrace',
            '2.0b1',
            'The Firebug Working Group',
            '',
            'Tracing Console for Firebug',
            '',
            array('labs'),
            'https://getfirebug.com/releases/fbtrace/2.0/fbTrace-2.0b1.xpi?src=Firebug-Swarms'
        )
    );
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Basic Firebug Swarm from the Firebug Team</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" href="../common/swarmExtensionStatus.css" type="text/css"/>
        <link rel="stylesheet" href="../common/swarm.css" type="text/css"/>
        <script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="../common/swarm.js"></script>
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
                <div class="swarmSelector">
                    <input type="checkbox" id="basicSwarm" name="swarms" value="basic" checked="true" /> <label for="basicSwarm">Basic Extensions, includes Firebug</label>
                </div>
                <div class="swarmSelector">
                    <input type="checkbox" id="designerSwarm" name="swarms" value="designer" /> <label for="designerSwarm">Designer Extensions</label>
                </div>
                <div class="swarmSelector">
                    <input type="checkbox" id="developerSwarm" name="swarms" value="developer" /> <label for="developerSwarm">Developer Extensions</label>
                </div>
                <div class="swarmSelector">
                    <input type="checkbox" id="performanceSwarm" name="swarms" value="performance" /> <label for="performanceSwarm">Performance Extensions</label>
                </div>
                <div class="swarmSelector">
                    <input type="checkbox" id="labsSwarm" name="swarms" value="labs" /> <label for="labsSwarm">Firebug Labs Extensions</label>
                </div>
                <button class="swarmCommand blue-pill" id="installSelected">Install The Swarm!</button><br><span id="extensionsSelected"></span>
            </form>
        </div>
        <div class="swarmSpecification">
            <div class="theSwarm"> <!-- One item for every extension in the Swarm -->
               <form id="extensionSelector">
<?php
    foreach ($extensions as $ext)
    {
        echo '<div class="extension '. implode(' ', $ext->swarms) .'">
                  <input type="checkbox" class="installThisOne" id="'.$ext->id.'Input" name="extension" value="tbd" />
                  <label for="'.$ext->id.'Input">
                    <a id="'.$ext->id.'" class="extensionURL" href="'. $ext->xpi .'">'. $ext->name .'</a>
                    <span class="extensionAuthor">'. $ext->author .'</span>
                  </label>
                  <span class="extensionStatus">'. $ext->version .'</span>
                  <div class="extensionInfo">
                      <p>'. $ext->description .
                      ($ext->homepage != '' ? '<a class="extensionMoreInfo" target="_blank" href="'. $ext->homepage .'">more info</a>' : '') .
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
                    <a href="http://getfirebug.com/testresults/?userheaderid=75586fa2adea86670c7c8094021ebc95"><i>Tested with Firebug </i></a>
                </span>
            </h2>
        </div> <!-- swarmSpecification -->
    </body>
</html>
