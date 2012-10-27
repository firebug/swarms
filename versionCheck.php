<?php
include('versionComparator.php');

$vc = new versionComparator();

$versions = array(
    array('1.-1', '1', '-1'),
    array('1', '1.', '0'),
    array('1.', '1.0', '0'),
    array('1.0', '1.0.0', '0'),
    array('1.0.0', '1.1a', '-1'),
    array('1.1a', '1.1aa', '-1'),
    array('1.1aa', '1.1ab', '-1'),
    array('1.1ab', '1.1b', '-1'),
    array('1.1b', '1.1c', '-1'),
    array('1.1c', '1.1pre', '-1'),
    array('1.1pre', '1.1pre0', '0'),
    array('1.1pre0', '1.0+', '0'),
    array('1.0+', '1.1pre1a', '-1'),
    array('1.1pre1a', '1.1pre1aa', '-1'),
    array('1.1pre1aa', '1.1pre1b', '-1'),
    array('1.1pre1b', '1.1pre1', '-1'),
    array('1.1pre1', '1.1pre2', '-1'),
    array('1.1pre2', '1.1pre10', '-1'),
    array('1.1pre10', '1.1.-1', '-1'),
    array('1.1.-1', '1.1', '-1'),
    array('1.1', '1.1.0', '0'),
    array('1.1.0', '1.1.00', '0'),
    array('1.1.00', '1.10', '-1'),
    array('1.10', '1.*', '-1'),
    array('1.*', '1.*.1', '-1'),
    array('1.*.1', '2.0', '-1'),
    array('1', '1.-1', '1'),
    array('1.', '1', '0'),
    array('1.0', '1.', '0'),
    array('1.0.0', '1.0', '0'),
    array('1.1a', '1.0.0', '1'),
    array('1.1aa', '1.1a', '1'),
    array('1.1ab', '1.1aa', '1'),
    array('1.1b', '1.1ab', '1'),
    array('1.1c', '1.1b', '1'),
    array('1.1pre', '1.1c', '1'),
    array('1.1pre0', '1.1pre', '0'),
    array('1.0+', '1.1pre0', '0'),
    array('1.1pre1a', '1.0+', '1'),
    array('1.1pre1aa', '1.1pre1a', '1'),
    array('1.1pre1b', '1.1pre1aa', '1'),
    array('1.1pre1', '1.1pre1b', '1'),
    array('1.1pre2', '1.1pre1', '1'),
    array('1.1pre10', '1.1pre2', '1'),
    array('1.1.-1', '1.1pre10', '1'),
    array('1.1', '1.1.-1', '1'),
    array('1.1.0', '1.1', '0'),
    array('1.1.00', '1.1.0', '0'),
    array('1.10', '1.1.00', '1'),
    array('1.*', '1.10', '1'),
    array('1.*.1', '1.*', '1'),
    array('2.0', '1.*.1', '1')
);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Version Comparison Test Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="https://getfirebug.com/tests/content/templates/default/testcase.css" type="text/css" rel="stylesheet"/>
        <style type="text/css">
            table {
                width: 350px;
            }

            td:nth-child(-n+2) {
                text-align: right;
            }

            td:nth-last-child(-n+2) {
                text-align: center;
            }

            td.correct {
                background: -moz-linear-gradient(135deg, #78FF8C, #B4FFC8);
            }

            td.wrong {
                background: -moz-linear-gradient(135deg, #FF8C78, #FFC8B4);
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Version Comparison Test Page</h1>
        </header>
        <div>
            <section id="description">
                <table>
                    <tr>
                        <th>Version 1</th>
                        <th>Version 2</th>
                        <th>Expected</th>
                        <th>Result</th>
                    </tr>
<?php
$wrongResults = 0;
foreach($versions as $version)
{
    $comparisonResult = $vc->compareVersions($version[0], $version[1]);
    $comparisonCorrect = ($comparisonResult == $version[2]);
    if (!$comparisonCorrect)
        $wrongResults++;
    echo '<tr>'.
         '    <td>'.$version[0].'</td>'.
         '    <td>'.$version[1].'</td>'.
         '    <td>'.$version[2].'</td>'.
         '    <td class="'.($comparisonCorrect ? 'correct' : 'wrong').'">'.$comparisonResult.'</td>'.
         '</tr>';
}
    echo '<tr>'.
         '    <td>6.*</td>'.
         '    <td>'.$vc->userAgent['userAgentVersion'].' <em>(UA version)</em></td>'.
         '    <td>&nbsp;</td>'.
         '    <td>'.$vc->compareWithUserAgentVersion('6.*').'</td>'.
         '</tr>'.
         '<tr>'.
         '    <td colspan="3">Wrong results</td>'.
         '    <td>'.$wrongResults.'</td>'.
         '</tr>';
?>
                </table>
            </section>
            <footer>Sebastian Zartner</footer>
        </div>
    </body>
</html>