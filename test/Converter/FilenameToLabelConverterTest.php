<?php
/**
 * @author Matthew Setter <matthew@matthewsetter.com>
 *
 * @copyright Copyright (c) 2017, ownCloud GmbH
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace SphinxDocToAntoraMigrator\Tests\Converter;

use SphinxDocToAntoraMigrator\Converter\FilenameToLabelConverter;
use PHPUnit\Framework\TestCase;

/**
 * Class FilenameToLabelConverterTest
 * @package SphinxDocToAntoraMigrator\Tests
 */
class FilenameToLabelConverterTest extends TestCase
{
    public function converterDataProvider()
    {
        $original = <<<EOD
************** xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/ucs/add-groups-and-users.adoc[Add-groups-and-users]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/Active_Directory.adoc[Active Directory]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/Backup.adoc[Backup]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/Collabora.adoc[Collabora]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/clamav.adoc[Clamav]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/howto-update-owncloud.adoc[Howto-update-owncloud]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/index.adoc[Index]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/installation.adoc[Installation]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/managing-ucs.adoc[Managing-ucs]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/what-is-it.adoc[What-is-it]
EOD;

        $formatted = <<<EOD
************** xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/ucs/add-groups-and-users.adoc[Add groups and users]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/Active_Directory.adoc[Active Directory]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/Backup.adoc[Backup]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/Collabora.adoc[Collabora]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/clamav.adoc[ClamAV]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/howto-update-owncloud.adoc[Howto update ownCloud]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/index.adoc[Index]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/installation.adoc[Installation]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/managing-ucs.adoc[Managing UCS]
************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/appliance/what-is-it.adoc[What is it]
EOD;

        return [
            [
                $original,
                $formatted
            ]
        ];
    }

    /**
     * @dataProvider converterDataProvider
     * @param string $from
     * @param string $to
     */
    public function testCanCorrectlyConvertFilenamesToLabels(string $from, string $to)
    {
        $converter = new FilenameToLabelConverter();
        $this->assertSame($to, $converter->convert($from));
    }
}
