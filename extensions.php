<?php
require_once('versionComparator.php');

define('EXTENSIONS_PATH', 'extensions/');
define('NS_RDF', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
define('NS_EM', 'http://www.mozilla.org/2004/em-rdf#');

class extension
{
    public $id;
    public $name;
    public $description;
    public $homepageURL;
    public $creator;
    public $developers;
    public $contributors;
    public $translators;
    public $version;
    public $targetApplications;
    public $targetAddOns;
    public $xpiURL;
    public $swarms;

    public function __construct($source, $swarms = array())
    {
        $this->developers = array();
        $this->contributors = array();
        $this->translators = array();
        $this->targetApplications = array();
        $this->targetAddOns = array();
        if (is_string($source))
            $this->parseXMLFromXPI($source);
        else
            $this->parseXML($source);

        $this->swarms = $swarms;
    }

    private function parseXML($xml)
    {
        $this->xpiURL = (string)$xml->attributes()->url;
        $this->id = (string)$xml->attributes()->id;
        $this->name = (string)$xml->name;
        $this->description = (string)$xml->description;
        $this->homepageURL = (string)$xml->homepageURL;
        $this->creator = (string)$xml->creator;
        if (isset($xml->developers->developer))
        {
            foreach($xml->developers->developer as $developer)
                array_push($this->developers, $developer);
        }
        if (isset($xml->contributors->contributor))
        {
            foreach($xml->contributors->contributor as $contributor)
                array_push($this->contributors, (string)$contributor);
        }
        if (isset($xml->translators->translator))
        {
            foreach($xml->translators->translator as $translator)
                array_push($this->translators, (string)$translator);
        }
        foreach($xml->targetApplications->application as $targetApplication)
        {
            $attributes = $targetApplication->attributes();
            array_push($this->targetApplications,
                array (
                    'id' => (string)$attributes->id,
                    'minVersion' => (string)$attributes->minVersion,
                    'maxVersion' => (string)$attributes->maxVersion
                )
            );
        }
        if (isset($xml->targetAddOns->addOn))
        {
            foreach($xml->targetAddOns->addOn as $targetAddOn)
            {
                $attributes = $targetAddOn->attributes();
                array_push($this->targetAddOns,
                    array (
                        'id' => (string)$attributes->id,
                        'minVersion' => (string)$attributes->minVersion,
                        'maxVersion' => (string)$attributes->maxVersion
                    )
                );
            }
        }
        $this->version = (string)$xml->version;
    }

    private function parseXMLFromXPI($xpiURL)
    {
        $this->xpiURL = $xpiURL;

        try
        {
            $tempDir = ini_get('upload_tmp_dir');
            if (empty($tempDir))
                $tempDir = '/tmp';
            $tempXPIFilePath = $tempDir.'/extension.xpi';
            copy($xpiURL, $tempXPIFilePath);
            $xpi = new ZipArchive();
            if($xpi->open($tempXPIFilePath))
            {
                $xml = new SimpleXMLElement($xpi->getFromName('install.rdf'));
                $xml->registerXPathNamespace('rdf', NS_RDF);
                $main = $xml->xpath('/rdf:RDF/rdf:Description[@about="urn:mozilla:install-manifest" or @rdf:about="urn:mozilla:install-manifest"]');

                $mainChildren = $main[0]->children(NS_EM);
                $mainAttributes = $main[0]->attributes(NS_EM);
                $this->id = (string)(isset($mainChildren->id) ? $mainChildren->id : $mainAttributes->id);
                $this->name = (string)(isset($mainChildren->name) ? $mainChildren->name : $mainAttributes->name);
                $this->description = (string)(isset($mainChildren->description) ? $mainChildren->description : $mainAttributes->description);
                $this->homepageURL = (string)(isset($mainChildren->homepageURL) ? $mainChildren->homepageURL : $mainAttributes->homepageURL);
                $this->creator = (string)(isset($mainChildren->creator) ? $mainChildren->creator : $mainAttributes->creator);
                foreach ($mainChildren->developer as $developer)
                    array_push($this->developers, (string)$developer);
                if (!empty($mainAttributes->developer))
                {
                    foreach ($mainAttributes->developer as $developer)
                        array_push($this->developers, (string)$developer);
                }
                foreach ($mainChildren->contributor as $contributor)
                    array_push($this->contributors, (string)$contributor);
                if (!empty($mainAttributes->contributor))
                {
                    foreach ($mainAttributes->contributor as $contributor)
                        array_push($this->contributors, (string)$contributor);
                }
                foreach ($mainChildren->translator as $translator)
                    array_push($this->translators, (string)$translator);
                if (!empty($mainAttributes->translator))
                {
                    foreach ($mainAttributes->translator as $translator)
                        array_push($this->translators, (string)$translator);
                }
                $this->version = (string)(isset($mainChildren->version) ? $mainChildren->version : $mainAttributes->version);

                $main[0]->registerXPathNamespace('em', NS_EM);
                $main[0]->registerXPathNamespace('rdf', NS_RDF);
                $targetApplications = $main[0]->xpath('//em:targetApplication/rdf:Description | /rdf:RDF/rdf:Description[@rdf:about=//em:targetApplication/@rdf:resource]');
                if (!empty($targetApplications))
                {
                    foreach ($targetApplications as $targetApplication)
                    {
                        $targetApplicationChildren = $targetApplication->children(NS_EM);
                        $targetApplicationAttributes = $targetApplication->attributes(NS_EM);
                        array_push($this->targetApplications,
                            array (
                                'id' => (string)(isset($targetApplicationChildren->id) ? $targetApplicationChildren->id : $targetApplicationAttributes->id),
                                'minVersion' => (string)(isset($targetApplicationChildren->minVersion) ? $targetApplicationChildren->minVersion : $targetApplicationAttributes->minVersion),
                                'maxVersion' => (string)(isset($targetApplicationChildren->maxVersion) ? $targetApplicationChildren->maxVersion : $targetApplicationAttributes->maxVersion)
                            )
                        );
                    }
                }

                $targetAddOns = $main[0]->xpath('//em:requires/rdf:Description | /rdf:RDF/rdf:Description[@rdf:about=//em:requires/@rdf:resource]');
                if (!empty($targetAddOns))
                {
                    foreach ($targetAddOns as $targetAddOn)
                    {
                        $targetAddOnChildren = $targetAddOn->children(NS_EM);
                        $targetAddOnAttributes = $targetAddOn->attributes(NS_EM);
                        array_push($this->targetAddOns,
                            array (
                                'id' => (string)(isset($targetAddOnChildren->id) ? $targetAddOnChildren->id : $targetAddOnAttributes->id),
                                'minVersion' => (string)(isset($targetAddOnChildren->minVersion) ? $targetAddOnChildren->minVersion : $targetAddOnAttributes->minVersion),
                                'maxVersion' => (string)(isset($targetAddOnChildren->maxVersion) ? $targetAddOnChildren->maxVersion : $targetAddOnAttributes->maxVersion)
                            )
                        );
                    }
                }

                $xpi->close();
            }
            else
                echo 'Could not open XPI file!';
        }
        catch (Exception $e)
        {
            var_dump($e);
            echo $tempDir;
            die();
        }
    }

    public function toXML()
    {
        $xml = new SimpleXMLElement('<extension url="'.$this->xpiURL.'"></extension>');
        $xml->addAttribute('id', $this->id);
        $xml->addChild('name', $this->name);
        $xml->addChild('description', $this->description);
        $xml->addChild('homepageURL', $this->homepageURL);
        $xml->addChild('creator', $this->creator);
        if (!empty($this->developers))
        {
            $xml->addChild('developers', '');
            foreach($this->developers as $developer)
                $xml->developers->addChild('developer', $developer);
        }
        if (!empty($this->contributors))
        {
            $xml->addChild('contributors', '');
            foreach($this->contributors as $contributor)
                $xml->contributors->addChild('contributor', $contributor);
        }
        if (!empty($this->translators))
        {
            $xml->addChild('translators', '');
            foreach($this->translators as $translator)
                $xml->translators->addChild('translator', $translator);
        }
        $xml->addChild('version', $this->version);

        $xml->addChild('targetApplications', '');
        foreach($this->targetApplications as $targetApplication)
        {
            $application = $xml->targetApplications->addChild('application', '');
            $application->addAttribute('id', $targetApplication['id']);
            $application->addAttribute('minVersion', $targetApplication['minVersion']);
            $application->addAttribute('maxVersion', $targetApplication['maxVersion']);
        }

        if (!empty($this->targetAddOns))
        {
            $xml->addChild('targetAddOns', '');
            foreach($this->targetAddOns as $targetAddOn)
            {
                $addOn = $xml->targetAddOns->addChild('addOn', '');
                $addOn->addAttribute('id', $targetAddOn['id']);
                $addOn->addAttribute('minVersion', $targetAddOn['minVersion']);
                $addOn->addAttribute('maxVersion', $targetAddOn['maxVersion']);
            }
        }

        return  $xml->asXML();
    }

    public function isCompatibleWithUserAgent()
    {
        $versionComparator = new versionComparator();
        foreach ($this->targetApplications as $targetApplication)
        {
            if ($targetApplication['id'] == $versionComparator->userAgent['appID'])
            {
              return $versionComparator->compareWithUserAgentVersion((string)$targetApplication['minVersion']) <= 0
                    && $versionComparator->compareWithUserAgentVersion((string)$targetApplication['maxVersion']) >= 0;
            }

            if ($targetApplication['id'] == 'toolkit@mozilla.org')
            {
                return $versionComparator->compareWithUserAgentToolkitVersion((string)$targetApplication['minVersion']) <= 0
                    && $versionComparator->compareWithUserAgentToolkitVersion((string)$targetApplication['maxVersion']) >= 0;
            }
        }
    }

    function save($filePath)
    {
        $path = dirname($filePath);
        if (!file_exists($path))
            mkdir($path, 0700, true);
        file_put_contents($filePath, $this->toXML(), LOCK_EX);
    }
}


class extensions implements Iterator
{
    private $position;
    private $extensions;

    public function __construct($extensions)
    {
        $this->rewind();
        $savedExtensions = array();

        try {
            $dir = new DirectoryIterator(realpath(EXTENSIONS_PATH));
            foreach($dir as $file)
            {
                if(!$file->isDot())
                {
                    $xml = new SimpleXMLElement(realpath(EXTENSIONS_PATH.$file->getFilename()), 0, true);
                    $savedExtensions[(string)$xml->attributes()->url] = $xml;
                }
            }
        } catch (Exception $e) {
            // The directory is expected to be empty
        }

        $this->extensions = array();
        foreach($extensions as $extensionInfo)
        {
            if (isset($savedExtensions[$extensionInfo['url']]))
            {
                $extension = new extension($savedExtensions[$extensionInfo['url']], $extensionInfo['swarms']);
            }
            else
            {
                $extension = new extension($extensionInfo['url'], $extensionInfo['swarms']);
                $extension->save(EXTENSIONS_PATH.$extension->id.'_'.$extension->version.'.xml');
            }

            array_push($this->extensions, $extension);
        }
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return array_key_exists($this->position, $this->extensions);
    }

    public function key()
    {
        return $this->position;
    }

    public function current()
    {
        return $this->extensions[$this->position];
    }

    public function next()
    {
        $this->position++;
    }
}
?>