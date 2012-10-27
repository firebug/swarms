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
            '1.9.1',
            'The Firebug Working Group',
            'http://getfirebug.com/img/firebug-tiny.png',
            'The Firebug Web Page Debugger, Firefox version',
            'http://getfirebug.com',
            array('basic', 'designer', 'developer', 'performance', 'labs'),
            'https://addons.mozilla.org/firefox/downloads/file/142871/firebug-1.9.1-fx.xpi?src=external-Firebug-Swarm'
        ),
        new extension(
            'eventbug@getfirebug.com',
            'Eventbug',
            '0.1b9',
            'Jan \'Honza\' Odvarko and John J. Barton',
            '',
            'This extension brings a new <em>Events</em> panel that lists all of the event '.
                'handlers on the page grouped by event type. The panel also nicely integrates '.
                'with other Firebug panels and allows to quickly find out, which HTML element is '.
                'associated with specific event listener or see the Javascript source code.',
            'http://www.softwareishard.com/blog/firebug/eventbug-alpha-released/',
            array('developer'),
            'https://getfirebug.com/releases/eventbug/1.5/eventbug-0.1b9.xpi'
        ),
        new extension(
            'firediff@johnjbarton.com',
            'Firediff',
            '1.1.3',
            'Kevin Decker',
            '',
            'Firediff is a Firebug extension that tracks changes to a pages DOM and CSS.',
            'http://www.incaseofstairs.com/firediff/',
            array('designer'),
            'http://www.incaseofstairs.com/download/firediff/firediff1.1.3.xpi'
        ),
        new extension(
            '{ec8030f7-c20a-464f-9b0e-13a3a9e97384}',
            'SelectBug',
            '0.1a3',
            'John J. Barton',
            '',
            'List elements for each CSS selector, trial CSS selectors by typing them in.',
            '',
            array('designer'),
            'http://getfirebug.com/releases/selectbug/selectbug-0.1a3.xpi'
        ),
        new extension(
            'netexport@getfirebug.com',
            'NetExport',
            '0.8b17',
            'Jan \'Honza\' Odvarko',
            '',
            'Allows exporting data from the Net panel.',
            'http://www.softwareishard.com/blog/netexport/',
            array('performance'),
            'https://getfirebug.com/releases/netexport/netExport-0.8b17.xpi'
        ),
        new extension(
            'firecookie@janodvarko.cz',
            'FireCookie',
            '1.2.1',
            'Jan \'Honza\' Odvarko',
            '',
            'View and manage cookies in your browser.',
            'http://www.janodvarko.cz/firecookie',
            array('developer'),
            'https://addons.mozilla.org/firefox/downloads/file/113498/firecookie-1.2.1-fx.xpi?src=external-Firebug-Swarm'
        ),
        new extension(
            'sroussey@illumination-for-developers.com',
            'Illuminations for Developers',
            '1.1.10',
            'Steven Roussey',
            '',
            'Enhances Firebug to understand JavaScript libraries and frameworks (like ExtJS, '.
                'Dojo Toolkit, SproutCore, Closure Library, qooxdoo, YUI3, and jQuery/jQueryUI), '.
                'making things more obvious and helpful when debugging. Trial version.',
            'http://www.illuminations-for-developers.com/',
            array('developer'),
            'https://addons.mozilla.org/firefox/downloads/file/137044/illuminations_for_developers_for_firebug-1.1.10-fx.xpi?src=external-Firebug-Swarm'
        ),
        new extension(
            'dojo@silvergate.ar.ibm.com',
            'Dojo Firebug Extension',
            '1.0a9',
            'Patricio Reyna Almandos and Fernando Gomez',
            '',
            'Easy access to Dojo features: list dijit registry, and inspect visual widgets, view '.
                'and breakpoint connections and subscriptions.',
            'http://getfirebug.com/wiki/index.php/DojoFirebugExtension_Reference_Guide',
            array('developer'),
            'http://getfirebug.com/releases/dojofirebugextension/1.7/dojofirebugextension-1.0a9.xpi'
        ),
        new extension(
            'FirePHPExtension-Build@firephp.org',
            'FirePHP',
            '0.5.0',
            'Christoph Dorn',
            '',
            'Log to your Firebug Console from PHP.',
            'http://www.firephp.org/',
            array('developer'),
            'https://addons.mozilla.org/firefox/downloads/file/102244/firephp-0.5.0-fx.xpi?src=external-Firebug-Swarm'
        ),
        new extension(
            'firestarter@janodvarko.cz',
            'FireStarter',
            '0.1.a6',
            'Jan \'Honza\' Odvarko',
            '',
            'Extends Firebug\'s activation model with advanced features.',
            '',
            array('basic'),
            'https://getfirebug.com/releases/firestarter/1.5/fireStarter-0.1a6.xpi'
        ),
        new extension(
            'fbtest@mozilla.com',
            'FBTest',
            '1.7b17',
            'The Firebug Working Group',
            '',
            'Test Driver for Firebug itself, useful for extension authors.',
            '',
            array('labs'),
            'https://getfirebug.com/releases/fbtest/1.7/fbTest-1.7b17.xpi'
        ),
        new extension(
            'pixelperfectplugin@openhouseconcepts.com',
            'Pixel Perfect',
            '1.6.1',
            'Mike Buckley, Lorne Markham',
            '',
            'Pixel Perfect is a Firefox/Firebug extension that allows web developers and '.
                'designers to easily overlay a web composition over top of the developed HTML.',
            '',
            array('designer'),
            'https://addons.mozilla.org/en-US/firefox/downloads/latest/7943?src=external-Firebug-Swarm'
        ),
        new extension(
            'info@cssUpdater.com',
            'cssUpdater',
            '0.4.9',
            'Johan Andersson',
            '',
            'Edit your css with FireBug and let cssUpdater update the corresponding property and '.
                'value in your css source file. Pixel push with ease!',
            'http://www.cssupdater.com',
            array('designer'),
            'https://addons.mozilla.org/firefox/downloads/latest/268875/platform:5/addon-268875-latest.xpi?src=external-Firebug-Swarm'
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