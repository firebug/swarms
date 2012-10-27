<?php
class versionComparator
{
    private $userAgents = array(
        'toolkit@mozilla.org' => 'rv',
        '{a23983c0-fd0e-11dc-95ff-0800200c9a66}' => 'Fennec',
        '{3550f703-e582-4d05-9a08-453d09bdfdc6}' => 'Thunderbird',
        '{92650c4d-4b8e-4d2a-b7eb-24ecf4f6b63a}' => 'Seamonkey',
        '{ec8030f7-c20a-464f-9b0e-13a3a9e97384}' => 'Firefox'
    );
    public $userAgent;

    public function __construct()
    {
        preg_match('/rv:([^\)]+).*(Thunderbird|Fennec|SeaMonkey|Firefox)\/(\S+)/', $_SERVER['HTTP_USER_AGENT'], $userAgent);
        $this->userAgent = array(
            'toolkitVersion' => $userAgent[1],
            'userAgentName' => $userAgent[2],
            'userAgentVersion' => $userAgent[3],
            'appID' => $this->getAppIDByUserAgentName($userAgent[2])
        );
    }

    public function getAppIDByUserAgentName($userAgentName)
    {
        $appID = array_search($userAgentName, $this->userAgents);
        return $appID ? $appID : '';
    }

    public function getUserAgentNameByAppID($appID)
    {
        if (isset($this->userAgents[$appID]))
            return $this->userAgents[$appID];

        return null;
    }

    public function compareVersions($versionA, $versionB)
    {
        $reSequence = '/^(\-?\d*|\*)(\D*|\+)?(\-?\d*|\*)(\D*|\+)?$/';

        // A version string consists of one or more version parts, separated with dots.
        // See https://developer.mozilla.org/en/Toolkit_version_format
        $versionAParts = explode('.', $versionA);
        $versionBParts = explode('.', $versionB);
        $versionAPartsCount = count($versionAParts);
        $versionBPartsCount = count($versionBParts);
        $maxVersionParts = $versionAPartsCount;

        if ($versionAPartsCount < $versionBPartsCount)
        {
            $versionAParts = array_merge($versionAParts, array_fill(0, $versionBPartsCount-$versionAPartsCount, 0));
            $maxVersionParts = $versionBPartsCount;
        }
        else if ($versionAPartsCount > $versionBPartsCount)
        {
            $versionBParts = array_merge($versionBParts, array_fill(0, $versionAPartsCount-$versionBPartsCount, 0));
        }

        for ($i=0; $i<$maxVersionParts; $i++)
        {
            if ($versionAParts[$i] == $versionBParts[$i])
                continue;

            if ($versionAParts[$i] === '*')
                return 1;
            if ($versionBParts[$i] === '*')
                return -1;

            // Each version part is parsed as a sequence of four parts: <number-a><string-b><number-c><string-d>
            // See https://developer.mozilla.org/en/Toolkit_version_format
            preg_match($reSequence, $versionAParts[$i], $versionAPartSequence);
            preg_match($reSequence, $versionBParts[$i], $versionBPartSequence);

            // If <string-b> is a plus sign, <number-a> is incremented
            if ($versionAPartSequence[2] === '+')
            {
                $versionAPartSequence[1]++;
                $versionAPartSequence[2] = 'pre';
            }
            if ($versionBPartSequence[2] === '+')
            {
                $versionBPartSequence[1]++;
                $versionBPartSequence[2] = 'pre';
            }

            for ($j=1; $j<=4; $j++)
            {
                if ($versionAPartSequence[$j] == $versionBPartSequence[$j])
                    continue;

                if ($j % 2 == 1)
                {
                    if (intval($versionAPartSequence[$j]) == intval($versionBPartSequence[$j]))
                        continue;
                    return intval($versionAPartSequence[$j]) > intval($versionBPartSequence[$j]) ? 1 : -1;
                }
                else
                {
                    $comparisonResult = strcmp($versionAPartSequence[$j], $versionBPartSequence[$j]);
                    $comparisonResult /= abs($comparisonResult);

                    // PHP returns a wrong result when comparing an empty string with another string
                    if ($versionAPartSequence[$j] == '' || $versionBPartSequence[$j] == '')
                        $comparisonResult = -$comparisonResult;

                    return $comparisonResult;
                }
            }
        }

        return 0;
    }

    public function compareWithUserAgentVersion($version)
    {
        return $this->compareVersions($version, $this->userAgent['userAgentVersion']);
    }

    public function compareWithUserAgentToolkitVersion($version)
    {
        return $this->compareVersions($version, $this->userAgent['toolkitVersion']);
    }
}
?>